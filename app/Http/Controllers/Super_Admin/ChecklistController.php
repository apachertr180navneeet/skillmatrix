<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checklist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;
use Exception;

class ChecklistController extends Controller
{
    /**
     * Show sop index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.checklist.index');
    }

    /**
     * Return all checklist for DataTable.
     */
    public function getall(Request $request)
    {
        $checklists = Checklist::with(['department', 'company'])
           ->latest()
           ->get();

        return response()->json([
            'data' => $checklists,
        ]);
    }

    /**
     * Return Show checklist for.
     */
    public function show(Request $request, $id)
    {
        $checklist = Checklist::with(['department', 'company'])->find($id);
        if (!$checklist) {
            abort(404, 'Checklist not found');
        }

        return view('super_admin.checklist.show', compact('checklist'));
    }
}
