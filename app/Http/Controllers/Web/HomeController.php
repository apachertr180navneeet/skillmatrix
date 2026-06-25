<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
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
        return view('web.home.plan');
    }

    public function contact()
    {
        return view('web.home.contact');
    }

    public function termAndConditions()
    {
        return view('web.home.terms-condition');
    }

    public function privacyPolicy()
    {
        return view('web.home.privacy-policy');
    }

    public function refundCancellation()
    {
        return view('web.home.refund-cancellation');
    }
}
