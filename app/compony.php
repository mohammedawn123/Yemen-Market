<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compony extends Model
{

	 protected $fillable = [
        'id', 'c_name', 'adress',
    ];

    public function user()
    {

    	return $this->hasMany('App\User' , 'id'  );
    }
}
