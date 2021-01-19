<?php
namespace App\Traits;
use App\Models\Country;
use App\Models\Customer;

trait AuthTrait
{

    public function mappingValidatorEdit($data) {
        $arraycountry = (new Country)->pluck('code')->toArray();

        $dataUpdate = [
            'first_name' => $data['first_name'] ,
            'last_name'  =>  $data['last_name']??'',
            'address_1'  => $data['address1']??'',
            'address_2'  => $data['address2']??'',
            'phone'      => $data['phone']??'',
            'postcode'   => $data['postcode']??'',
            'sex'        => $data['sex']?? 1,
            'birthday'          => $data['birthday']?? null,
            'country'           => $data['country']?? 'YE',
            'city'              => $data['city']?? '',
            'customer_group_id' => $data['customer_group']?? 1,
            'status'            => $data['status']?? 1,
        ];
        $validate = [
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'address1' => 'required|string|max:100',
            'address2' => 'required|string|max:100',
            'phone'    => 'required|regex:/^0[^0][0-9\-]{7,13}$/',
            'postcode' => 'nullable|min:5',
            'sex'      => 'required',
            'birthday' =>  'nullable|date|date_format:YYYY-MM-DD' ,
            'country'  => 'required|string|min:2|in:'. implode(',', $arraycountry),
            'city'  => 'nullable|string|min:2',
            'customer_group_id' => 'required|integer|max:10',
            'status' => 'required|integer|max:10'
        ];

        if (!empty($data['password'])) {
            $dataUpdate['password'] = bcrypt($data['password']);
            $validate = [
                'password' => 'required|required_with:Confirmation|string|min:6',
                'Confirmation' =>'same:password',
                ];
        } else {
            $validate = ['password' => 'nullable|string|min:6' ];
        }
        if (!empty($data['email'])) {
            $dataUpdate['email'] = $data['email'];
            $validate['email'] = 'required|string|email|max:255|unique:' . (new Customer)->getTable() . ',email, '.$data['customer_id'].',customer_id';
        }


        $messages = [
            'last_name.required' => trans('validation.required',['attribute'=> trans('customer.last_name')]),
            'first_name.required' => trans('validation.required',['attribute'=> trans('customer.first_name')]),
            'email.required' => trans('validation.required',['attribute'=> trans('customer.email')]),
            'password.required' => trans('validation.required',['attribute'=> trans('customer.password')]),
            'address1.required' => trans('validation.required',['attribute'=> trans('customer.address1')]),
            'address2.required' => trans('validation.required',['attribute'=> trans('customer.address2')]),
            'phone.required' => trans('validation.required',['attribute'=> trans('customer.phone')]),
            'country.required' => trans('validation.required',['attribute'=> trans('customer.country')]),
            'postcode.required' => trans('validation.required',['attribute'=> trans('customer.postcode')]),
            'sex.required' => trans('validation.required',['attribute'=> trans('customer.sex')]),
            'birthday.required' => trans('validation.required',['attribute'=> trans('customer.birthday')]),
            'email.email' => trans('validation.email',['attribute'=> trans('customer.email')]),
            'phone.regex' => trans('validation.regex',['attribute'=> trans('customer.phone')]),
            'password.confirmed' => trans('validation.confirmed',['attribute'=> trans('customer.password')]),
            'postcode.min' => trans('validation.min',['attribute'=> trans('customer.postcode')]),
            'password.min' => trans('validation.min',['attribute'=> trans('customer.password')]),
            'country.min' => trans('validation.min',['attribute'=> trans('customer.country')]),
            'first_name.max' => trans('validation.max',['attribute'=> trans('customer.first_name')]),
            'email.max' => trans('validation.max',['attribute'=> trans('customer.email')]),
            'address1.max' => trans('validation.max',['attribute'=> trans('customer.address1')]),
            'address2.max' => trans('validation.max',['attribute'=> trans('customer.address2')]),
            'last_name.max' => trans('validation.max',['attribute'=> trans('customer.last_name')]),
            'birthday.date' => trans('validation.date',['attribute'=> trans('customer.birthday')]),
            'birthday.date_format' => trans('validation.date_format',['attribute'=> trans('customer.birthday')]),
           ];
        $dataMap = [
            'validate' => $validate,
            'messages' => $messages,
            'dataUpdate' => $dataUpdate
        ];
        return $dataMap;
    }

