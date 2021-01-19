<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_group_description extends Model
{
    protected $table = 'attribute_g_descriptions' ;
    protected $primaryKey='a_g_id';
    public $timestamps=false;
    protected $fillable = [
        'id', 'a_g_id', 'language_id' , 'name'
    ];

    public function Attribute_group()
    {
        return $this->beLongsTo('App\Attribute_group'  , 'attribute_group_id' , 'a_g_id');
    }
}
