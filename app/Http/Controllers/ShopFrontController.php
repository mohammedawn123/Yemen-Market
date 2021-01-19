<?php

namespace App\Http\Controllers;

use App\Mcategory;
use App\Product;
class ShopFrontController extends Controller
{
    public function index()
    {
        $LatestProducts=(new Product)->getAllProducts()
                                     ->orderby('products.product_id', 'desc')
                                     ->limit(12)->get();
        $data['LatestProducts'] =$LatestProducts;

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


        return view('shop.home' , $data);
    }
/*
    public function getTree($parent_id=0)
    {

        $menu='';
        $cats=(new Mcategory)->getCategories($parent_id )->get();

      foreach ($cats as $cat) {
          $menu .='<li class="dropdown"> <a href="" class="dropdown-toggle" data-toggle="dropdown">'.$cat->name.' </a>' ;
           $menu .='<ul class="dropdown">   <div class="dropdown-menu" style="">
                            <div class="dropdown-inner">'.$this->getTree($cat->category_id).'</div></div>  </ul> ' ;
           $menu .='</li>' ;
      }

return $menu ;
    }




    public function getmenu()
    {
//$category=Mcategory::find(40)->childs_of_category()->get()->toArray();
  $menu=[];
$category=Mcategory::select('*')->get();
     foreach ($category as  $kew=>$value) {
        if ($value['parent_id']) {
         $menu[$value['parent_id']]['submenu']=    (new Mcategory)->getCategories($value['parent_id'])->get()->keyby('category_id')->toarray();
        }else{
             $menu[$value['category_id']]=  (new Mcategory)->getCategory($value['category_id'])->get()->toarray();
        }
        }

return $menu ;
    }
*/}
