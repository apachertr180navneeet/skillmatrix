<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    SopUserQuesAns,
    SopUserResult,
    SopQuesAns
};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class SopResultController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $sopuserreslts = SopUserResult::with([
            'sop',
            'user.department'
        ])
        ->where('company_id', $companyId)
        ->latest()
        ->get();


        return view('admin.sop_results.index', compact('sopuserreslts'));
    }


    public function view($id)
    {
        $companyId = auth()->user()->company_id;

        // Result summary
        $result = SopUserResult::with('sop', 'user')
            ->where('company_id', $companyId)
            ->where('id', $id)
            ->firstOrFail();

        // 👉 User attempted questions ONLY (in answered order)
        $questions = SopUserQuesAns::where('sop_id', $result->sop_id)
            ->where('user_id', $result->user_id)
            ->orderBy('id') // answer diya gaya order
            ->with('question') // relation: SopQuesAns
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

        return view('admin.sop_results.view', compact('result', 'questiondeatil'));
    }

}