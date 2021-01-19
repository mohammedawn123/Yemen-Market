<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option_description extends Model
{
    protected $fillable = [
        'id', 'option_id', 'language_id', 'name'
    ];

    public function Option()
    {
        return $this->beLongsTo('App\Option' , 'option_id');
    }

}
