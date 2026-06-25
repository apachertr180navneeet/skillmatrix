<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show sop index page.
     */
    public function index(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        return view('super_admin.setting.index', compact('setting'));
    }

    /**
     * Update or create settings.
     */
    public function update(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'admin_email' => 'required|email',
        ]);

        // 2️⃣ Update or create single settings row
        Setting::updateOrCreate(
            ['id' => 1], // Always keep one record
            [
                'admin_email' => $request->admin_email,
            ]
        );

        // 3️⃣ Redirect with success message
        return redirect()
            ->back()
            ->with('success', 'Settings updated successfully.');
    }
}
