<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tax_rate extends Model
{
    protected $table='tax_rates';
    protected $primaryKey='tax_rate_id';
    protected $fillable = [
        'id', 'tax_rate_id', 'geo_zone_id' , 'name' , 'rate' , 'type'
    ];
    public function tax_rate()
    {
        return $this->hasMany('App\tax_rate' , 'tax_rate_id' , 'tax_rate_id');
    }


    public function tax_rule()
    {
        return $this->hasMany('App\tax_rule' , 'tax_rate_id' , 'tax_rate_id');
    }


    public static function getListAll()
    {

        return self::get()->keyBy('tax_rate_id');
    }
    public static function getArrayRate()
    {
        return self::pluck('rate', 'tax_rate_id')->all();
    }
}
