<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    protected $table='manufacturers';
    public $timestamps=false;
    protected $primaryKey = 'id' ;
    protected $fillable = [
        'id', 'name', 'image','email' ,'phone' , 'address', 'status','sort_order'
    ];
    public function ManufacturerProducts()
    {
        return $this->hasMany('App\Product' ,   'manufacturer_id' , 'id'  );
    }

    public function getManufacturers()
    {
        return $this->where($this->getTable() . '.status' , 1);

    }
    public function getProducts()
    {
        return $this->with('ManufacturerProducts')->where($this->getTable() . '.status' , 1);

    }

}
