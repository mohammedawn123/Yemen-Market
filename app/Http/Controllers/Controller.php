<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Mcategory;
use App\Models\ShopCurrency;
use App\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getTopPageInfo()
    {
        $currencies=ShopCurrency::get();
        $data['currencies'] =$currencies;

        $data['categories'] = array();
        $whereOpt=array('status' => 1  , 'parent_id' => 0  );
        $categories=(new Mcategory)->getAllCategories( array('whereOpt'=>$whereOpt) );

        foreach ($categories as $category)
        {
            if ($category->top) {

                $children_data = array();
                $whereOpt=array('status' => 1  , 'parent_id' => $category->category_id   );
                $children =(new Mcategory)->getAllCategories( array('whereOpt'=>$whereOpt) );

                foreach ($children as $child) {
                    $products= Mcategory::find($child->category_id)->products()->count();
                    $children_data[] = array(
                        'name'  => $child->name .   ' ('.$products.')' ,
                        'href'  => 'ddddddddd'
                    );
                }

                $data['categories'][] = array(
                    'name'     => $category->name,
                    'children' => $children_data,
                    'column'   => $category->column ? $category->column : 1,
                    'href'     => 'product/category'
                );
            }
        }


        return  $data ;
    }
}
