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
        STEP 1: GET ACTIVE SUBSCRIPTION
        ===================================================== */
        $userSubscription = UserSubscription::where('company_id', $companyId)
            ->where('status', 'active')
            ->first();

        if (!$userSubscription) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'plan' => ['No active subscription found. Please subscribe to a plan.']
                ]
            ], 422);
        }

        /* =====================================================
        STEP 2: GET PLAN & USER LIMIT
        ===================================================== */
        $plan = SubscriptionPlan::where('id', $userSubscription->subscription_plan_id)->first();

        if (!$plan || !$plan->user) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'plan' => ['Subscription plan configuration error.']
                ]
            ], 422);
        }

        $allowedUsers = (int) $userSubscription->user_count;
        
        /* =====================================================
        STEP 3: COUNT EXISTING USERS
        ===================================================== */
        $currentUserCount = User::where('company_id', $companyId)
            ->where('role', 'user')
            ->count();

        if ($currentUserCount == $allowedUsers) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'plan' => [
                        "User limit reached. Your plan allows only {$allowedUsers} users."
                    ]
                ]
            ], 422);
        }

        /* =====================================================
        STEP 4: VALIDATION
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
        STEP 5: CREATE USER
        ===================================================== */
        User::create([
            'company_id'    => $companyId,
            'role'          => 'user',
            'full_name'     => $request->name,
            'department_id' => $request->department_id,
            'hod_name'      => $request->hod_name,
            'hod_email'     => $request->hod_email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'status'        => 'active',
        ]);

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
            ->firstOrFail();

        $data = [
            'full_name'     => $request->name,
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
        User::where('id', $id)
            ->where('company_id', auth()->user()->company_id)
            ->delete();

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
