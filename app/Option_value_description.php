<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option_value_description extends Model
{
    protected $fillable = [
        'id', 'option_value_id', 'language_id', 'name'
    ];

    public function Option_value()
    {
        return $this->beLongsTo('App\Option_value' , 'option_value_id');
    }
}
