<?php

namespace App\Http\Controllers\Auth;

use App\Admin\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   // use AuthenticatesUsers;


    public function showLoginForm()
    {
        if (Auth::guard('web')->user()) {
            return redirect()->route('shop');
        }
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> ' ,
            'href' => 'shop'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'Login',
            'href' => 'shop.loginForm'
        );
        Session::flash('breadcrumbs' , $breadcrumb);
        $data =$this->getTopPageInfo();

        return view('auth.login' ,$data);
    }
    public function  Login(Request $request)
    {
      $validator=$this->login_validation($request->only(['email' , 'password']));

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if(Auth::guard('web')->attempt(['email'=>$request->input("email") , 'password'=>$request->input("password")  ]))
        {
            return redirect()->route('shop')->with(['success' => 'you are login successfully']);
        }else{

            return view('auth.login' )->with(['error_login'=>' Warning: No match for E-Mail Address and/or Password.']);
        }


    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return  redirect()->route('shop');
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
}
