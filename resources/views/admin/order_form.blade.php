@extends('layouts.admin.index')
 @section('content')

     @push('title')
         <title>{{$title}}</title>
     @endpush
  <div class="container-fluid">

      <div class="panel panel-default">
          <div class="panel-heading">

              <h3 class="panel-title"><i class="fa fa-user"> </i>Order Form</h3>
          </div>

      <div class="panel-body">


        <form action="{{$action}}" method="post"   class="form-horizontal" id="form-order">
            {{ csrf_field()}}
             @method('PUT')

                <div class="form-group">
                    <label for="customerId" class="col-sm-2  control-label">{{ trans('order.select_customer') }}</label>
                    <div class="col-sm-8">
                        <select class="form-control customerId" style="width: 100%;" name="customerId" >
                            <option value=""></option>
                            @foreach ($customers as $k => $v)
                                <option value="{{ $k }}" {{ (old('customerId') ==$k) ? 'selected':'' }}>{{ $v->name.'  <'.$v->email.'>' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('customerId'))
                            <span class="text-sm">
                               {{ $errors->first('customerId') }}
                             </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="email" value="{{old('email',isset($customer->first_name) ? $customer->first_name : '')}}">


                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="first_name">{{trans('customer.first_name')}}</label>
                    <div class="col-sm-8">
                        <input type="text" required name="first_name" value="{{old('first_name' ,isset($customer->first_name) ? $customer->first_name : '')}}" placeholder="{{trans('customer.first_name')}}" id="first_name" class="form-control">
                       @error('first_name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="last_name">{{trans('customer.last_name')}}</label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" value="{{old('last_name' ,isset($customer->last_name) ? $customer->last_name : '')}}" placeholder="{{trans('customer.last_name')}}" id="last_name" class="form-control">
                       @error('last_name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="address1">{{trans('customer.address1')}}</label>
                    <div class="col-sm-8">
                        <input type="text" name="address1" value="{{old('address1' ,isset($customer->address_1) ? $customer->address_1 : '')}}" placeholder="{{trans('customer.address1')}}" id="address1" class="form-control">
                        @error('address1')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="address2">{{trans('customer.address2')}}</label>
                    <div class="col-sm-8">
                        <input type="text" name="address2" value="{{old('address2' ,isset($customer->address_2) ? $customer->address_2 : '')}}" placeholder="{{trans('customer.address2')}}" id="address2" class="form-control">
                        @error('address2')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>



                  <div class="form-group required">
                        <label class="col-sm-2 control-label" for="country">
                            {{trans('customer.country')}}
                        </label>
                        <div class="col-sm-8">
                            <select name="country" id="country"
                                    class="form-control">
                                @foreach($countries as $key=>$country)
                                    <option value="{{$key}}" {{old('country' ,$customer->country ?? 'YE')==$key ? 'selected' : '' }}> {{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="phone">{{trans('customer.phone')}}</label>
                    <div class="col-sm-8">
                        <input type="text" name="phone" value="{{old('phone' ,isset($customer->phone) ? $customer->phone : '')}}" placeholder="0........" id="phone" class="form-control">
                        @error('phone')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
<br>
<br>
                <div class="form-group required">
                    <label for="currency" class="col-sm-2 control-label">{{ trans('order.currency') }}</label>
                    <div class="col-sm-8">
                        <select class="form-control currency " style="width: 100%;" name="currency" >
                            <option value=""></option>
                            @foreach ($currencies as  $v)
                                <option value="{{ $v->code }}" {{ (old('currency') == $v->code) ? 'selected':'' }}>{{ $v->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('currency'))
                            <span class="text-sm">
                                {{ $errors->first('currency') }}
                              </span>
                        @endif
                    </div>
                </div>

                <div class="form-group required">
                    <label for="exchange_rate" class="col-sm-2 control-label">{{ trans('order.exchange_rate') }}</label>
                    <div class="col-sm-8">
                            <input   type="text" id="exchange_rate" name="exchange_rate" value="{!! old('exchange_rate') !!}" class="form-control exchange_rate" placeholder="Input Exchange rate" />
                        @if ($errors->has('exchange_rate'))
                            <span class="text-sm">
                               {{ $errors->first('exchange_rate') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment" class="col-sm-2 control-label">{{ trans('order.note') }}</label>
                    <div class="col-sm-8">
                        <textarea name="comment" class="form-control comment" rows="5" placeholder="">{!! old('comment') !!}</textarea>
                    </div>
                </div>

                <div class="form-group required">
                    <label for="payment_method" class="col-sm-2 control-label">{{ trans('order.payment_method') }}</label>
                    <div class="col-sm-8">
                        <select class="form-control payment_method " style="width: 100%;" name="payment_method">
                            @foreach ($paymentMethod as $k => $v)
                                <option value="{{ $k }}" {{ (old('payment_method') ==$k) ? 'selected':'' }}>{{ sc_language_render($v)}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('payment_method'))
                            <span class="text-sm">
                                  {{ $errors->first('payment_method') }}
                              </span>
                        @endif
                    </div>
                </div>

                <div class="form-group required">
                    <label for="shipping_method" class="col-sm-2 control-label">{{ trans('order.shipping_method') }}</label>
                    <div class="col-sm-8">
                        <select class="form-control shipping_method " style="width: 100%;" name="shipping_method">
                            @foreach ($shippingMethod as $k => $v)
                                <option value="{{ $k }}" {{ (old('shipping_method') ==$k) ? 'selected':'' }}>{{ sc_language_render($v)}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('shipping_method'))
                            <span class="text-sm">
                                 {{ $errors->first('shipping_method') }}
                               </span>
                        @endif
                    </div>
                </div>

                <div class="form-group required">
                    <label for="status" class="col-sm-2 control-label">{{ trans('order.status') }}</label>
                    <div class="col-sm-8">
                        <select class="form-control status " style="width: 100%;" name="status">
                            @foreach ($orderStatus as $k => $v)
                                <option value="{{ $k }}" {{ (old('status') ==$k) ? 'selected':'' }}>{{ $v}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-sm">
                               {{ $errors->first('status') }}
                             </span>
                        @endif
                    </div>
                </div>

        </form>
        </div>

  </div>


    @endsection

      @push('order_scripts')


          <script type="text/javascript">


              $('[name="customerId"]').change(function(){
                  addInfoCustomer();
              });
              $('[name="currency"]').change(function(){
                  addExchangeRate();
              });

              function addExchangeRate(){
                  var currency = $('[name="currency"]').val();
                  var jsonCurrency = {!!$currenciesRate !!};
                  $('[name="exchange_rate"]').val(jsonCurrency[currency]);
              }

              function addInfoCustomer(){
                  id = $('[name="customerId"]').val();
                  if(id){
                      $.ajax({
                          url : '{{ route('admin.orders.customer_info') }}',
                          type : "get",
                          dateType:"application/json; charset=utf-8",
                          data : {
                              id : id
                          },
                          beforeSend: function(){
                              $('#loading').show();
                          },
                          success: function(result){
                              var returnedData = JSON.parse(result);
                              $('[name="first_name"]').val(returnedData.first_name);
                              $('[name="last_name"]').val(returnedData.last_name);
                              $('[name="address1"]').val(returnedData.address_1);
                              $('[name="address2"]').val(returnedData.address_2);
                              $('[name="email"]').val(returnedData.email);
                              $('[name="phone"]').val(returnedData.phone);
                              $('[name="country"]').val(returnedData.country).change();
                              $('#loading').hide();
                          }
                      });
                  }else{
                      $('#form-main').reset();
                  }

              }

          </script>
     @endpush
