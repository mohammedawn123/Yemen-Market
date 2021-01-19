<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_discount extends Model
{
    protected $table = 'product_discounts' ;
    protected $primaryKey = 'product_discount_id' ;
    public $timestamps = false;

    protected $guarded = [];

    public function product()
    {
        return $this->beLongsTo('App\Product' , 'product_id' , 'product_id');
    }
}
