<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    SubscriptionPlan,
    UserSubscription,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function getall()
    {
        $companyId = auth()->user()->company_id;

        $users = User::with('department')
            ->where('company_id', $companyId)
            ->where('role', 'user')
            ->latest()
            ->get();

        return response()->json(['data' => $users]);
    }

    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;

        /* =====================================================
        STEP 1: GET FIRST AVAILABLE SUBSCRIPTION (FIFO)
        ===================================================== */
        $userSubscription = UserSubscription::where('company_id', $companyId)
            ->where('status', 'active')
            ->where('is_locked', 0) // 0 = unlocked
            ->whereColumn('used_users', '<', 'user_count')
            ->orderBy('id', 'asc') // FIFO
            ->first();

        if (!$userSubscription) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'plan' => ['No available user seats. Please buy more users.']
                ]
            ], 422);
        }

        /* =====================================================
        STEP 2: VALIDATION
        ===================================================== */
        $rules = [
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'hod_name'      => 'required|string|max:255',
            'hod_email'     => 'required|email|max:255',
            'phone'         => 'required|numeric|digits_between:10,11|unique:users,phone',
            'password'      => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        /* =====================================================
        STEP 3: CREATE USER (LOCKED FOREVER)
        ===================================================== */
        $user = User::create([
            'company_id'          => $companyId,
            'role'                => 'user',
            'full_name'           => $request->name,
            'department_id'       => $request->department_id,
            'hod_name'            => $request->hod_name,
            'hod_email'           => $request->hod_email,
            'phone'               => $request->phone,
            'password'            => Hash::make($request->password),
            'status'              => 'active',

            // 🔑 subscription binding
            'user_subscription_id'=> $userSubscription->id,
            'is_locked'           => 1, // 1 = locked
        ]);

        /* =====================================================
        STEP 4: CONSUME SEAT
        ===================================================== */
        $userSubscription->increment('used_users');

        // lock subscription if full
        if ($userSubscription->used_users >= $userSubscription->user_count) {
            $userSubscription->update(['is_locked' => 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'User added successfully!'
        ]);
    }

    /* ================= GET SINGLE ================= */
    public function get($id)
    {
        return User::where('id', $id)
            ->where('company_id', auth()->user()->company_id)
            ->firstOrFail();
    }

    /* ================= UPDATE ================= */
    public function update(Request $request)
    {
        $companyId = auth()->user()->company_id;

        /* =====================================================
        STEP 1: GET FIRST AVAILABLE SUBSCRIPTION (FIFO)
        ===================================================== */
        $userSubscription = UserSubscription::where('company_id', $companyId)
            ->where('status', 'active')
            ->where('is_locked', '0') // 0 = unlocked
            ->whereColumn('used_users', '<', 'user_count')
            ->orderBy('id', 'asc') // FIFO
            ->first();

        if (!$userSubscription) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'plan' => ['No available user seats. Please buy more users.']
                ]
            ], 422);
        }


        $rules = [
            'id'            => 'required|exists:users,id',
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'hod_name'      => 'required|string|max:255',
            'hod_email'     => 'required|email|max:255',
            'phone'         => 'required|numeric|digits_between:10,11|unique:users,phone,' . $request->id,
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = User::where('id', $request->id)
            ->where('company_id', auth()->user()->company_id)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'user' => ['User not found.']
                ]
            ], 404);
        }

        /* =====================================================
        🔒 LOCK CHECK (ENUM: 0 = false, 1 = true)
        ===================================================== */
        if ($user->is_locked == 1) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'user' => ['This user is locked and cannot be updated.']
                ]
            ], 422);
        }

        /* =====================================================
        UPDATE DATA (only if unlocked)
        ===================================================== */
        $data = [
            'full_name'     => $request->name,
            'department_id' => $request->department_id,
            'hod_name'      => $request->hod_name,
            'hod_email'     => $request->hod_email,
            'phone'         => $request->phone,
            'user_subscription_id'=> $userSubscription->id,
            'is_locked'    => 1, // 1 = locked
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        /* =====================================================
        STEP 4: CONSUME SEAT
        ===================================================== */
        $userSubscription->increment('used_users');

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully!'
        ]);
    }

    /* ================= STATUS ================= */
    public function status(Request $request)
    {
        User::where('id', $request->userId)
            ->where('company_id', auth()->user()->company_id)
            ->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    /* ================= DELETE ================= */
    public function destroy($id)
    {
        $user = User::where('id', $id)
            ->where('company_id', auth()->user()->company_id)
            ->first();

        // User not found
        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'user' => ['User not found.']
                ]
            ], 404);
        }

        // 🔒 LOCK CHECK (0 = false, 1 = true)
        if ($user->is_locked == 1) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'user' => ['This user is locked and cannot be deleted or reassigned.']
                ]
            ], 422);
        }

        // ❌ Delete allowed only if NOT locked
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ]);
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
            'message' => 'Selected users deleted successfully!'
        ]);
    }
}
