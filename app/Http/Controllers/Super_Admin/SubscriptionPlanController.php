<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class SubscriptionPlanController extends Controller
{
    /**
     * Show subscription plan index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.subscription_plan.index');
    }

    /**
     * Return all subscription plans for DataTable.
     */
    public function getall(Request $request)
    {
        $plans = SubscriptionPlan::latest()->get();

        return response()->json([
            'data' => $plans,
        ]);
    }

    /**
     * Update status (active / inactive).
     */
    public function status(Request $request)
    {
        try {
            $plan = SubscriptionPlan::findOrFail($request->planId);
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
     * Delete subscription plan (Soft Delete).
     */
    public function destroy($id)
    {
        try {
            SubscriptionPlan::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Subscription plan deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store new subscription plan.
     */
    public function store(Request $request)
    {
        $rules = [
            'plan_name'   => 'required|string|max:191',
            'amount'      => 'required|numeric|min:0',
            'duration'    => 'required|integer|min:1',
            'user'        => 'required|integer|min:1',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        SubscriptionPlan::create([
            'plan_name'   => $request->plan_name,
            'amount'      => $request->amount,
            'duration'    => $request->duration,
            'user'        => $request->user,
            'description' => $request->description,
            'status'      => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription plan saved successfully!',
        ]);
    }

    /**
     * Fetch single subscription plan for edit modal.
     */
    public function get($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        return response()->json($plan);
    }

    /**
     * Update subscription plan.
     */
    public function update(Request $request)
    {
        $rules = [
            'id'          => 'required|integer|exists:subscription_plan,id',
            'plan_name'   => 'required|string|max:191',
            'amount'      => 'required|numeric|min:0',
            'duration'    => 'required|integer|min:1',
            'user'        => 'required|integer|min:1',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $plan = SubscriptionPlan::findOrFail($request->id);

        $plan->update([
            'plan_name'   => $request->plan_name,
            'amount'      => $request->amount,
            'duration'    => $request->duration,
            'user'        => $request->user,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription plan updated successfully',
        ]);
    }
}
