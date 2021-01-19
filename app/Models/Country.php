<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';
    public $timestamps  = false;
    protected $fillable = [
        'id', 'code', 'name'
    ];

    private static $getListCountries = null;
    private static $getCodeAll = null;

    public static function getList()
    {
        if (self::$getListCountries == null) {
            self::$getListCountries = self::get()->keyBy('code');
        }
        return self::$getListCountries;
    }
    public static function getCodeAll()
    {

            if (self::$getCodeAll === null) {
                self::$getCodeAll = self::pluck('name', 'code')->all();
            }
            return self::$getCodeAll;

    }
    public static function getByCode($code)
    {
            return self::where('code' ,$code)->pluck('name', 'code')->first();


    }

}
