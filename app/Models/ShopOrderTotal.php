<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOrderTotal extends Model
{
    protected $table='shop_order_totals';
    protected $guarded=[];

 public function updateSubtotal($order_id , $orderTotalDetails)
 {
   try {
       // update order
       $order = ShopOrder::find($order_id);
       $order->subtotal = $orderTotalDetails['subTotal'];
       $order->tax      = $orderTotalDetails['tax'] + $orderTotalDetails['tax2'];

       $total           = $orderTotalDetails['total'] ;
       $balance         = $orderTotalDetails['balance'] ;

       $payment_status = 0;
       if ($balance == $total) {
           $payment_status = 1; //Not pay
       } elseif ($balance < 0) {
           $payment_status = 4; //Need refund
       } elseif ($balance == 0) {
           $payment_status = 3; //Paid
       } else {
           $payment_status = 2; //Part pay
       }
       $order->payment_status = $payment_status;
       $order->discount = $orderTotalDetails['discount'];
       $order->shipping = $orderTotalDetails['shipping'];
       $order->total = $total;
       $order->received = $orderTotalDetails['received'];
       $order->balance = $balance;
       $order->save();

       // update orderTotal
       foreach ($orderTotalDetails as $key=>$value)
       {
           $orderTotal=self::where('order_id' , $order_id );
           $orderTotal=$orderTotal->where('code' , $key)->first();
           $orderTotal->value=$value;
           $orderTotal->save();
       }




       } catch (\Exception $e) {
         return $e->getMessage();
       }
 }
}
