<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    /**
     * User listing page
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Get all users (Company-wise)
     */
    public function getall()
    {
        $companyId = auth()->user()->company_id;

        $users = User::with('department')->where('company_id', $companyId)
            ->where('role', 'user')
            ->latest()
            ->get();

        return response()->json([
            'data' => $users
        ]);
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'hod_name'      => 'required|string|max:255',
            'hod_email'     => 'required|email|max:255',
            'phone'         => 'required|digits_between:10,15',
            'password'      => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        User::create([
            'company_id'    => auth()->user()->company_id,
            'full_name'          => $request->name,
            'department_id' => $request->department_id,
            'hod_name'      => $request->hod_name,
            'hod_email'     => $request->hod_email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User added successfully!'
        ]);
    }

    /**
     * Fetch single user
     */
    public function get($id)
    {
        $user = User::where('id', $id)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        return response()->json($user);
    }

    /**
     * Update user
     */
    public function update(Request $request)
    {
        $rules = [
            'id'            => 'required|exists:users,id',
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'hod_name'      => 'required|string|max:255',
            'hod_email'     => 'required|email|max:255',
            'phone'         => 'required|digits_between:10,15',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::where('id', $request->id)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();

        $data = [
            'full_name'          => $request->name,
            'department_id' => $request->department_id,
            'hod_name'      => $request->hod_name,
            'hod_email'     => $request->hod_email,
            'phone'         => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully!'
        ]);
    }

    /**
     * Update status
     */
    public function status(Request $request)
    {
        try {
            $user = User::where('id', $request->userId)
                ->where('company_id', auth()->user()->company_id)
                ->firstOrFail();

            $user->status = $request->status;
            $user->save();

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
            User::where('id', $id)
                ->where('company_id', auth()->user()->company_id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
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
        User::whereIn('id', $request->ids)
            ->where('company_id', auth()->user()->company_id)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        User::whereIn('id', $request->ids)
            ->where('company_id', auth()->user()->company_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected departments deleted successfully!'
        ]);
    }
}
