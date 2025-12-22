<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
    Sop,
    Department,
    SopQuesAns,
    SopUserQuesAns,
    SopUserResult
};
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

class SopController extends Controller
{
    public function sop()
    {
        $departmentid = auth()->user()->department_id;
        $companyId = auth()->user()->company_id;

        $sops = Sop::with('department')
            ->where('party_id', $companyId)
            ->where('department_id', $departmentid)
            ->where('is_suggestion', '0')
            ->latest()
            ->get();

        return view("web.sop.index", compact('sops'));
    }

    public function qa($id)
    {
        $sopdetails = Sop::find($id);
        $sopquesans = SopQuesAns::where('sop_id', $id)->get();
        return view("web.sop.qa", compact('sopquesans', 'sopdetails'));
    }


    public function qaSubmit(Request $request)
    {
        $userId = auth()->user()->id;
        $sopId  = $request->sop_id;

        // ---------------- SAVE USER ANSWERS ----------------
        foreach ($request->ques_id as $quesId) {
            $answer = $request->answers[$quesId] ?? null;

            SopUserQuesAns::updateOrCreate(
                [
                    'sop_id'  => $sopId,
                    'user_id' => $userId,
                    'ques_id' => $quesId,
                ],
                [
                    'answere' => $answer,
                ]
            );
        }

        // ---------------- FETCH CORRECT ANSWERS ----------------
        $correctAnswers = SopQuesAns::where('sop_id', $sopId)
            ->pluck('answere_option', 'id'); // [ques_id => correct_answer]

        // ---------------- FETCH USER ANSWERS ----------------
        $userAnswers = SopUserQuesAns::where('sop_id', $sopId)
            ->where('user_id', $userId)
            ->pluck('answere', 'ques_id'); // [ques_id => user_answer]

        // ---------------- CALCULATE RESULT ----------------
        $totalQuestions = $correctAnswers->count();
        $correctCount   = 0;

        foreach ($correctAnswers as $quesId => $correctAnswer) {
            if (
                isset($userAnswers[$quesId]) &&
                $userAnswers[$quesId] == $correctAnswer
            ) {
                $correctCount++;
            }
        }

        $wrongCount = $totalQuestions - $correctCount;

        $percentage = $totalQuestions > 0
            ? round(($correctCount / $totalQuestions) * 100)
            : 0;

        $resultStatus = $percentage >= 60 ? 'pass' : 'fail';

        // ---------------- STORE FINAL RESULT ----------------
        SopUserResult::updateOrCreate(
            [
                'sop_id'  => $sopId,
                'user_id' => $userId,
            ],
            [
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctCount,
                'wrong_answers'   => $wrongCount,
                'result'          => $percentage,
                'result_status'   => $resultStatus,
            ]
        );

        return redirect()
            ->route('user.sop')
            ->with(
                'success',
                "SOP submitted successfully. Result: {$percentage}% ({$resultStatus})"
            );
    }
}
