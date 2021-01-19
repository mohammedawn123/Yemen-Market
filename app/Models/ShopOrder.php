<?php

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    protected $table ='shop_orders';
    protected $guarded = [];
    public static $mapStyleStatus = [
        '1' => 'info', //new
        '2' => 'primary', //processing
        '3' => 'warning', //Hold
        '4' => 'danger', //Cancel
        '5' => 'success', //Success
        '6' => 'default', //Failed
    ];

    public function details()
    {
        return $this->hasMany(ShopOrderDetail::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    public function orderStatus()
    {
        return $this->hasOne(ShopOrderStatus::class, 'id', 'status');
    }
    public function orderTotal()
    {
        return $this->hasMany(ShopOrderTotal::class, 'order_id', 'id');
    }
    public function getOrderNew() {
       return $this->where('status', 1)  ;

    }
    public function getOrderProcessing() {
       return $this->where('status', 2)  ;

    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($order)
        {
            foreach ($order->details as $key => $orderDetail)
            {
                Product::updateQuantity($orderDetail->product_id, -$orderDetail->quantity);
            }
            $order->details()->delete();
            $order->orderTotal()->delete();

        });
    }
}
