<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;

class HomeController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::where('status', 'active')
            ->orderBy('amount', 'asc')
            ->get();
        return view('web.home.index', compact('plans'));
    }

    public function aboutUs()
    {
        return view('web.home.about');
    }

    public function service()
    {
        return view('web.home.service');
    }

    public function plan()
    {
        // Get all active subscription plans
        $plans = SubscriptionPlan::where('status', 'active')
                    ->orderBy('amount', 'asc')
                    ->get();

        return view('web.home.plan', compact('plans'));
    }

    public function contact()
    {
        return view('web.home.contact');
    }
}
