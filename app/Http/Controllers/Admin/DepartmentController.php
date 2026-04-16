<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Department,
    MasterDepartment
    };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class DepartmentController extends Controller
{
    /**
     * Department listing page
     */
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $departments = MasterDepartment::where('status', 'active')
            ->latest()
            ->get();

        $departmentcompany = Department::where('company_id', $companyId)
            ->pluck('department_name') // 👈 important (only ids)
            ->toArray();

        return view('admin.department.index', compact('departments', 'departmentcompany'));
    }

    /**
     * Get all departments (Company-wise)
     */
    public function getall()
    {
        $companyId = auth()->user()->company_id;

        $departments = Department::where('company_id', $companyId)
            ->latest()
            ->get();

        return response()->json([
            'data' => $departments
        ]);
    }

    /**
     * Store new department
     */
    public function store(Request $request)
    {
        $rules = [
            'department_name' => 'required|string|max:255|unique:departments,department_name,NULL,id,company_id,' . auth()->user()->company_id,
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request) {
            $existsInMaster = MasterDepartment::whereRaw('LOWER(name) = ?', [strtolower(trim($request->department_name))])
                ->exists();

            if ($existsInMaster) {
                $validator->errors()->add('department_name', 'Department already exists in master departments.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        Department::create([
            'company_id'      => auth()->user()->company_id,
            'department_name' => $request->department_name,
            'status'          => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department added successfully!'
        ]);
    }

    public function saveChecklist(Request $request)
    {
        $request->validate([
            'departments' => 'required|array'
        ]);

        $companyId = auth()->user()->company_id;

        // Remove duplicates from request itself
        $requestedDepartments = collect($request->departments)
            ->filter(fn ($name) => !empty($name))
            ->unique()
            ->values();

        // Fetch already-added department names for this company
        $existingDepartments = Department::where('company_id', $companyId)
            ->pluck('department_name')
            ->toArray();

        // Keep only new department names that are not already present
        $newDepartments = $requestedDepartments
            ->reject(fn ($name) => in_array($name, $existingDepartments))
            ->values();

        foreach ($newDepartments as $departmentName) {
            Department::create([
                'company_id'      => $companyId,
                'department_name' => $departmentName,
                'status'          => 'active',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $newDepartments->count() > 0
                ? 'Checklist saved successfully'
                : 'All selected departments are already added for this company'
        ]);
    }

    /**
     * Fetch single department (Company-wise)
     */
    public function get($id)
    {
        $department = Department::where('id', $id)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        return response()->json($department);
    }

    /**
     * Update department
     */
    public function update(Request $request)
    {
        $department = Department::where('id', $request->id)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        $isMasterMappedDepartment = MasterDepartment::whereRaw(
            'LOWER(name) = ?',
            [strtolower(trim($department->department_name))]
        )->exists();

        if ($isMasterMappedDepartment) {
            return response()->json([
                'success' => false,
                'errors'  => [
                    'department_name' => ['Master department cannot be edited.']
                ],
            ], 422);
        }

        $rules = [
            'id'              => 'required|exists:departments,id',
            'department_name' => 'required|string|max:255|unique:departments,department_name,' .
                $request->id . ',id,company_id,' . auth()->user()->company_id,
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request) {
            $existsInMaster = MasterDepartment::whereRaw('LOWER(name) = ?', [strtolower(trim($request->department_name))])
                ->exists();

            if ($existsInMaster) {
                $validator->errors()->add('department_name', 'Department already exists in master departments.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $department->update([
            'department_name' => $request->department_name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully!'
        ]);
    }

    /**
     * Update status
     */
    public function status(Request $request)
    {
        try {
            $department = Department::where('id', $request->departmentId)
                ->where('company_id', auth()->user()->company_id)
                ->firstOrFail();

            $department->status = $request->status;
            $department->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Delete department
     */
    public function destroy($id)
    {
        try {
            Department::where('id', $id)
                ->where('company_id', auth()->user()->company_id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function bulkStatus(Request $request)
    {
        Department::whereIn('id', $request->ids)
            ->where('company_id', auth()->user()->company_id)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        Department::whereIn('id', $request->ids)
            ->where('company_id', auth()->user()->company_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected departments deleted successfully!'
        ]);
    }

}
