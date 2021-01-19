<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option_value extends Model
{
    protected $fillable = [
        'id', 'option_value_id' , 'option_id', 'image', 'sort_order'
    ];

    public function Option_value_description()
    {
        return $this->hasMany('App\Option_value_description' , 'option_value_id');
    }
    public function Option()
    {
        return $this->beLongsTo('App\Option' , 'option_id');
    }
}
