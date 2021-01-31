<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use App\Traits\AuthTrait;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;
    use AuthTrait ;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {

        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> ' ,
            'href' => 'shop'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'Register',
            'href' => 'register'
        );
        Session::flash('breadcrumbs' , $breadcrumb);
        $data =$this->getTopPageInfo();
        $data['countries'] = Country::getList();
        return view('auth.register' , $data);
    }
    public function register(Request $request)
    {
        $data = $request->all();
        $data['status']=1;
        $data['customer_group']=1;
        $dataMapping = $this->mappingValidator($data);
        $validator =  Validator::make($data, $dataMapping['validate'], $dataMapping['messages']);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
         Customer::createCustomer($dataMapping['dataInsert']);
       if(Auth::guard('web')->attempt(['email'=>$request->input("email") , 'password'=>$request->input("password")  ]))
        {
            $success= 'you are registered successfully..' ;
            Session::flash('success' , $success);
            return redirect()->route('shop');
        }


        return redirect()->route('register');
    }


}
