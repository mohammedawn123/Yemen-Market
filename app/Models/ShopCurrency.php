<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCurrency extends Model
{
    protected $table='shop_currencies';
    protected $guarded = [];
    public $timestamps=false;

    private static $getCurrencies     = null;
    protected static $code              = 'USD';

    public static function getListAll()
    {
        if (self::$getCurrencies == null) {
            self::$getCurrencies = self::get()->keyBy('code');
        }
        return self::$getCurrencies;
    }
    public static function getListActive()
    {
        return self::where('status', 1)
                     ->get();
    }
    public static function getCode()
    {
        return self::$code;
    }
    public static function formatPrice(float $price, $currency)
    {

        $currency = self::where('code', $currency)->first();

        $symbol         =  $currency['symbol'];
        $decimals       =  $currency['decimals'];
        $dec_point      = '.' ;
        $thousands       =  $currency['thousands'];

        if ($currency['symbol_first']) {
            if ($price < 0) {
                return '-' . $symbol . number_format($price, $decimals,$dec_point, $thousands);
            } else {
                return $symbol . number_format($price, $decimals,$dec_point, $thousands);
            }

        } else {
            return number_format($price, $decimals,$dec_point, $thousands) . $symbol;
        }
    }

    public static function getListRate()
    {
        return self::pluck('exchange_rate', 'code')->all();
    }
}
