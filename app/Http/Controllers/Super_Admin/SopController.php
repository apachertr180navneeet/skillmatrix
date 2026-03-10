<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Sop,SopQuesAns};

class SopController extends Controller
{
    /**
     * Show sop index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.sop.index');
    }

    /**
     * Return all sop for DataTable.
     */
    public function getall(Request $request)
    {
        $sops = Sop::with(['department', 'company'])
           ->latest()
           ->get();

        return response()->json([
            'data' => $sops,
        ]);
    }

    /**
     * Return Show sop for.
     */
    public function show(Request $request, $id)
    {
        $sop = Sop::with(['department', 'company'])->find($id);

        if (!$sop) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.sop.show', compact('sop'));
    }

    public function showQA(Request $request, $id)
    {
        $sop = Sop::with(['department', 'company'])->find($id);

        $sopQuesAns = SopQuesAns::where('sop_id', $id)->get();

        if (!$sop) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.sop.showqa', compact('sop' , 'sopQuesAns'));
    }
}
