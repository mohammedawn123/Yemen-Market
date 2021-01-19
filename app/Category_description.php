<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_description extends Model
{
    protected $table = 'category_descriptions' ;

    protected $primaryKey = 'category_id'  ;
    /**
     * @return string
     */

    protected $fillable = [
        'name' ,'language_id' ,  'description' ,'meta_title' ,'meta_description'  , 'meta_keyword','id','category_id'
    ];




      public function Parent_description()
    {
    	return $this->beLongsTo('App\Mcategory' , 'category_id' , 'parent_id');

    }
    public function getTable(): string
    {
        return $this->table;
    }
}
