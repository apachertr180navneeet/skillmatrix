<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    SubscriptionPlan,
    UserSubscription,
    Transaction
};
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

class SubscriptionController extends Controller
{
        public function adminSubscription()
        {
            $subcriptions = SubscriptionPlan::where('status', 'active')->get();

            $companyId = Auth::user()->company_id;

            // Current active subscription (FULL RECORD)
            $currentSubscription = UserSubscription::where('company_id', $companyId)
                ->where('status', 'active')
                ->whereDate('end_date', '>=', now())
                ->latest()
                ->first();

            $currentPlanId = $currentSubscription?->subscription_plan_id;
            $currentPlanEndDate = $currentSubscription?->end_date;

            return view("admin.subscription.index", compact('subcriptions','currentPlanId', 'currentPlanEndDate'));
        }

        public function buy(Request $request, $planId)
        {
            
            $user = auth()->user();
            $plan = SubscriptionPlan::findOrFail($planId);

            // Expire old active subscription
            UserSubscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->update(['status' => 'expired']);

            $startDate = Carbon::today();
            $endDate   = Carbon::today()->addDays($plan->duration);

            UserSubscription::create([
                'user_id' => $user->id,
                'company_id' => $user->company_id,
                'subscription_plan_id' => $plan->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'user_count' => $request->user_count,
                'status' => 'active',
            ]);


            Transaction::create([
                'user_id' => auth()->id(),
                'company_id' => auth()->user()->company_id,
                'transaction_id' => 'TXN' . time(),
                'amount' => $plan->amount,
                'date' => now(),
                'status' => 'success',
            ]);

            return redirect()->back()->with('success', 'Subscription activated successfully!');
        }
}
