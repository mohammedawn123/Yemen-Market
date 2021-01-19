<?php

use App\Admin\Models\Admin;
use App\Models\ShopCurrency;
use App\Models\ShopOrder;
use Illuminate\Support\Facades\Cache;


if (!function_exists('currency_symbol')) {

    function currency_symbol(float $price, $currency = null)
    {
        $currency = $currency ? $currency : currency_code();
        return ShopCurrency::formatPrice($price, $currency);
    }
}

if (!function_exists('currency_code')) {
    function currency_code()
    {
        return ShopCurrency::getCode();
    }
}

if (!function_exists('pagination_rows')) {
    function pagination_rows()
    {
        return  [
            '2'   => '2',
            '5'   => '5',
            '10'   => '10',
            '15'    => '15',
            '20' => '20',
            '25'  => '25',
            '30' => '30',
            '50'  => '50',
            '100'  => '100',
        ];
    }
}

if (!function_exists('tax_price')) {
    function tax_price($price, $tax)
    {
        return floor($price * (100 + $tax) /100);
    }
}

if (!function_exists('get_tax')) {
    function get_tax($total_price, $total_tax)
    {
        return floor(($total_tax * 100) /$total_price);
    }
}

if (!function_exists('orders_progress')) {
    function orders_progress()
    {
        $all=((new ShopOrder)->count() > 0) ? (new ShopOrder)->count() : 1;
        $new=(new ShopOrder)->getOrderNew()->count() ;
        $processing=(new ShopOrder)->getOrderProcessing()->count();
        $others=($all-$new-$processing) > 1 ? $all-$new-$processing : 0 ;
        return array(
            'new'=>(100/$all)*$new ,
            'processing'=>(100/$all)*$processing ,
            'others'=>(100/$all)*$others ,
        );

    }
}

if (!function_exists('pagination')) {
    function pagination($object)
    {
        return array(
            'pagination'  =>$object->appends(request()->except(['_token', '_pjax']))->links('admin.pagination'),
            'resultItems' =>trans('pagination.page_show').' <b>' . $object->firstItem(). '</b> '.trans('pagination.page_to').' <b>' .$object->lastItem(). '</b> '.trans('pagination.page_of').' <b>' . $object->total(). '</b> '.trans('pagination.page_rows')
        );

    }
}


if (!function_exists('selectOptions')) {
    function selectOptions($arrData , $selected )
    {
        $options='';
        foreach ($arrData as $key => $value) {
            $options .= '<option  ' . (($selected == $key) ? "selected" : "") . ' value="' . $key . '">' . $value . '</option>';
        }
        return $options;

    }
}

if (!function_exists('image_thumbnail')) {
    function image_thumbnail($url)
    {
        return '<img    src="'.asset( '/view/image/'.$url) .'" class="img-thumbnail" style=" width:50px; height:50px;">' ;
    }
}

if (!function_exists('getActionColumn')) {
    function getActionColumn($rout , $id , $flag1=null)
    {
        return ' <a href="'.route($rout ,  ['id' => $id ]).'" >
                             <span  data-toggle="tooltip"  data-original-title="'.trans('list.button_edit').'" type="button"    class="btn btn-flat btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span> </a> &nbsp;
                            <span '. $flag1 .' onclick="deleteItem(' .$id. ');"  data-toggle="tooltip"  data-original-title="' . trans('list.button_delete') . '" class="btn btn-flat btn-danger">
                               <i class="fa fa-trash"></i>
                           </span>' ;
    }
}


if (!function_exists('getStatusColumn')) {
    function getStatusColumn($status)
    {
        return $status===1 ? '<span style="font-weight: 700;font-size: 75%;"  class="badge badge-info">'.trans('list.text_enabled').'</span>'  :
                            '<span style="font-weight: 700;font-size: 75%;"  class="badge badge-danger">'.trans('list.text_disabled').'</span>' ;
    }
}

if (!function_exists('getTopButtons')) {
    function getTopButtons($url)
    {
        return  '<a href='.$url.' >
                                 <span   data-toggle="tooltip"  data-original-title="'.trans('list.button_add').'" type="button"    class="btn btn-flat btn-primary">
                                  <i class="fa fa-plus"></i>
                                </span>
                               </a> &nbsp;
                             <a class="btn btn-default grid-refresh"  data-toggle="tooltip" data-original-title="'.trans('list.button_refresh').'">
                                          <i class="fa fa-refresh"></i> </a>
                                           ';
    }
}

if (!function_exists('onlineUsers')) {

    function onlineUsers()
    {

        $users = Cache::get('online-users');
        if (!$users) return null;

        $onlineUsers = collect($users);

        $dbUsers = Admin::find($onlineUsers->pluck('id')->toArray());

        $displayUsers = [];


        foreach ($dbUsers as $user) {

            $onlineUser = $onlineUsers->firstWhere('id', $user['id']);

            $displayUsers[] = [
                'id' => $user->id,
                'name' => $user->name,
                'last_activity_at' => ($onlineUser['last_activity_at']),
                'photo' => $user->photo,
                'online' => $onlineUser['last_activity_at'] > now()->subMinutes(1),
            ];
        }
        return $displayUsers;
    }
}
