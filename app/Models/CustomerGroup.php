<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table='customer_groups';
    protected $primaryKey='customer_group_id';
    protected $guarded = [];
    public $timestamps=false;

    public function descriptions()
    {
        return $this->hasMany('App\Models\GroupDescription' , 'customer_group_id' , 'customer_group_id');
    }



    public  function getList()
    {
        $tableDescription = (new GroupDescription)->getTable();
        return  $this
            ->leftJoin($tableDescription, $tableDescription . '.customer_group_id', $this->getTable() . '.customer_group_id')
            ->where($tableDescription . '.language_id',session('language_id'))
            ->where($this->getTable(). '.status',1)->get()->keyby('customer_group_id')->toArray();
    }

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($CustomerGroup) {
            $CustomerGroup->descriptions()->delete();
        });
    }

}
