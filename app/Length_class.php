<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Length_class extends Model
{
    protected $fillable = [
        'id', 'length_class_id', 'value'
    ];
    public function Length_class_descriptions()
    {
        return $this->hasMany('App\Length_class_description' , 'length_class_id' , 'length_class_id');
    }
}
