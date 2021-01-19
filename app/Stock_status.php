<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock_status extends Model
{

    protected $fillable = [
        'id', 'status_id', 'language_id' , 'name'
    ];

    public function Product()
    {
        return $this->hasMany('App\Product' );
    }
}
