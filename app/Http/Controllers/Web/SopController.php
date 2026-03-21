<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
    Sop,
    Department,
    SopQuesAns,
    SopUserQuesAns,
    SopUserResult
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

class SopController extends Controller
{
    public function sop()
    {
        $departmentid = auth()->user()->department_id;
        $companyId = auth()->user()->company_id;
        
        $sops = Sop::with('department')
            ->where('party_id', $companyId)
            ->whereRaw("FIND_IN_SET(?, department_id)", [$departmentid]) // comma separated check
            ->where('is_suggestion', '0')
            ->whereHas('sopQuesAns') // sirf wahi SOP jisme ques_ans ho
            ->latest()
            ->get();

        return view("web.sop.index", compact('sops'));
    }

    public function qa($id)
    {
        $sopdetails = Sop::findOrFail($id);

        $sopquesans = SopQuesAns::where('sop_id', $id)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return view('web.sop.qa', compact('sopquesans', 'sopdetails'));
    }

    public function view($encryptedId)
    {
        try {
            $sopId = Crypt::decryptString($encryptedId);
        } catch (Exception $e) {
            abort(403, 'Invalid link');
        }

        $sop = Sop::where('id', $sopId)
            ->where('party_id', auth()->user()->company_id)
            ->firstOrFail();

        $absolutePath = $this->resolveSopAbsolutePath($sop->sop_upload);

        abort_if(!$absolutePath, 404, 'SOP file not found');

        return response()->file($absolutePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($absolutePath) . '"',
        ]);
    }


    public function qaSubmit(Request $request)
    {
        $userId    = auth()->user()->id;
        $companyId = auth()->user()->company_id;
        $sopId     = $request->sop_id;

        // ---------------- RANDOM QUESTION IDS (ONLY 10) ----------------
        $questionIds = $request->ques_id; // random 10 questions shown to user

        // ---------------- DELETE OLD ANSWERS (RE-ATTEMPT SAFE) ----------------
        SopUserQuesAns::where('sop_id', $sopId)
            ->where('user_id', $userId)
            ->whereIn('ques_id', $questionIds)
            ->delete();

        // ---------------- SAVE USER ANSWERS ----------------
        foreach ($questionIds as $quesId) {
            SopUserQuesAns::create([
                'sop_id'     => $sopId,
                'user_id'    => $userId,
                'ques_id'    => $quesId,
                'company_id' => $companyId,
                'answere'    => $request->answers[$quesId] ?? null,
            ]);
        }

        // ---------------- FETCH CORRECT ANSWERS (ONLY RANDOM 10) ----------------
        $correctAnswers = SopQuesAns::where('sop_id', $sopId)
            ->whereIn('id', $questionIds)
            ->pluck('answere_option', 'id'); // [ques_id => correct_answer]

        // ---------------- FETCH USER ANSWERS (ONLY RANDOM 10) ----------------
        $userAnswers = SopUserQuesAns::where('sop_id', $sopId)
            ->where('user_id', $userId)
            ->whereIn('ques_id', $questionIds)
            ->pluck('answere', 'ques_id'); // [ques_id => user_answer]

        // ---------------- CALCULATE RESULT ----------------
        $totalQuestions = count($questionIds);
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

        // ---------------- DELETE OLD RESULT (IF EXISTS) ----------------
        SopUserResult::where('sop_id', $sopId)
            ->where('user_id', $userId)
            ->delete();

        // ---------------- STORE FINAL RESULT ----------------
        SopUserResult::create([
            'sop_id'           => $sopId,
            'user_id'          => $userId,
            'company_id'       => $companyId,
            'total_questions'  => $totalQuestions,
            'correct_answers'  => $correctCount,
            'wrong_answers'    => $wrongCount,
            'result'           => $percentage,
            'result_status'    => $resultStatus,
        ]);

        return redirect()
            ->route('user.sop')
            ->with(
                'success',
                "SOP submitted successfully. Result: {$percentage}% ({$resultStatus})"
            );
    }

    private function resolveSopAbsolutePath(?string $storedValue): ?string
    {
        if (!$storedValue) {
            return null;
        }

        $candidates = [];

        if (filter_var($storedValue, FILTER_VALIDATE_URL)) {
            $urlPath = ltrim((string) parse_url($storedValue, PHP_URL_PATH), '/');

            if ($urlPath !== '') {
                $candidates[] = public_path($urlPath);

                if (str_starts_with($urlPath, 'storage/')) {
                    $candidates[] = storage_path('app/public/' . substr($urlPath, 8));
                }
            }
        } else {
            $normalizedPath = ltrim(str_replace('\\', '/', $storedValue), '/');

            $candidates[] = storage_path('app/' . $normalizedPath);
            $candidates[] = storage_path('app/public/' . $normalizedPath);
            $candidates[] = public_path($normalizedPath);
        }

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
