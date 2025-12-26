<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;
use Exception;

class DepartmentController extends Controller
{
    /**
     * Show sop index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.department.index');
    }

    /**
     * Return all departments for DataTable.
     */
    public function getall(Request $request)
    {
        $departments = Department::with(['company'])
           ->latest()
           ->get();

        return response()->json([
            'data' => $departments,
        ]);
    }
}
