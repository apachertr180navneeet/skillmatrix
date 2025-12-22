<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
    Checklist,
    Department
};
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

class ChecklistController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;
        $departmentId = auth()->user()->department_id;

        
        $checklists = Checklist::where('party_id', $companyId)
            ->where('department_id', $departmentId)
            ->where('is_suggestion', '0')
            ->latest()
            ->get();
        return view('web.checklist.index', compact('checklists'));
    }
}
