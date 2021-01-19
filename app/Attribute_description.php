<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_description extends Model
{
    public $table = 'attribute_descriptions';
    protected $primaryKey = 'attribute_id' ;
    public $timestamps=false;
    protected $fillable = [
        'id', 'attribute_id', 'language_id' , 'name'
    ];

    public function Attribute()
    {
        return $this->beLongsTo('App\Attribute' , 'attribute_id' , 'attribute_id');
    }
}
