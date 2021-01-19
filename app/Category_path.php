<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category_path extends Model
{
	protected $table = 'category_paths' ;
    protected $primaryKey = 'category_id'  ;
    protected $fillable = [
        'category_id','path_id', 'level'  ];

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }



    public function Mcategory()
    {
    	return $this->beLongsTo('App\Mcategory' , 'category_id');
    }


}
