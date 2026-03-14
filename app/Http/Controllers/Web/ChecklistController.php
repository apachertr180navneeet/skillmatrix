<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Checklist,
    ChecklistQuesAns,
    ChecklistUserQuesAns,
    ChecklistUserResult
};

class ChecklistController extends Controller
{
    /**
     * Checklist listing
     */
    public function index()
    {
        $companyId    = auth()->user()->company_id;
        $departmentId = auth()->user()->department_id;
        
        $checklists = Checklist::where('party_id', $companyId)
            ->whereRaw("FIND_IN_SET(?, department_id)", [$departmentId]) // corrected variable
            ->where('is_suggestion', '0')
            ->whereHas('checklistQuesAns')
            ->latest()
            ->get();

        return view('web.checklist.index', compact('checklists'));
    }

    /**
     * Show checklist questions (Random 10)
     */
    public function qa($id)
    {
        $checklistDetails = Checklist::findOrFail($id);

        $checklistQuesAns = ChecklistQuesAns::where('checklist_id', $id)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view(
            'web.checklist.qa',
            compact('checklistDetails', 'checklistQuesAns')
        );
    }

    /**
     * Submit checklist answers & calculate result
     */
    public function qaSubmit(Request $request)
    {
        $userId      = auth()->id();
        $companyId   = auth()->user()->company_id;
        $checklistId = $request->checklist_id;

        // ---------------- ANSWERED QUESTION IDS (ONLY SHOWN QUESTIONS) ----------------
        $questionIds = $request->ques_id; // random / shown questions only

        // ---------------- DELETE OLD ANSWERS (RE-ATTEMPT SAFE) ----------------
        ChecklistUserQuesAns::where('checklist_id', $checklistId)
            ->where('user_id', $userId)
            ->whereIn('ques_id', $questionIds)
            ->delete();

        // ---------------- SAVE USER ANSWERS ----------------
        foreach ($questionIds as $quesId) {
            ChecklistUserQuesAns::create([
                'checklist_id' => $checklistId,
                'user_id'      => $userId,
                'ques_id'      => $quesId,
                'answere'      => $request->answers[$quesId] ?? null,
                'company_id'   => $companyId,
            ]);
        }

        // ---------------- FETCH CORRECT ANSWERS (ONLY ANSWERED QUESTIONS) ----------------
        $correctAnswers = ChecklistQuesAns::where('checklist_id', $checklistId)
            ->whereIn('id', $questionIds)
            ->pluck('answer_option', 'id'); // [ques_id => correct_answer]

        // ---------------- FETCH USER ANSWERS (ONLY ANSWERED QUESTIONS) ----------------
        $userAnswers = ChecklistUserQuesAns::where('checklist_id', $checklistId)
            ->where('user_id', $userId)
            ->whereIn('ques_id', $questionIds)
            ->pluck('answere', 'ques_id'); // [ques_id => user_answer]

        // ---------------- CALCULATE RESULT ----------------
        $totalQuestions = count($questionIds);
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

        // ---------------- DELETE OLD RESULT (IF EXISTS) ----------------
        ChecklistUserResult::where('checklist_id', $checklistId)
            ->where('user_id', $userId)
            ->delete();

        // ---------------- STORE FINAL RESULT ----------------
        ChecklistUserResult::create([
            'checklist_id'     => $checklistId,
            'user_id'          => $userId,
            'company_id'       => $companyId,
            'total_questions'  => $totalQuestions,
            'correct_answers'  => $correctCount,
            'wrong_answers'    => $wrongCount,
            'result'           => $percentage,
            'result_status'    => $resultStatus,
        ]);

        return redirect()
            ->route('user.checklist')
            ->with(
                'success',
                "Checklist submitted successfully. Result: {$percentage}% ({$resultStatus})"
            );
    }
}
