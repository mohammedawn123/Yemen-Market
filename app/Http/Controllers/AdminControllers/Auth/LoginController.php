<?php

namespace App\Http\Controllers\AdminControllers\Auth;

use App\Admin\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

   //  use AuthenticatesUsers;


    public function  goToAdmin()
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        if (Admin::user()) {
            return redirect()->route('admin.home2');
        }
        return view('admin.auth.login');
    }
    public function  getLogin()
    {
        if (Admin::user()) {
            return redirect()->route('admin.home2');
        }
         return view('admin.auth.login');
    }
    public function  Login(Request $request)
    {
        $validator=$this->login_validation($request->only(['email' , 'password']));

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if(Auth::guard('admin')->attempt(['email'=>$request->input("email") , 'password'=>$request->input("password") , 'status'=>1 ]))
           {
             return redirect()->route('admin.home2')->with(['success' => 'you are login successfuly']);
           }

        $userStatus=Admin::where('email' ,$request->input("email"))->first();
        $error_login=$userStatus->status ===1 ? 'No match for Email and/or Password...' : $userStatus->name .' ...Your Account is Clock...';

       return view('admin.auth.login' , ['error_login' => $error_login]);
    }

    public function Logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');

    }
    protected function login_validation($data)
    {
        $rules= [
            'email'=> 'required|email' ,
            'password'=> 'required'
        ];
        $messages= [
            'required'=> 'هذا الحقل مطلوب' ,
            'email'=> 'هذا الحقل يجب ان يكون ايميل' ,
        ];
        return Validator::make($data , $rules , $messages);
    }
}/*
$admin=new App\Admin\Models\Admin();
$admin-> name ="Mohammed Awn5";
$admin-> email ="mohammedawn9123@gmail.com";
$admin-> password =bcrypt("123456");
$admin->save();*/
