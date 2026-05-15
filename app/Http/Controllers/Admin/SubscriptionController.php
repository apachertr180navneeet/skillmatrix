<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\Transaction;
use App\Models\User;

class SubscriptionController extends Controller
{
    // =======================
    // SHOW SUBSCRIPTIONS
    // =======================
    public function adminSubscription()
    {
        $companyId = auth()->user()->company_id;

        $subcriptions = SubscriptionPlan::where('status', 'active')->get();
        
        $userid = auth()->user()->id;

        $currentsubscriptions = UserSubscription::where('company_id', $companyId)
            ->where('user_id', $userid)
            ->where('status', 'active')
            ->get();
            

        $totalAllowed = $currentsubscriptions->sum('user_count');
        $totalUsed    = $currentsubscriptions->sum('used_users');
        $totalRemain  = $totalAllowed - $totalUsed;

        return view('admin.subscription.index', compact(
            'subcriptions',
            'currentsubscriptions',
            'totalAllowed',
            'totalUsed',
            'totalRemain',
        ));
    }

    /**
     * =======================
     * INITIATE PAYMENT
     * =======================
     */
    public function buy(Request $request, $planId)
    {
        $request->validate([
            'user_count' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $plan = SubscriptionPlan::findOrFail($planId);

        // ✅ Format amount properly (IMPORTANT)
        $amount = number_format($plan->amount * $request->user_count, 2, '.', '');

        $txnid = 'TXN' . time() . rand(1000,9999);

        $payu = config('services.payu');

        // ✅ Normalize strings (avoid hash mismatch)
        $productinfo = trim(preg_replace('/\s+/', ' ', $plan->plan_name));
        $firstname   = trim($user->full_name);
        $email       = trim($user->email);

        // UDF fields
        $udf1 = $plan->id;
        $udf2 = $request->user_count;
        $udf3 = $user->company_id;
        $udf4 = $user->id;
        $udf5 = '';

        // ✅ Generate hash
        $hashString = implode('|', [
            $payu['key'],
            $txnid,
            $amount,
            $productinfo,
            $firstname,
            $email,
            $udf1,
            $udf2,
            $udf3,
            $udf4,
            $udf5,
            '',
            '',
            '',
            '',
            '',
            $payu['salt']
        ]);

        $hash = strtolower(hash('sha512', $hashString));

        $data = [
            'key' => $payu['key'],
            'txnid' => $txnid,
            'amount' => $amount,
            'productinfo' => $productinfo,
            'firstname' => $firstname,
            'email' => $email,
            'phone' => $user->phone ?? '',
            'surl' => route('company.subscription.success'),
            'furl' => route('company.subscription.failure'),
            'hash' => $hash,
            'udf1' => $udf1,
            'udf2' => $udf2,
            'udf3' => $udf3,
            'udf4' => $udf4,
            'udf5' => $udf5,
        ];

        $payuUrl = $payu['env'] === 'test'
            ? 'https://test.payu.in/_payment'
            : 'https://secure.payu.in/_payment';

        return view('admin.subscription.payu_form', compact('data', 'payuUrl'));
    }

    /**
     * =======================
     * PAYMENT SUCCESS
     * =======================
     */
    public function paymentSuccess(Request $request)
    {

        $payu = config('services.payu');

        // Normalize fields
        $productinfo = trim(preg_replace('/\s+/', ' ', $request->productinfo));
        $firstname   = trim($request->firstname);
        $email       = trim($request->email);

        // ✅ Handle additionalCharges if exists
        if ($request->has('additionalCharges')) {
            $hashString = implode('|', [
                $request->additionalCharges,
                $payu['salt'],
                $request->status,
                $request->udf5 ?? '',
                $request->udf4 ?? '',
                $request->udf3 ?? '',
                $request->udf2 ?? '',
                $request->udf1 ?? '',
                $email,
                $firstname,
                $productinfo,
                $request->amount,
                $request->txnid,
                $payu['key']
            ]);
        } else {
            $hashString = implode('|', [
                $payu['salt'],
                $request->status,
                $request->udf5 ?? '',
                $request->udf4 ?? '',
                $request->udf3 ?? '',
                $request->udf2 ?? '',
                $request->udf1 ?? '',
                $email,
                $firstname,
                $productinfo,
                $request->amount,
                $request->txnid,
                $payu['key']
            ]);
        }

        $calculatedHash = strtolower(hash('sha512', $hashString));


        // // ❌ Hash mismatch
        // if ($calculatedHash !== $request->hash) {
        //     echo "Hash Mismatch: Calculated - $calculatedHash, Received - {$request->hash}";
        //     die;
        //     return redirect()->route('company.subscription')
        //         ->with('error', 'Invalid payment response (hash mismatch)');
        // }

        // ❌ Failed payment
        if ($request->status !== 'success') {
            return redirect()->route('company.subscription')
                ->with('error', 'Payment failed');
        }

        // ✅ Process success
        $plan = SubscriptionPlan::findOrFail($request->udf1);
        $userId = $request->udf4;

        // Ensure user login
        if (!Auth::check()) {
            $user = User::find($userId);
            if ($user) {
                Auth::login($user);
            }
        }

        // Prevent duplicate transactions
        if (Transaction::where('transaction_id', $request->txnid)->exists()) {
            return redirect()->route('company.subscription')
                ->with('success', 'Payment already processed');
        }

        // Create subscription
        UserSubscription::create([
            'user_id' => $userId,
            'company_id' => $request->udf3,
            'subscription_plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration),
            'user_count' => $request->udf2,
            'used_users' => "0",
            'status' => 'active',
            'is_locked' => "0",
        ]);

        // Save transaction
        Transaction::create([
            'user_id' => $userId,
            'company_id' => $request->udf3,
            'transaction_id' => $request->txnid,
            'amount' => $request->amount,
            'status' => 'success',
            'date' => now()
        ]);

        session()->regenerate();

        return redirect()->route('company.subscription')
            ->with('success', 'Subscription activated successfully');
    }

    /**
     * =======================
     * PAYMENT FAILURE
     * =======================
     */
    public function paymentFailure(Request $request)
    {

        return redirect()->route('company.subscription')
            ->with('error', 'Payment failed: ' . ($request->error_Message ?? 'Unknown error'));
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
