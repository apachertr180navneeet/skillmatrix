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
        
        // ---------------- SAVE USER ANSWERS ----------------
        foreach ($request->ques_id as $quesId) {

            $answer = $request->answers[$quesId] ?? null;

            VideoUserQuesAns::Create(
                [
                    'vedio_id' => $videoId,
                    'user_id'  => $userId,
                    'ques_id'  => $quesId,
                    'answere' => $answer,
                    'company_id' => auth()->user()->company_id,
                ]
            );
        }

        // ---------------- FETCH CORRECT ANSWERS ----------------
        $correctAnswers = VedioQuesans::where('vedio_id', $videoId)
            ->pluck('answere_option', 'id'); // [ques_id => correct_answer]

        // ---------------- FETCH USER ANSWERS ----------------
        $userAnswers = VideoUserQuesAns::where('vedio_id', $videoId)
            ->where('user_id', $userId)
            ->pluck('answere', 'ques_id'); // [ques_id => user_answer]

        // ---------------- CALCULATE RESULT ----------------
        $totalQuestions = $correctAnswers->count();
        $correctCount   = 0;

        foreach ($correctAnswers as $quesId => $correctAnswer) {
            if (
                isset($userAnswers[$quesId]) &&
                $userAnswers[$quesId] == $correctAnswer
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
        VideoUserResult::Create(
            [
                'vedio_id' => $videoId,
                'user_id'  => $userId,
                'company_id' => auth()->user()->company_id,
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctCount,
                'wrong_answers'   => $wrongCount,
                'result'          => $percentage,
                'result_status'   => $resultStatus,
            ]
        );

        return redirect()
            ->route('user.video')
            ->with(
                'success',
                "Video submitted successfully. Result: {$percentage}% ({$resultStatus})"
            );
    }
}