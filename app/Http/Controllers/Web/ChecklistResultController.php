<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    ChecklistUserQuesAns,
    ChecklistUserResult,
    ChecklistQuesAns
};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class ChecklistResultController extends Controller
{
    public function checklistResults()
    {
        $companyId = auth()->user()->company_id;
        $userid = auth()->user()->id;

        $checklistUserResults = ChecklistUserResult::with([
            'checklist',
            'user.department'
        ])
        ->where('company_id', $companyId)
        ->where('user_id', $userid)
        ->latest()
        ->get();


        return view('web.checklist_results.index', compact('checklistUserResults'));
    }


    public function view($id)
    {
        $companyId = auth()->user()->company_id;

        // Result summary
        $result = ChecklistUserResult::with('checklist', 'user')
            ->where('company_id', $companyId)
            ->where('id', $id)
            ->firstOrFail();

        // All Checklist questions with correct answers
        $checklistQuestions = ChecklistQuesAns::where('checklist_id', $result->checklist_id)->get();

        // User answers (ques_id => answer)
        $userAnswers = ChecklistUserQuesAns::where('checklist_id', $result->checklist_id)
            ->where('user_id', $result->user_id)
            ->pluck('answere', 'ques_id');

        // Build question list for UI
        $questions = $checklistQuestions->map(function ($q) use ($userAnswers) {
            return [
                'question'       => $q->question,
                'options'        => [
                    '1' => $q->option_one,
                    '2' => $q->option_two,
                    '3' => $q->option_three,
                    '4' => $q->option_four,
                ],
                'correct_answer' => (int) $q->answere_option,          // 1–4
                'user_answer'    => (int) ($userAnswers[$q->id] ?? 0) // 1–4
            ];
        });


        $questiondeatil = $questions->toArray();

        return view('web.checklist_results.view', compact('result', 'questiondeatil'));
    }
}
