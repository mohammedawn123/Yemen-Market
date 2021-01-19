<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tax_class extends Model
{

protected $table='tax_classes';
    protected $fillable = [
        'id', 'tax_class_id', 'title' , 'description'
    ];

    public function tax_rule()
    {
        return $this->hasMany('App\tax_rule' , 'tax_class_id' , 'tax_class_id');
    }


}
