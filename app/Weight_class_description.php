<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight_class_description extends Model
{

    protected $fillable = [
        'id', 'weight_class_id', 'language_id' , 'title' , 'unit'
    ];

    public function Weight_class()
    {
        return $this->beLongsTo('App\Weight_class' , 'weight_class_id' , 'weight_class_id');
    }

}
