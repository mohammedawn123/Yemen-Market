<?php

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ShopOrderDetail extends Model
{
    protected $table ='shop_order_details';
    protected $guarded = [];
    protected $primaryKey = 'id' ;

    public function order()
    {
        return $this->belongsTo(ShopOrder::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'product_id');
    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($orderDetails) {
            Product::updateQuantity($orderDetails->product_id, -$orderDetails->quantity);

        });
    }

}
