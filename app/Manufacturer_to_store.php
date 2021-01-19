<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer_to_store extends Model
{
    protected $fillable = [
        'manufacturer_id', 'store_id'
    ];
   public function Manufacturer()
    {
        return $this->beLongsTo('App\Manufacturer' , 'id' );

    }
}
