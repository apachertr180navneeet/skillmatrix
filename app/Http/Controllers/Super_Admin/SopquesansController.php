<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Sop, SopQuesAns};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SopquesansController extends Controller
{
    public function showQA(Request $request, $id)
    {
        $sop = Sop::with(['department', 'company'])->find($id);

        $sopQuesAns = SopQuesAns::where('sop_id', $id)->get();

        if (!$sop) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.sopquesans.index', compact('sop' , 'sopQuesAns'));
    }
}
