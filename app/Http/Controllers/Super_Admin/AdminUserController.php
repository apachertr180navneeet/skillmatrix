<?php

namespace App\Http\Controllers\Super_Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect,Validator;
use Carbon\Carbon;
use App\Models\Notification;
use App\Models\NotificationUser;

class AdminUserController extends Controller 
{
    //========================= User Member Funcations ========================//
    public function profile(){
        $user = Auth::user();
        return view('web.auth.profile',compact('user'));
    }

    public function show($id) {
        try
        {
            $user = User::find($id);
            if($user){
                return view('admin.users.show', compact('user'));
            }else{
                return redirect()->route('admin.users.index')->withError('User not found!');
            }

        }catch(Exception $e){
            return back()->withError($e->getMessage());
        }
    }

    

}
