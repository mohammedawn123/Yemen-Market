<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_description extends Model
{
    protected $table = 'product_descriptions' ;
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $fillable = ['id' , 'product_id' , 'language_id' , 'name' , 'description' , 'tag' ,
        'meta_title' , 'meta_description' , 'meta_keyword'];

  /*  public function Product()
    {
        return $this->beLongsTo('App\Product' , 'product_id' , 'product_id');
    }*/
}
