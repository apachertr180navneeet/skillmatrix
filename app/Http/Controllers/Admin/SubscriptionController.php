<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Auth;

class SubscriptionController extends Controller
{
    // =======================
    // SHOW SUBSCRIPTIONS
    // =======================
    public function adminSubscription()
    {
        $companyId = auth()->user()->company_id;

        $subcriptions = SubscriptionPlan::where('status', 'active')->get();

        $subscriptions = UserSubscription::where('company_id', $companyId)
            ->where('status', 'active')
            ->get();

            

        $totalAllowed = $subscriptions->sum('user_count');
        $totalUsed    = $subscriptions->sum('used_users');
        $totalRemain  = $totalAllowed - $totalUsed;

        $currentSubscription = $subscriptions->sortByDesc('id')->first();

        $currentPlanId = $currentSubscription?->subscription_plan_id;
        $currentPlanEndDate = $currentSubscription?->end_date;

        return view('admin.subscription.index', compact(
            'subcriptions',
            'subscriptions',
            'totalAllowed',
            'totalUsed',
            'totalRemain',
            'currentSubscription',
            'currentPlanId',
            'currentPlanEndDate'
        ));
    }

    // =======================
    // BUY NEW PLAN
    // =======================
    public function buy(Request $request, $planId)
    {
        $request->validate([
            'user_count' => 'required|integer|min:1'
        ]);

        $plan = SubscriptionPlan::findOrFail($planId);
        $user = auth()->user();

        UserSubscription::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'subscription_plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration),
            'user_count' => $request->user_count,
            'used_users' => 0,
            'status' => 'active',
            'is_locked' => '0',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'transaction_id' => 'TXN'.time(),
            'amount' => $plan->amount * $request->user_count,
            'status' => 'success',
            'date' => now()
        ]);

        return back()->with('success', 'Subscription added successfully');
    }

    // =======================
    // ADD USERS TO PLAN
    // =======================
    public function addUsers(Request $request, $subscriptionId)
    {
        $request->validate([
            'user_count' => 'required|integer|min:1'
        ]);

        $old = UserSubscription::findOrFail($subscriptionId);

        UserSubscription::create([
            'user_id' => auth()->id(),
            'company_id' => $old->company_id,
            'subscription_plan_id' => $old->subscription_plan_id,
            'start_date' => now(),
            'end_date' => $old->end_date,
            'user_count' => $request->user_count,
            'used_users' => 0,
            'status' => 'active',
            'is_locked' => '0',
        ]);

        return back()->with('success', 'Users added successfully');
    }
}
