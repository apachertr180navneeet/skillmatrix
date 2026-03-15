<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show Payment index page.
     */
    public function index(Request $request)
    {
        return view('super_admin.payment.index');
    }

    /**
     * Return all videos for DataTable.
     */
    public function getall(Request $request)
    {
        $payments = Payment::with('company')
            ->latest()
            ->get();

        return response()->json([
            'data' => $payments
        ]);
    }
}
