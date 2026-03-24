<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Checklist, ChecklistQuesAns, Department};
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

        $departments = Department::get()->keyBy('id');

        foreach ($checklists as $checklist) {
            $deptNames = [];

            if (!empty($checklist->department_id)) {
                $ids = explode(',', $checklist->department_id);

                foreach ($ids as $id) {
                    if (isset($departments[$id])) {
                        $deptNames[] = $departments[$id]->department_name;
                    }
                }
            }

            $checklist->department_names = implode(', ', $deptNames);
        }

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

        $deptNames = [];

        if (!empty($checklist->department_id)) {
            $departmentIds = explode(',', $checklist->department_id);

            $deptNames = Department::whereIn('id', $departmentIds)
                ->pluck('department_name')
                ->toArray();
        }

        $checklist->department_names = implode(', ', $deptNames);

        return view('super_admin.checklist.show', compact('checklist'));
    }

    public function showQA(Request $request, $id)
    {
        $checklist = Checklist::with(['department', 'company'])->find($id);

        $checklistQuesAns = ChecklistQuesAns::where('checklist_id', $id)->get();

        if (!$checklist) {
            abort(404, 'SOP not found');
        }

        return view('super_admin.checklist.showqa', compact('checklist' , 'checklistQuesAns'));
    }
}
