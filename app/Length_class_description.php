<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Length_class_description extends Model
{
    protected $fillable = [
        'id', 'length_class_id', 'language_id' , 'title' , 'unit'
    ];

    public function Length_class()
    {
        return $this->beLongsTo('App\Length_class' , 'length_class_id' , 'length_class_id');
    }
}
