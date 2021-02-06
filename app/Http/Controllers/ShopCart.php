<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopCart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb['breadcrumbs'][] = array(
            'text' =>  '<i class="fa fa-home"></i> ' ,
            'href' => 'shop'
        );
        $breadcrumb['breadcrumbs'][] = array(
            'text' => 'My Cart',
            'href' => 'cart.list'
        );
        Session::flash('breadcrumbs' , $breadcrumb);

        $data =$this->getTopPageInfo();
        $data['countries'] = Country::getList();

        return view('shop.cart' , $data);
    }


    public function addToCart(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('shop');
        }
     /*   if(!Auth::user()) {
            return response()->json(
                [
                    'error' => 1,
                    'redirect' => route('shop.loginForm'),
                    'msg' => '',
                ]
            );
        }*/
        $id=$request->get('id');
        $instance = $request->get( 'instance');
        $quantity = $request->get( 'quantity') ?? 1;
        $product=(new Product)->getDetail($id);
        $price=$product->getFinalPrice($id , $quantity);


        $cart = Cart::instance($instance) ;
        $cart->add($id , $product->name ,$quantity ,$price,[], $product->getTaxRate());

        $listCart = $cart->getListCart($instance);
        return response()->json(
            [
                'error'      => 0,
                'count_cart' => $listCart['count'],
                'instance'   => $instance,
                'subtotal'   =>  $listCart['subtotal'] ,
                'total'      => $listCart['count'] . ' item(s) - '. $listCart['total'] ,
                'msg'        => trans('cart.success', ['instance' => ($instance == 'default') ? 'cart' : $instance]),
            ]
        );
    }

    public function removeItem($id ,$instance)
    {
        if (array_key_exists($id, Cart::instance($instance)->content()->toArray())) {
            Cart::instance($instance)->remove($id);
        }
          $route= ($instance== 'default') ? 'cart.list' : 'customer.index' ;
        return redirect()->route($route);
    }

    public function updateItem()
    {
        $product_id= \request()->get('id');
        $instance= \request()->get('instance');
        $quantity= \request()->get('qty');
        $content = Cart::instance($instance)->content();
        if($content->has($product_id))
        {
            $old = $content->pull($product_id);
            $price=(new Product)->getFinalPrice($product_id , $quantity);
            Cart::instance($instance)->add($product_id, $old->name, $quantity,$price, [], $old->tax);
       }
       return response()->json([
           'error'      => 0,
           'msg'        => trans('cart.update'),
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
