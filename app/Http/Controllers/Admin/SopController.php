<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class SopController extends Controller
{
    /**
     * SOP listing page
     */
    public function index()
    {
        return view('admin.sop.index');
    }

    // /**
    //  * Get all SOPs (Company + Department)
    //  */
    // public function getall()
    // {
    //     $companyId = auth()->user()->company_id;

    //     $sops = Sop::with('department')
    //         ->where('company_id', $companyId)
    //         ->latest()
    //         ->get();

    //     return response()->json([
    //         'data' => $sops
    //     ]);
    // }
}
