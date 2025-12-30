<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Checklist,
    Department,
    ChecklistQuesAns
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class ChecklistQuesAnsController extends Controller
{
    /**
     * Show the form for creating a new SOP.
     */
    public function create($id)
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();

        $checklistdetails = Checklist::where('id', $id)->where('party_id', $companyId)->first();

        $checklistquesans = ChecklistQuesAns::where('checklist_id', $id)->get();

        return view('admin.checklist_quesans.create', compact('departments', 'checklistdetails', 'checklistquesans'));
    }
    /**
     * Store a newly created SOP Q&A in storage.
     */

    public function store(Request $request)
    {
        // ---------------- VALIDATION ----------------
        $request->validate([
            'checklist_id' => 'required|exists:checklists,id',
            'questions' => 'required|array|min:1',

            'questions.*.question' => 'required|string|max:255',

            'questions.*.options.1' => 'required|string|max:255',
            'questions.*.options.2' => 'required|string|max:255',
            'questions.*.options.3' => 'required|string|max:255',
            'questions.*.options.4' => 'required|string|max:255',

            'questions.*.correct' => 'required|in:1,2,3,4',
        ]);

        DB::beginTransaction();

        try {

            // ---------------- DELETE OLD QUESTIONS (EDIT MODE) ----------------
            ChecklistQuesAns::where('checklist_id', $request->checklist_id)->forceDelete();

            // ---------------- INSERT QUESTIONS ----------------
            foreach ($request->questions as $question) {


                ChecklistQuesAns::create([
                    'checklist_id'    => $request->checklist_id,
                    'question'        => $question['question'],
                    'option_one'      => $question['options'][1],
                    'option_two'      => $question['options'][2],
                    'option_three'    => $question['options'][3],
                    'option_four'     => $question['options'][4],
                     'answer_option'=> (int)$question['correct'], // 1-4
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.checklist.index')
                ->with('success', 'Checklist Questions saved successfully');

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
