<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserSubscription;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $companyId = auth()->user()->company_id;

        $hasActiveSubscription = UserSubscription::where('company_id', $companyId)
            ->where('status', 'active')
            ->whereDate('end_date', '>=', now())
            ->exists();

        if (!$hasActiveSubscription) {
            return redirect()
                ->route('admin.subscription')
                ->with('error', 'Please buy a subscription to continue.');
        }

        return $next($request);
    }
}
