<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_group extends Model
{
    protected $table = 'attribute_groups' ;
    protected $primaryKey='attribute_group_id' ;
    public $timestamps=false;
    protected $fillable = [
        'id', 'attribute_group_id', 'sort_order'
    ];

    public function Attribute_group_description()
    {
        return $this->hasMany('App\Attribute_group_description'  , 'a_g_id' , 'attribute_group_id');
    }
    public function Attributes()
    {
        return $this->hasMany('App\Attribute' , 'attribute_group_id' , 'attribute_group_id');
    }


    public  function getList()
    {
        $tableDescription = (new Attribute_group_description)->getTable();
        return  $this
            ->leftJoin($tableDescription, $tableDescription . '.a_g_id', $this->getTable() . '.attribute_group_id')
            ->where($tableDescription . '.language_id',session('language_id'))->get()->keyby('attribute_group_id')->toArray();
    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($attribute_group) {
            $attributes=$attribute_group->Attributes->toarray()?? [];
            $ids=[];
            foreach ($attributes as $attribute) {
                $ids[] = $attribute['attribute_id'];
            }

            $attribute_group->Attribute_group_description()->delete();
            product_attribute::destroy($ids);
            Attribute::destroy($ids);

        });
    }
}
