<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Video,
    Department,
    VedioQuesans
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class VideoQuesAnsController extends Controller
{
    /**
     * Show the form for creating Video Questions & Answers
     */
    public function create($id)
    {
        $companyId = auth()->user()->company_id;

        // Active departments
        $departments = Department::where('company_id', $companyId)
            ->where('status', 'active')
            ->get();

        // Video details
        $videoDetails = Video::where('id', $id)
            ->where('party_id', $companyId)
            ->firstOrFail();

        // Existing questions (edit mode)
        $videoQuesAns = VedioQuesans::where('vedio_id', $id)->get();

        return view(
            'admin.video_quesans.create',
            compact('departments', 'videoDetails', 'videoQuesAns')
        );
    }

    /**
     * Store Video Questions & Answers
     */
    public function store(Request $request)
    {
        // ---------------- VALIDATION ----------------
        $request->validate([
            'vedio_id' => 'required|exists:videos,id',
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
            VedioQuesans::where('vedio_id', $request->vedio_id)->forceDelete();

            // ---------------- INSERT QUESTIONS ----------------
            foreach ($request->questions as $question) {

                VedioQuesans::create([
                    'vedio_id'        => $request->vedio_id,
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
                ->route('admin.video.index')
                ->with('success', 'Video Questions saved successfully');

        } catch (Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
