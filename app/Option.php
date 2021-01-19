<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'id', 'option_id', 'type', 'sort_order'
    ];

    public function Option_description()
    {
        return $this->hasMany('App\Option_description' , 'option_id');
    }
    public function Option_value()
    {
        return $this->hasMany('App\Option_value' , 'option_id');
    }
}
