<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight_class extends Model
{

    protected $fillable = [
        'id', 'weight_class_id', 'value'
    ];
    public function Weight_class_descriptions()
    {
        return $this->hasMany('App\Weight_class_description' , 'weight_class_id' , 'weight_class_id');
    }
}
