<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

class SubscriptionController extends Controller
{
        public function adminSubscription()
        {
            $subcriptions = SubscriptionPlan::where('status', 'active')->get();
            return view("admin.subscription.index", compact('subcriptions'));
        }
}
