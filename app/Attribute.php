<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $table = 'attributes';
    protected $primaryKey = 'attribute_id' ;
    public $timestamps=false;
    protected $fillable = [
         'attribute_id' , 'attribute_group_id', 'sort_order'
    ];
    protected $hidden = [
        'id'
    ];
    public function Attribute_description()
    {
        return $this->hasMany('App\Attribute_description' , 'attribute_id' , 'attribute_id');
    }

    public function Attribute_group()
    {
        return $this->belongsTo('App\Attribute_group' , 'attribute_group_id' , 'attribute_group_id');
    }
    public function products()
    {
        return $this->belongsToMany('App\Product' , 'product_attributes' , 'attribute_id' , 'product_id' );
    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($attribute) {
            $attribute->Attribute_description()->delete();
            $attribute->products()->detach();

        });
    }
}
