<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Company, User, Department};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{
    /**
     * Show user index page.
     */
    public function index(Request $request)
    {
        // Only active departments
        $departments = Department::where('status', 'active')
            ->orderBy('department_name')
            ->get();

        // Only active companies
        $companies = Company::where('status', 'active')
            ->orderBy('copmany_name')
            ->get();

        return view('super_admin.user.index', compact('departments', 'companies'));
    }

    /**
     * Return all users for DataTable.
     */
    public function getall(Request $request)
    {
        // Load department + company
        $users = User::where('role', 'admin')->with(['department', 'company'])->latest()->get();

        return response()->json([
            'data' => $users,
        ]);
    }

    /**
     * Update status (active / inactive) from table switch.
     */
    public function status(Request $request)
    {
        try {
            // from jQuery: userId
            $user = User::findOrFail($request->userId);
            $user->status = $request->status; // 'active' / 'inactive'
            $user->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete a user by ID.
     */
    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete(); // soft delete if enabled

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store new user (Add modal).
     */
    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|string|max:191',
            'email'         => 'required|email|max:191|unique:users,email',
            'phone'         => 'nullable|numeric|digits_between:10,12|unique:users,phone',
            'city'          => 'nullable|string|max:191',
            'hod_name'      => 'nullable|string|max:191',
            'hod_email'     => 'nullable|email|max:191',
            'department_id' => 'nullable|integer|exists:departments,id',
            'company_id'    => 'nullable|integer|exists:companies,id',
            'password'      => 'required|string|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Store plain password for email
        $plainPassword = $request->password;

        // Create user
        $user = User::create([
            'full_name'  => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'city'       => $request->city,
            'hod_name'   => $request->hod_name,
            'hod_email'  => $request->hod_email,
            'role'       => 'admin',
            'company_id' => $request->company_id ?? 0,
            'status'     => 'active',
            'password'   => Hash::make($plainPassword),
        ]);

        // Admin login link (route based)
        $loginUrl = route('company.login');

        // ✅ SEND EMAIL (FIXED)
        Mail::send([], [], function ($message) use ($user, $plainPassword, $loginUrl) {
            $message->to($user->email)
                ->subject('Your Admin Login Details')
                ->html("
                    <h2>Welcome to Admin Panel</h2>
                    <p>Your admin account has been created successfully.</p>

                    <p><strong>Email:</strong> {$user->email}</p>
                    <p><strong>Password:</strong> {$plainPassword}</p>

                    <p>
                        <a href='{$loginUrl}'
                        style='background:#1e78d6;color:#ffffff;
                        padding:10px 16px;text-decoration:none;
                        border-radius:5px;display:inline-block;'>
                            Admin Login
                        </a>
                    </p>

                    <p><strong>Login URL:</strong><br>{$loginUrl}</p>

                    <p>Please change your password after first login.</p>
                ");
        });

        return response()->json([
            'success' => true,
            'message' => 'User created and login email sent successfully!',
        ]);
    }


    /**
     * Fetch single user for edit modal.
     */
    public function get($id)
    {
        $user = User::with(['department', 'company'])->findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update user (Edit modal).
     */
    public function update(Request $request)
    {
        $rules = [
            'id'            => 'required|integer|exists:users,id',
            'name'          => 'required|string|max:191',
            'email'         => [
                'required',
                'email',
                'max:191',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'phone'         => [
                'nullable',
                'numeric',
                'digits_between:10,12',
                Rule::unique('users', 'phone')->ignore($request->id),
            ],
            'city'          => 'nullable|string|max:191',
            'hod_name'      => 'nullable|string|max:191',
            'hod_email'     => 'nullable|email|max:191',
            'department_id' => 'nullable|integer|exists:departments,id',
            'company_id'    => 'nullable|integer|exists:companies,id',
            // password is optional on update
            'password'      => 'nullable|string|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::findOrFail($request->id);

        $updateData = [
            'full_name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'city'          => $request->city,
            'hod_name'   => $request->hod_name,
            'hod_email'  => $request->hod_email,
            'company_id'    => $request->company_id ?? 0,
            'role'          => 'admin',
        ];

        // Only update password if given
        if (!empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }
}
