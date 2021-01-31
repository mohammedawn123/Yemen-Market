<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;

class ShopCart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function addToCart(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('shop');
        }
        if(!Auth::user()) {
            return response()->json(
                [
                    'error' => 1,
                    'redirect' => route('shop.loginForm'),
                    'msg' => '',
                ]
            );
        }
        $id=$request->get('id');
        $instance = $request->get( 'instance');
        $product=(new Product)->getDetail($id);

        $cart = Cart::instance($instance) ;
        $cart->add($id , $product->name ,1.0 ,$product->getPriceAfterDiscount(),[], $product->getTaxRate());

        $carts = Cart::getListCart($instance);
        return response()->json(
            [
                'error'      => 0,
                'count_cart' => $carts['count'],
                'instance'   => $instance,
            //    'subtotal'   => $carts['count'] . ' item(s) - '. $carts['subtotal'] ,
                'subtotal'   =>  $carts['subtotal'] ,
                'total'   => $carts['count'] . ' item(s) - '. $carts['total'] ,
                'msg'        => trans('cart.success', ['instance' => ($instance == 'default') ? 'cart' : $instance]),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
