<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table='languages';
    protected $guarded=[];
    public $primaryKey='language_id';
    public $timestamps=false;
    private static $getLanguages      = null;

    public static function getList()
    {
        if (self::$getLanguages == null) {
            self::$getLanguages = self::where('status', 1)
                ->get()
                ->keyBy('code');
        }
        return self::$getLanguages;
    }
}
