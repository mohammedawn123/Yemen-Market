<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_special extends Model
{
    protected $table = 'product_specials' ;
    protected $primaryKey = 'product_special_id' ;
    public $timestamps = false;

    protected $guarded = [];

    public function product()
    {
        return $this->beLongsTo('App\Product' , 'product_id' , 'product_id');
    }
}
