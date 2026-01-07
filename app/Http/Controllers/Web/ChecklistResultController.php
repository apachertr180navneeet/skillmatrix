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

        // User answered questions only
        $answeredQuestions = ChecklistUserQuesAns::where('checklist_id', $result->checklist_id)
            ->where('user_id', $result->user_id)
            ->whereNotNull('answere')
            ->get();

        $questionIds = $answeredQuestions->pluck('ques_id');

        // Fetch checklist questions
        $checklistQuestions = ChecklistQuesAns::whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        // Build UI data
        $questions = $answeredQuestions->map(function ($answer) use ($checklistQuestions) {

            $q = $checklistQuestions[$answer->ques_id] ?? null;

            if (!$q) {
                return null;
            }

            return [
                'question' => $q->question,
                'options'  => [
                    1 => $q->option_one,
                    2 => $q->option_two,
                    3 => $q->option_three,
                    4 => $q->option_four,
                ],

                // ✅ IMPORTANT FIX HERE
                'correct_answer' => (int) ($q->answer_option ?? $q->answere_option ?? 0),

                'user_answer'    => (int) $answer->answere,

                'is_correct'     => ((int)($q->answer_option ?? $q->answere_option) === (int)$answer->answere)
            ];
        })->filter(); // remove null rows

        $questiondeatil = $questions->values()->toArray();

        return view('web.checklist_results.view', compact('result', 'questiondeatil'));
    }

}
