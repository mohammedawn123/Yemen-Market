<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOrderStatus extends Model
{

    public $table = 'shop_order_statuses';
    protected $guarded           = [];
    public $timestamps     = false;
    protected static $listStatus = null;

    public static function getAll()
    {
        if (!self::$listStatus) {
            self::$listStatus = self::pluck('name', 'id')->all();
        }
        return self::$listStatus;
    }
}
