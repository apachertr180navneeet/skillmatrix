<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,
    Department,
    Sop,
    Video,
    Checklist,
    SopQuesAns,
    ChecklistQuesAns,
    VedioQuesans,
    SopUserResult,
    VideoUserResult,
    Company,
    SubscriptionPlan,
    UserSubscription
};
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail, DB, Hash, Validator, Session, File,Exception;

use Illuminate\Support\Facades\Log;


class AdminAuthController extends Controller
{
    
    public function index()
    {
        try{
            if(Auth::user()) {
                $user = Auth::user();
                if($user->role == "admin") {
                    return redirect()->route('company.dashboard');
                }else{
                    return back()->with("error","Opps! You do not have access this");
                }
            }else{
                return redirect()->route('company.login');
            }

        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }

    

    public function login()
    {
        return view("admin.auth.login");
    }

    public function postLogin(Request $request)
    {
        try{
            $request->validate([
                "email" => "required",
                "password" => "required",
            ]);
            $user = User::where('role','admin')->where('email',$request->email)->first();
            if($user){
                $credentials = $request->only("email", "password");
                if(Auth::attempt([
                        'email' => $request->email,
                        'password' => $request->password,
                        'role' => function ($query) {
                            $query->where('role','admin');
                        }
                    ]))
                {
                    return redirect()->route("company.dashboard")->with("success", "Welcome to your dashboard.");
                }
                return back()->with("error","Invalid credentials");
            }else{
                return back()->with("error","Invalid credentials");
            }

        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }


    public function register()
    {
        return view("admin.auth.register");
    }

    public function postRegister(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:50',
            'company_name' => 'required|string|max:100',
            'email' => 'required|email|unique:companies,email',
            'mobile' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'password' => 'required|confirmed|min:6',
            'hod_name'  => 'nullable|string|max:100',
            'hod_email' => 'nullable|email',
        ], [
            // Name
            'name.required' => 'Full name is required',
            'name.max' => 'Name must not exceed 50 characters',

            // Company
            'company_name.required' => 'Company name is required',
            'company_name.max' => 'Company name max 100 characters',

            // Email
            'email.required' => 'Email is required',
            'email.email' => 'Enter valid email address',
            'email.unique' => 'Email already registered',

            // Mobile
            'mobile.required' => 'Mobile number is required',
            'mobile.digits' => 'Mobile must be 10 digits',

            // Address
            'address.required' => 'Address is required',

            // City
            'city.required' => 'City is required',

            // State
            'state.required' => 'State is required',

            // Country
            'country.required' => 'Country is required',

            // Password
            'password.required' => 'Password is required',
            'password.min' => 'Password minimum 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);
        try {

            $data = [
                'copmany_name' => $request->company_name,
                'admin_name'   => $request->name,
                'email'        => $request->email,
                'phone'        => $request->mobile,
                'address'      => $request->address,
                'city'         => $request->city,
                'state'        => $request->state,
                'country'      => $request->country,
                'status'       => 'active',
            ];

            $company = Company::create($data);

            $companyId = $company->id;


            $user = User::create([
                'full_name'  => $request->name,
                'email'      => $request->email,
                'phone'      => $request->mobile,
                'city'       => $request->city,
                'hod_name'   => $request->hod_name,
                'hod_email'  => $request->hod_email,
                'role'       => 'admin',
                'company_id' => $companyId ?? 0,
                'status'     => 'active',
                'password'   => Hash::make($request->password),
            ]);

            $planId = 7;

            $plan = SubscriptionPlan::findOrFail($planId);

            UserSubscription::create([
                'user_id' => $user->id,
                'company_id' => $user->company_id,
                'subscription_plan_id' => $plan->id,
                'start_date' => now(),
                'end_date' => now()->addDays($plan->duration),
                'user_count' => 1,
                'used_users' => 0,
                'status' => 'active',
                'is_locked' => '0',
            ]);

            return redirect()->route('company.login')
                ->with('success', 'Registered Successfully!');

        } catch (\Exception $e) {
            dd($e);
            Log::error('Registration Error: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function create(array $data)
    {
        return User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
        ]);
    }

    public function showForgetPasswordForm()
    {
        return view("admin.auth.forgot-password");
    }

    public function submitForgetPasswordForm(Request $request)
    {
        try{
            $request->validate([
                "email" => "required|email|exists:users",
            ]);

            $token = Str::random(64);

            DB::table("password_resets")->insert([
                "email" => $request->email,
                "token" => $token,
                "created_at" => Carbon::now(),
            ]);

            $new_link_token = url("super-admin/reset-password/" . $token);
            Mail::send("admin.email.forgot-password",["token" => $new_link_token, "email" => $request->email],
                function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject("Reset Password");
                }
            );
            return redirect()->route("company.login")->with("success","We have e-mailed your password reset link!");
        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    
    }

    public function showResetPasswordForm($token)
    {
        try{    
            $user = DB::table("password_resets")->where("token", $token)->first();
            $email = $user->email;
            return view("admin.auth.reset-password", ["token" => $token,"email" => $email,]);
        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }

    public function submitResetPasswordForm(Request $request)
    {
        try{
            $request->validate([
                "email" => "required|email|exists:users",
                "password" => "required|string|min:6|confirmed",
                "password_confirmation" => "required",
            ]);

            $updatePassword = DB::table("password_resets")->where(["email" => $request->email,"token" => $request->token])->first();

            if (!$updatePassword) {
                return back()->withInput()->with("error", "Invalid token!");
            }

            $user = User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

            DB::table("password_resets")->where(["email" => $request->email])->delete();

            return redirect()->route("admin.login")->with("success","Your password has been changed successfully!");
        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }

    public function changePassword()
    {
        return view("admin.auth.change-password");
    }

    public function updatePassword(Request $request)
    {
        try{
            $request->validate([
                "old_password" => "required",
                "new_password" => "required|confirmed|min:6",
            ], [
                "new_password.min" => "New password must be at least 6 characters.",
            ]);
            #Match The Old Password
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with("error", "Old Password Doesn't match!");
            }
            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                "password" => Hash::make($request->new_password),
            ]);
            return back()->with("success", "Password changed successfully!");
        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }

    

    public function logout()
    {
        try{
            Session::flush();
            Auth::logout();
            return redirect()->route("company.login")->withSuccess('Logout Successful!');
        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }

    public function adminProfile()
    {
        try{
            $user = Auth::user();
            return view("admin.auth.profile", compact("user"));

        }
        catch(Exception $e){
            return back()->with("error",$e->getMessage());
        }
    }

    public function updateAdminProfile(Request $request)
    {
        try
        {
            $user = Auth::user();
            $data = $request->all();
            $validator = Validator::make($data,[
                "first_name" => "required",
                "last_name" => "required",
                "phone" => "required|min:9|unique:users,phone," .$user->id,
                "email" => "required|email|unique:users,email," . $user->id,
                "avatar" => "sometimes|image|mimes:jpeg,jpg,png|max:5000"
            ]);
            
            if($validator->fails()) {
                return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
            }
            
            if($request->file("avatar")) {
                $file = $request->file("avatar");
                $filename = time() . $file->getClientOriginalName();
                $folder = "uploads/user/";
                $path = public_path($folder);
                if (!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                $file->move($path, $filename);
                $user->avatar = $folder . $filename;
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . " " . $request->last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();
            return redirect()->back()->with("success", "Profile update successfully!");
        }
        catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function adminDashboard()
    {
        $companyId = Auth::user()->company_id;

        $userCount = User::where('role', 'user')
            ->where('status', 'active')
            ->where('company_id', $companyId)
            ->count();

        $departmentCount = Department::where('company_id', $companyId)
            ->where('status', 'active')
            ->count();

        $sopIds = Sop::where('party_id', $companyId)
            ->where('status', 'active')
            ->pluck('id');

        $checklistIds = Checklist::where('party_id', $companyId)
            ->where('status', 'active')
            ->pluck('id');

        $videoIds = Video::where('party_id', $companyId)
            ->where('status', 'active')
            ->pluck('id');

        $sopCount = $sopIds->count();
        $checklistCount = $checklistIds->count();
        $videoCount = $videoIds->count();

        $sopQuestionCount = SopQuesAns::whereIn('sop_id', $sopIds)->count();
        $checklistQuestionCount = ChecklistQuesAns::whereIn('checklist_id', $checklistIds)->count();
        $videoQuestionCount = VedioQuesans::whereIn('vedio_id', $videoIds)->count();

        $sopResultQuery = SopUserResult::where('company_id', $companyId);
        $sopResultTotal = (clone $sopResultQuery)->count();
        $sopResultPass = (clone $sopResultQuery)->where('result_status', 'pass')->count();
        $sopResultFail = (clone $sopResultQuery)->where('result_status', 'fail')->count();

        $videoResultQuery = VideoUserResult::where('company_id', $companyId);
        $videoResultTotal = (clone $videoResultQuery)->count();
        $videoResultPass = (clone $videoResultQuery)->where('result_status', 'pass')->count();
        $videoResultFail = (clone $videoResultQuery)->where('result_status', 'fail')->count();
        $subscription = UserSubscription::where('status','active')
            ->where('company_id',$companyId)
            ->first();

        $remainingDays = 0;

        if ($subscription) {

            $today = Carbon::today();
            $endDate = Carbon::parse($subscription->end_date);

            // ✅ Expire condition
            if ($today->gte($endDate)) {

                // Update status to expired
                $subscription->update([
                    'status' => 'expired'
                ]);

                $remainingDays = 0;

            } else {
                // Remaining days
                $remainingDays = $today->diffInDays($endDate);
            }
        }

        return view('admin.dashboard.index', compact(
            'userCount',
            'departmentCount',
            'sopCount',
            'checklistCount',
            'videoCount',
            'sopQuestionCount',
            'videoQuestionCount',
            'checklistQuestionCount',
            'sopResultTotal',
            'sopResultPass',
            'sopResultFail',
            'videoResultTotal',
            'videoResultPass',
            'videoResultFail',
            'remainingDays'
        ));
    }


}
