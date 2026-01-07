<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
    Video,
    VedioQuesans,
    VideoUserResult,
    VideoUserQuesAns,
    Department,
};
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

class VideoController extends Controller
{
    public function video()
    {
        $departmentid = auth()->user()->department_id;
        $companyId = auth()->user()->company_id;

        $videos = Video::with('department')
            ->where('party_id', $companyId)
            ->where('department_id', $departmentid)
            ->where('is_suggestion', '0')
            ->whereHas('videoQuesAns') // 🔥 sirf wahi video jisme ques_ans ho
            ->latest()
            ->get();

        return view("web.video.index", compact('videos'));
    }

    public function qa($id)
    {
        $videodetails = Video::findOrFail($id);

        $videoquesans = VedioQuesans::where('vedio_id', $id)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('web.video.qa', compact('videoquesans', 'videodetails'));
    }

    public function qaSubmit(Request $request)
    {
        $userId  = auth()->user()->id;
        $videoId = $request->video_id;
        $companyId = auth()->user()->company_id;

        // ---------------- SAVE USER ANSWERS ----------------
        foreach ($request->ques_id as $quesId) {

            if (!isset($request->answers[$quesId])) {
                continue; // skip unanswered question
            }

            VideoUserQuesAns::create([
                'vedio_id'   => $videoId,
                'user_id'    => $userId,
                'ques_id'    => $quesId,
                'answere'    => $request->answers[$quesId],
                'company_id'=> $companyId,
            ]);
        }

        // ---------------- FETCH USER ANSWERS (ONLY ANSWERED) ----------------
        $userAnswers = VideoUserQuesAns::where('vedio_id', $videoId)
            ->where('user_id', $userId)
            ->pluck('answere', 'ques_id'); // [ques_id => user_answer]

        // ---------------- FETCH CORRECT ANSWERS FOR ANSWERED QUESTIONS ----------------
        $correctAnswers = VedioQuesans::where('vedio_id', $videoId)
            ->whereIn('id', $userAnswers->keys())
            ->pluck('answere_option', 'id');

        // ---------------- CALCULATE RESULT ----------------
        $totalQuestions = $userAnswers->count(); // ✅ only answered
        $correctCount   = 0;

        foreach ($userAnswers as $quesId => $userAnswer) {
            if (
                isset($correctAnswers[$quesId]) &&
                $userAnswer == $correctAnswers[$quesId]
            ) {
                $correctCount++;
            }
        }

        $wrongCount = $totalQuestions - $correctCount;

        $percentage = $totalQuestions > 0
            ? round(($correctCount / $totalQuestions) * 100)
            : 0;

        $resultStatus = $percentage >= 60 ? 'pass' : 'fail';

        // ---------------- STORE FINAL RESULT ----------------
        VideoUserResult::create([
            'vedio_id'         => $videoId,
            'user_id'          => $userId,
            'company_id'       => $companyId,
            'total_questions'  => $totalQuestions,
            'correct_answers'  => $correctCount,
            'wrong_answers'    => $wrongCount,
            'result'           => $percentage,
            'result_status'    => $resultStatus,
        ]);

        return redirect()
            ->route('user.video')
            ->with(
                'success',
                "Video submitted successfully. Result: {$percentage}% ({$resultStatus})"
            );
    }

}