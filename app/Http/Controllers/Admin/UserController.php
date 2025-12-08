<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Company, User, Department};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{
    /**
     * Show user index page.
     */
    public function index(Request $request)
    {
        // Only active departments
        $departments = Department::where('status', 'active')
            ->orderBy('department_name')
            ->get();

        // Only active companies
        $companies = Company::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.user.index', compact('departments', 'companies'));
    }

    /**
     * Return all users for DataTable.
     */
    public function getall(Request $request)
    {
        // Load department + company
        $users = User::where('role', 'user')->with(['department', 'company'])->latest()->get();

        return response()->json([
            'data' => $users,
        ]);
    }

    /**
     * Update status (active / inactive) from table switch.
     */
    public function status(Request $request)
    {
        try {
            // from jQuery: userId
            $user = User::findOrFail($request->userId);
            $user->status = $request->status; // 'active' / 'inactive'
            $user->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete a user by ID.
     */
    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete(); // soft delete if enabled

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store new user (Add modal).
     */
    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|string|max:191',
            'email'         => 'required|email|max:191|unique:users,email',
            'phone'         => 'nullable|numeric|digits_between:7,15|unique:users,phone',
            'department_id' => 'nullable|integer|exists:departments,id',
            'company_id'    => 'nullable|integer|exists:companies,id',
            'password'      => 'required|string|min:6|confirmed', // password + password_confirmation
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = [
            'full_name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'department_id' => $request->department_id ?? 0, // default 0
            'company_id'    => $request->company_id ?? 0,    // default 0
            'status'        => 'active',
            'password'      => Hash::make($request->password),
        ];

        User::create($data);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully!',
        ]);
    }

    /**
     * Fetch single user for edit modal.
     */
    public function get($id)
    {
        $user = User::with(['department', 'company'])->findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update user (Edit modal).
     */
    public function update(Request $request)
    {
        $rules = [
            'id'            => 'required|integer|exists:users,id',
            'name'          => 'required|string|max:191',
            'email'         => [
                'required',
                'email',
                'max:191',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'phone'         => [
                'nullable',
                'numeric',
                'digits_between:7,15',
                Rule::unique('users', 'phone')->ignore($request->id),
            ],
            'department_id' => 'nullable|integer|exists:departments,id',
            'company_id'    => 'nullable|integer|exists:companies,id',
            // password is optional on update
            'password'      => 'nullable|string|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::findOrFail($request->id);

        $updateData = [
            'full_name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'department_id' => $request->department_id ?? 0,
            'company_id'    => $request->company_id ?? 0,
        ];

        // Only update password if given
        if (!empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }
}
