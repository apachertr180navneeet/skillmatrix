<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    SopUserQuesAns,
    SopUserResult,
    SopQuesAns
};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class SopResultController extends Controller
{
    public function sopResults()
    {
        $companyId = auth()->user()->company_id;
        $userid = auth()->user()->id;

        $sopuserreslts = SopUserResult::with([
            'sop',
            'user.department'
        ])
        ->where('company_id', $companyId)
        ->where('user_id', $userid)
        ->latest()
        ->get();


        return view('web.sop_results.index', compact('sopuserreslts'));
    }


    public function view($id)
    {
        $companyId = auth()->user()->company_id;

        // ---------------- RESULT SUMMARY ----------------
        $result = SopUserResult::with('sop', 'user')
            ->where('company_id', $companyId)
            ->where('id', $id)
            ->firstOrFail();

        // ---------------- USER ANSWERED QUESTIONS ONLY ----------------
        $answeredQuestions = SopUserQuesAns::where('sop_id', $result->sop_id)
            ->where('user_id', $result->user_id)
            ->whereNotNull('answere')
            ->get();


        // ---------------- FETCH QUESTION DETAILS ----------------
        $questionIds = $answeredQuestions->pluck('ques_id');
        
        $sopQuestions = SopQuesAns::whereIn('id', $questionIds)->get()->keyBy('id');
        

        // ---------------- BUILD QUESTION LIST FOR UI ----------------
        $questions = $answeredQuestions->map(function ($answer) use ($sopQuestions) {

            $q = $sopQuestions[$answer->ques_id];

            return [
                'question'       => $q->question,
                'options'        => [
                    '1' => $q->option_one,
                    '2' => $q->option_two,
                    '3' => $q->option_three,
                    '4' => $q->option_four,
                ],
                'correct_answer' => (int) $q->answere_option, // correct option (1–4)
                'user_answer'    => (int) $answer->answere,  // user selected option (1–4)
                'is_correct'     => ((int)$q->answere_option === (int)$answer->answere)
            ];
        });

        $questiondeatil = $questions->toArray();

        return view('web.sop_results.view', compact('result', 'questiondeatil'));
    }
}