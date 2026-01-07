<?php

namespace App\Http\Controllers\Web;

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
    public function videoResults()
    {
        $companyId = auth()->user()->company_id;
        $userid = auth()->user()->id;

        $videoUserResults = VideoUserResult::with([
            'video',
            'user.department'
        ])
        ->where('company_id', $companyId)
        ->where('user_id', $userid)
        ->latest()
        ->get();


        return view('web.video_results.index', compact('videoUserResults'));
    }


    public function view($id)
    {
        $companyId = auth()->user()->company_id;

        // Result summary
        $result = VideoUserResult::with('video', 'user')
            ->where('company_id', $companyId)
            ->where('id', $id)
            ->firstOrFail();

        // ✅ User answers in SAME ORDER as submitted
        $userAnswerRows = VideoUserQuesAns::where('vedio_id', $result->vedio_id)
            ->where('user_id', $result->user_id)
            ->orderBy('id') // or created_at
            ->get();

        // All related questions indexed by id
        $questionsMaster = VedioQuesans::where('vedio_id', $result->vedio_id)
            ->whereIn('id', $userAnswerRows->pluck('ques_id'))
            ->get()
            ->keyBy('id');

        // Build question list in USER ANSWER ORDER
        $questiondeatil = $userAnswerRows->map(function ($ua) use ($questionsMaster) {

            $q = $questionsMaster[$ua->ques_id];

            return [
                'question' => $q->question,
                'options' => [
                    '1' => $q->option_one,
                    '2' => $q->option_two,
                    '3' => $q->option_three,
                    '4' => $q->option_four,
                ],
                'correct_answer' => (int) $q->answere_option,
                'user_answer'    => (int) $ua->answere,
                'status' => $ua->answere == $q->answere_option
                    ? 'correct'
                    : 'wrong'
            ];
        })->toArray();

        return view('web.video_results.view', compact('result', 'questiondeatil'));
    }
}
