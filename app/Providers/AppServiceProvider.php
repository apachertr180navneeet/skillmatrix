<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\UserSubscription;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }


    public function boot(): void
    {
        View::composer('*', function ($view) {
            $companyId = auth()->check() ? auth()->user()->company_id : null;

            $hasActiveSubscription = false;

            if ($companyId) {
                $hasActiveSubscription = UserSubscription::where('company_id', $companyId)
                    ->where('status', 'active')
                    ->whereDate('end_date', '>=', now())
                    ->exists();
            }

            $view->with('hasActiveSubscription', $hasActiveSubscription);
        });
    }
}
