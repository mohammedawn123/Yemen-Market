<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Attribute_group_description;
use App\Product;
use App\Manufacturer;
use  Cart ;
use Illuminate\Support\Facades\Session;

class ShopFrontController extends Controller
{
    public function index()
    {

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

    public function allProduct()
    {

    }
    public function productDetail($id)
    {
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> ' ,
            'href' => 'shop'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'Products',
            'href' => 'product.all'
        );
        Session::flash('breadcrumbs' , $breadcrumb);


        $product=  (new Product)->getDetail($id);

        $data=$product->toarray();

        if($product->productSpecial() != -1) {
            $data['special'] = tax_price($product->productSpecial(),$product->getTaxRate());
            $data['tax'] =tax_price($product->productSpecial(),$product->getTaxRate())- $product->productSpecial();
        }
        else{

            $data['tax'] =tax_price( $product->price,$product->getTaxRate())- $product->price;
        }
        $data['price'] =tax_price( $product->price,$product->getTaxRate());
        $data['manufacturer'] =$product->Manufacturer->name;

        // get attributes
        $product_attributes =$product->getProductAttributes($id);
        $data['product_attributes'] = array();

        foreach ($product_attributes as $product_attribute) {

            $attribute=Attribute::find($product_attribute['attribute_id']);
            $attributeDescription=$attribute->Attribute_description()->where('language_id' , session('language_id') )->get()->keyby('language_id')->toarray();
            if($attributeDescription === [])
                $attributeDescription=$attribute->Attribute_description()->where('language_id' ,1 )->get()->keyby('language_id')->toarray();
                $group_name=Attribute_group_description::where(['a_g_id'=>$attribute['attribute_group_id'] , 'language_id'=> 1])->first();
            $data['product_attributes'][] = array(
                'attribute_id'                  => $attribute['attribute_id'],
                'group_name'                    =>$group_name['name'],
                'name'                          => $attributeDescription[ session('language_id')]['name'] ?? $attributeDescription[1]['name'],
                'product_attribute_description' => $product_attribute['product_attribute_description']
            );

        }
        $data['product_discounts']= $product->product_discounts->toarray();
        $data['currencies'] =$this->getTopPageInfo()['currencies'];
        $data['categories'] =$this->getTopPageInfo()['categories'];




        return view('shop.product' ,$data);

    }
 }
