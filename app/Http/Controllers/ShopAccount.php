<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShopAccount extends Controller
{
    use AuthTrait ;
    public function index()
    {
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> ' ,
            'href' => 'shop'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'My Account',
            'href' => 'customer.index'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $data =$this->getTopPageInfo();
        $data['countries'] = Country::getList();
        $data['user']=Auth::guard('web')->user();
        $id=Auth::guard('web')->user()->customer_id ;
        $data['addresses']=Customer::find($id)->addresses [0];

       return view('shop.account' ,$data);
    }

    public function update(Request $request)
    {

        $data= $request->all();
        $data['status']=1;
        $data['customer_group']=1;
        $dataMapping = $this->mappingValidatorEdit($data);
        $validator =  Validator::make($data, $dataMapping['validate'], $dataMapping['messages']);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       Customer::updateInfo($dataMapping['dataUpdate'], $data['customer_id']);

        $success= 'your Account updated successfully..' ;
        Session::flash('success' , $success);

        return redirect()->route('shop');
    }
    public function orderDetail($id)
    {

    }

    public function addressList()
    {


    }
}
