<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

public $table='manufacturers';
    public $timestamps=false;
    protected $fillable = [
        'id', 'name', 'image','email' ,'phone' , 'address', 'status','sort_order'
    ];
    public function Manufacturer_to_store()
    {
        return $this->hasMany('App\Manufacturer_to_store' , 'manufacturer_id');
    }



}
