<?php

namespace App\Http\Controllers;

use App\Product;
use App\Manufacturer;
use  Cart ;
class ShopFrontController extends Controller
{
    public function index()
    {
        $breadcrumb['breadcrumbs'][] = array();
     /*   Cart::instance('default')->add(55 , 'rrrrrrrrrr' ,33.0 , 2000.0 ,[], 4);
        $test=Cart::instance('default')->add(44 , 'rrrrrrrrrr' ,33.0 , 2000.0 ,[], 4);*/

        $data =$this->getTopPageInfo();
        // get new products
        $LatestProducts=(new Product)->getAllProducts()
            ->orderby('products.product_id', 'desc')
            ->limit(12)->get();
        $data['LatestProducts'] =$LatestProducts;

        // get manufacturers
        $Manufacturers=(new Manufacturer)->get();
        $data['Manufacturers'] =$Manufacturers;

        return view('shop.home' , $data);
    }
 }
