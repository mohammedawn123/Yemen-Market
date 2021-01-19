<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table='customer_addresses';
    protected $primaryKey='address_id';
    protected $guarded = [];
    public $timestamps=false;

}
