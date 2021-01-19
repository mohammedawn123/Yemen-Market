<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable
{
    protected $table='customers';
    protected $primaryKey='customer_id';
    protected $guarded = [];
    public $timestamps=false;

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id', 'customer_id');
    }
    public function orders()
    {
        return $this->hasMany(ShopOrder::class, 'customer_id', 'customer_id');
    }
    public function group()
    {
        return $this->hasOne(CustomerGroup::class, 'customer_group_id', 'customer_group_id');
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;

    }
    public static function createCustomer($dataInsert)
    {

        $dataAddress = [
            'first_name' => $dataInsert['first_name'] ?? '',
            'last_name' => $dataInsert['last_name'] ?? '',
            'postcode' => $dataInsert['postcode'] ?? '',
            'address_1' => $dataInsert['address_1'] ?? '',
            'address_2' => $dataInsert['address_2'] ?? '',
            'country' => $dataInsert['country'] ?? '',
            'city' => $dataInsert['city'] ?? '',
            'phone' => $dataInsert['phone'] ?? '',
        ];
        $customer = self::create($dataInsert);
        $address = $customer->addresses()->save(new CustomerAddress($dataAddress));
        $customer->address_id = $address->address_id;
        $customer->save();
        return $customer;
    }
    public static function updateInfo($dataUpdate, $customer_id)
    {
        $obj = self::find($customer_id);
        return $obj->update($dataUpdate);
    }
    public static function getListAll()
    {
        return self::get()->keyBy('customer_id');
    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($product) {
          /*  $product->Product_description()->delete();
            $product->product_discounts()->delete();
            $product->product_specials()->delete();
            $product->categories()->detach();
            $product->attributes()->detach();*/

        });
    }
}
