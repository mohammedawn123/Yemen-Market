@extends('layouts.admin.index')
 @section('content')
     <div class="row print" style="    display: none;">
         <div class="col-md-12">
             <div class="card">
                 <div class="row" id="order-body">


                     <table>
         <tbody>
         <tr class="col-md-12">

                 <td class="col-sm-6">
                     <img style="width: 250px;"  src="http://127.0.0.1:8000/view/image/AdminLTELogo.png" alt="Yemen Market" title="Yemen Market">
                 </td>
                 <td class="col-sm-6">     </td>

         </tr>
         </tbody>
     </table>

                     <br>
                     <br>
                     <br>
                     <br>
                     <br>
                     </div>
                     </div>
                     </div>

                     </div>

     <div class="container-fluid">
         <div class="panel panel-default">
             <div class="panel-heading">
                 <h3 class="panel-title"><i class="fa fa-shopping-cart"> </i> Order #{{$order->id}}</h3>
             </div>

             <div class="panel-body">

             <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="row" id="order-body">
                         <div style="padding-right: 25px; padding-left: 25px;" class="col-sm-6">
                           <br>
                             <h4>Customer Details</h4>
                             <table>
                                 <tbody>
                                 <tr>
                                     <td class="td-title">First name:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->first_name}}</a>
                                     </td>
                                 </tr>

                                 <tr>
                                     <td class="td-title">Last name:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->last_name}}</a>
                                     </td>
                                 </tr>

                                 <tr>
                                     <td class="td-title">Phone:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->phone}}</a>
                                     </td>
                                 </tr>

                                 <tr>
                                     <td class="td-title">E-mail:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;" >{{$order->email}}</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="td-title">Address 1:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->address1}}</a>
                                     </td>
                                 </tr>

                                 <tr>
                                     <td class="td-title">Address 2:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->address2}}</a>
                                     </td>
                                 </tr>

                                 <tr>
                                     <td class="td-title">Country:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->country}}</a>
                                     </td>
                                 </tr>

                                 </tbody>
                             </table>
                         </div>

                         <div style="padding-right: 25px; padding-left: 25px;"   class="col-sm-6">
                             <br>
                             <h4>Order Details</h4>
                             <table>
                                 <tbody>
                                 <tr>
                                     <td class="td-title">Order status:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->status}}</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>Shipping status:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#"  style="text-decoration: none;">{{$order->shipping_status}}</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>Payment status:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->payment_status}}</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>Shipping method:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->shipping_method}}</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>Payment method:</td>
                                     <td style="padding-left: 10px;">
                                         <a href="#" style="text-decoration: none;">{{$order->payment_method}}</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="td-title"><i class="far fa-money-bill-alt nav-icon"></i> Currency:</td>
                                     <td style="padding-left: 10px;" >{{$order->currency}}</td>
                                 </tr>
                                 <tr>
                                     <td class="td-title"><i class="fas fa-chart-line"></i> Exchange rate:</td>
                                     <td style="padding-left: 10px;">{{$order->exchange_rate}}</td>
                                 </tr>
                                 </tbody>
                             </table>

                         </div>

                     </div>



                           <input type="hidden" name="order_id" value="3">
                         <div class="row">

                             <div style="padding-right: 25px; padding-left: 25px; padding-top: 25px;"  class="col-sm-12">
                                 <h4>Order Products </h4>   <div class="card collapsed-card">

                                     <div class="table-responsive">
                                         <table class="table table-bordered">
                                             <thead>
                                             <tr>
                                                 <th class="text-center" style="width: 60px; ">Image</th>
                                                 <th>Name</th>
                                                 <th>SKU</th>
                                                 <th class="product_price">Price</th>
                                                 <th class="product_qty">Quantity</th>
                                                 <th class="product_total">Total</th>
                                                 <th class="product_tax">Tax</th>

                                             </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($order_details as $key=>$value)
                                             <tr>
                                                 <td class="text-center"   style="width: 60px; ">
                                                  <img class="img-thumbnail" src="{{asset('view/image/'. $value['image'].'')}}" style=" height:50px;">
                                                 </td>
                                                 <td>{{$value['name']}}</td>
                                                 <td>{{$value['sku']}}</td>
                                                 <td class="product_price">{{currency_symbol($value['price'] , $value['currency'])}}</td>
                                                 <td class="product_qty">{{$value['quantity']}}</td>
                                                 <td class="product_total item_id_7">{{currency_symbol($value['total_price'] , $value['currency'])}}</td>
                                                 <td class="product_tax">{{currency_symbol($value['tax'] , $value['currency'])}}</td>

                                             </tr>
                                             @endforeach


                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>

                         </div>

<br>
                     <div class="row">
                         <div style="padding-right: 25px; padding-left: 25px;" class="col-sm-6">
                             <div>
                                 <table>
                                     <h4>    Order Totals  </h4>
                                     <tbody>
                                     <tr>
                                         <td >Subtotal:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;">{{currency_symbol($order->subtotal , $order->currency)}}</a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>Tax:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;">{{currency_symbol($order->tax , $order->currency)}}</a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>Shipping:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;">{{currency_symbol($order->shipping , $order->currency)}}</a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>Discount:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#"  style="text-decoration: none;">{{currency_symbol($order->discount , $order->currency)}}</a></td>
                                     </tr>

                                     <tr style="background:#f5f3f3;font-weight: bold;">
                                         <td>Total:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;">{{currency_symbol($order->total , $order->currency)}}</a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>Received:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;">{{currency_symbol($order->received  , $order->currency)}}</a>
                                         </td>
                                     </tr>

                                     <tr style="font-weight:bold;" >
                                         <td>Balance:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;" >{{currency_symbol($order->balance , $order->currency)}}</a>
                                         </td>
                                     </tr>
                                     </tbody>
                                 </table>
                                 <br>
                                 <br>
                             </div>

                         </div>



                         <div style="padding-right: 25px; padding-left: 25px;" class="col-sm-6">
                             <div>
                                 <table>
                                     <tbody>
                                     <tr>
                                         <td class="td-title">Order note:</td>
                                         <td style="padding-left: 10px;">
                                             <a href="#" style="text-decoration: none;" >
                                              {{$order->comment}}
                                             </a>
                                         </td>
                                     </tr>
                                     </tbody>
                                 </table>
                             </div>




                     </div>

                 </div>
             </div>
         </div>
     </div>
     </div>
     </div>
     </div>



    @endsection
@push('attribute_group_scripts')
    <script type="text/javascript">
        function order_print(){

            $('.not-print').hide();
            $('.print').show();

            window.print();
            $('.print').hide();
            $('.not-print').show();

        }
    </script>

@endpush
