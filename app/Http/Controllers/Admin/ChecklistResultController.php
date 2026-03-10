<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $checklistUserResults = ChecklistUserResult::with([
            'checklist',
            'user.department'
        ])
        ->where('company_id', $companyId)
        ->latest()
        ->get();


        return view('admin.checklist_results.index', compact('checklistUserResults'));
    }


    public function view($id)
    {
        $companyId = auth()->user()->company_id;

        // Result summary
        $result = ChecklistUserResult::with('checklist', 'user')
            ->where('company_id', $companyId)
            ->where('id', $id)
            ->firstOrFail();

        // ONLY attempted questions (same order user answered)
        $questions = ChecklistUserQuesAns::where('checklist_id', $result->checklist_id)
            ->where('user_id', $result->user_id)
            ->orderBy('id')
            ->with('question')
            ->get()
            ->map(function ($row) {

                $q = $row->question;

                return [
                    'question'       => $q->question,
                    'options'        => [
                        '1' => $q->option_one,
                        '2' => $q->option_two,
                        '3' => $q->option_three,
                        '4' => $q->option_four,
                    ],
                    // ✅ FIX HERE
                    'correct_answer' => (int) $q->answer_option,
                    'user_answer'    => (int) $row->answere,
                ];
            });

        $questiondeatil = $questions->toArray();

        return view('admin.checklist_results.view', compact('result', 'questiondeatil'));
    }
}
