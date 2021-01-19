<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupDescription extends Model
{
    protected $table='group_descriptions';
    protected $primaryKey='customer_group_id';
    protected $guarded = [];
    public $timestamps=false;

}
