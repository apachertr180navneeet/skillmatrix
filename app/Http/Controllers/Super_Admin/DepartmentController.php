<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDepartment;
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
        $departments = MasterDepartment::latest()
           ->get();

        return response()->json([
            'data' => $departments,
        ]);
    }

    /**
     * Store new department.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:191|unique:master_departments,name,NULL,id,deleted_at,NULL',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        MasterDepartment::create([
            'name'   => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department saved successfully!',
        ]);
    }

    /**
     * Update status (active / inactive).
     */
    public function status(Request $request)
    {
        try {
            $plan = MasterDepartment::findOrFail($request->id);
            $plan->status = $request->status;
            $plan->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


     /**
     * Delete departments plan (Soft Delete).
     */
    public function destroy($id)
    {
        try {
            MasterDepartment::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Fetch single department
     */
    public function get($id)
    {
        $department = MasterDepartment::findOrFail($id);

        return response()->json($department);
    }

    /**
     * Update department
     */
    public function update(Request $request)
    {
        $rules = [
            'id'   => 'required|exists:master_departments,id',
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('master_departments', 'name')
                    ->ignore($request->id)
                    ->whereNull('deleted_at'),
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $department = MasterDepartment::findOrFail($request->id);
        $department->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully!',
        ]);
    }
}
