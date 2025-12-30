<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Sop,
    Department,
    SopQuesAns
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class SopQuesAnsController extends Controller
{
    /**
     * Show the form for creating a new SOP.
     */
    public function create($id)
    {
        $companyId = auth()->user()->company_id;
        $departments = Department::where('company_id', $companyId)->where('status', 'active')->get();

        $sopdetails = Sop::where('id', $id)->where('party_id', $companyId)->first();

        $sopquesans = SopQuesAns::where('sop_id', $id)->get();


        return view('admin.sop_quesans.create', compact('departments', 'sopdetails', 'sopquesans'));
    }
    /**
     * Store a newly created SOP Q&A in storage.
     */

    public function store(Request $request)
    {
        // ---------------- VALIDATION ----------------
        $request->validate([
            'sop_id' => 'required|exists:sop,id',
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
            SopQuesAns::where('sop_id', $request->sop_id)->forceDelete();

            // ---------------- INSERT QUESTIONS ----------------
            foreach ($request->questions as $question) {

                SopQuesAns::create([
                    'sop_id'          => $request->sop_id,
                    'question'        => $question['question'],
                    'option_one'      => $question['options'][1],
                    'option_two'      => $question['options'][2],
                    'option_three'    => $question['options'][3],
                    'option_four'     => $question['options'][4],
                    'answere_option'  => $question['correct'], // 1-4
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.sop.index')
                ->with('success', 'SOP Questions saved successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