    public function mappingValidator($data) {

        $arraycountry = (new Country)->pluck('code')->toArray();

        $dataInsert = $this->mappDataInsert($data);
        $validate = [
            'first_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:' . (new Customer)->getTable() . ',email',
            'password' => 'required|required_with:Confirmation|string|min:6',
            'Confirmation' =>'same:password',
        ];

            $validate['last_name'] = 'required|string|max:100';
            $validate['address1'] = 'required|string|max:100';
            $validate['address2'] = 'required|string|max:100';
            $validate['phone'] = 'required|regex:/^0[^0][0-9\-]{7,13}$/';
            $validate['country'] = 'required|string|min:2|in:'. implode(',', $arraycountry);
            $validate['city'] = 'nullable|string|min:2';
            $validate['postcode'] = 'nullable|string|min:5';
            $validate['sex'] = 'required|integer';
            $validate['birthday'] = 'nullable|date';
            $validate['customer_group'] = 'required|integer|max:10';

        $messages = [
            'last_name.required' => trans('validation.required',['attribute'=> trans('customer.last_name')]),
            'first_name.required' => trans('validation.required',['attribute'=> trans('customer.first_name')]),
            'email.required' => trans('validation.required',['attribute'=> trans('customer.email')]),
            'password.required' => trans('validation.required',['attribute'=> trans('customer.password')]),
            'address1.required' => trans('validation.required',['attribute'=> trans('customer.address1')]),
            'address2.required' => trans('validation.required',['attribute'=> trans('customer.address2')]),
            'phone.required' => trans('validation.required',['attribute'=> trans('customer.phone')]),
            'country.required' => trans('validation.required',['attribute'=> trans('customer.country')]),
            'postcode.required' => trans('validation.required',['attribute'=> trans('customer.postcode')]),
            'company.required' => trans('validation.required',['attribute'=> trans('customer.company')]),
            'sex.required' => trans('validation.required',['attribute'=> trans('customer.sex')]),
            'birthday.required' => trans('validation.required',['attribute'=> trans('customer.birthday')]),
            'email.email' => trans('validation.email',['attribute'=> trans('customer.email')]),
            'phone.regex' => trans('validation.regex',['attribute'=> trans('customer.phone')]),
            'password.confirmed' => trans('validation.confirmed',['attribute'=> trans('customer.password')]),
            'postcode.min' => trans('validation.min',['attribute'=> trans('customer.postcode')]),
            'password.min' => trans('validation.min',['attribute'=> trans('customer.password')]),
            'country.min' => trans('validation.min',['attribute'=> trans('customer.country')]),
            'first_name.max' => trans('validation.max',['attribute'=> trans('customer.first_name')]),
            'email.max' => trans('validation.max',['attribute'=> trans('customer.email')]),
            'address1.max' => trans('validation.max',['attribute'=> trans('customer.address1')]),
            'address2.max' => trans('validation.max',['attribute'=> trans('customer.address2')]),
            'last_name.max' => trans('validation.max',['attribute'=> trans('customer.last_name')]),
            'birthday.date' => trans('validation.date',['attribute'=> trans('customer.birthday')]),
            'birthday.date_format' => trans('validation.date_format',['attribute'=> trans('customer.birthday')]),
            ];
        $dataMap = [
            'validate' => $validate,
            'messages' => $messages,
            'dataInsert' => $dataInsert
        ];
        return $dataMap;
    }
    public function mappDataInsert($data) {

        $dataInsert = [
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'last_name'=> $data['last_name'] ?? '',
        ];


            $dataInsert['address_1'] = $data['address1'] ?? '';
            $dataInsert['address_2'] = $data['address2'] ?? '';
            $dataInsert['phone'] =  $data['phone'] ?? '';
            $dataInsert['country'] = $data['country'] ?? 'YE';
            $dataInsert['city'] = $data['city'] ?? '';
            $dataInsert['postcode'] = $data['postcode'] ?? '';
            $dataInsert['sex'] = $data['sex'] ?? 0;
            $dataInsert['birthday'] = $data['birthday'] ?? '';
            $dataInsert['customer_group_id'] = $data['customer_group'] ?? 1;
            $dataInsert['status'] = $data['status'] ?? 1;
            $dataInsert['ip'] = $data['ip'] ?? 'eee';
        return $dataInsert;
    }
}
