<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    VideoUserQuesAns,
    VideoUserResult,
    VedioQuesans
};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class VideoResultController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $videoUserResults = VideoUserResult::with([
            'video',
            'user.department'
        ])
        ->where('company_id', $companyId)
        ->latest()
        ->get();


        return view('admin.video_results.index', compact('videoUserResults'));
    }


    public function view($id)
    {
        $companyId = auth()->user()->company_id;

        // Result summary
        $result = VideoUserResult::with('video', 'user')
            ->where('company_id', $companyId)
            ->where('id', $id)
            ->firstOrFail();

        // 👉 ONLY user attempted questions (answered order)
        $questions = VideoUserQuesAns::where('vedio_id', $result->vedio_id)
            ->where('user_id', $result->user_id)
            ->orderBy('id') // attempt order
            ->with('question') // relation to VedioQuesans
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
                    'correct_answer' => (int) $q->answere_option,
                    'user_answer'    => (int) $row->answere,
                ];
            });

        $questiondeatil = $questions->toArray();

        return view('admin.video_results.view', compact('result', 'questiondeatil'));
    }
}
