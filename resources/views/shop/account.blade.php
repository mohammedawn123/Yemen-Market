@extends('layouts.shop.index')
@section('content')
    @include('shop.includes.breadcrumb')
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-account" data-toggle="tab">My Account</a></li>

            <li><a href="#tab-addresses" data-toggle="tab">Addresses</a></li>
            <li><a href="#tab-wishlist" data-toggle="tab">Wish List</a></li>
            <li><a href="#tab-order" data-toggle="tab">Order History</a></li>

        </ul>


        <div class="tab-content" style="min-height: 450px; padding: 10px;">

            <div class="tab-pane active" id="tab-account">
                <div id="content" class="col-sm-9">
                    <h1>My Account Information</h1>
                    <form action="{{route('customer.update')}}" method="post"   class="form-horizontal">
                        @csrf
                        <fieldset>
                            <legend>Personal Details</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">First Name </label>
                                <div class="col-sm-8">
                                    <input type="text" name="first_name" value="{{$user->first_name}}" placeholder="First Name" id="input-firstname" class="form-control">
                                    <input type="hidden" name="customer_id" value="{{$user->customer_id}}"  id="customer_id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_name" value="{{$user->last_name}}" placeholder="Last Name" id="input-lastname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="{{$user->email}}" placeholder="E-Mail" id="input-email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                                <div class="col-sm-8">
                                    <input type="tel" name="phone" value="{{$user->phone}}" placeholder="Telephone" id="input-telephone" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sex</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="1" {{ $user->sex  ==1 ? 'checked' : '' }} />
                                        {{'men'}}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="0" {{ $user->sex   ==0 ? 'checked' : '' }}/>
                                        {{'women'}}

                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="input-date-birthday">
                                    {{trans('customer.birthday')}} Date
                                </label>
                                <div class="col-sm-3">
                                    <div class="input-group date">
                                        <input type="text" name="birthday"
                                               value="{{ $user->birthday  }}"
                                               placeholder="{{trans('customer.birthday')}}"
                                               data-date-format="YYYY-MM-DD" id="input-date-birthday"
                                               class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">
                                                   <i class="fa fa-calendar"></i>
                                            </button>
                                           </span>
                                    </div>
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
                                            <option value="{{$key}}" {{ $user->country ==$key ? 'selected' : '' }}> {{$country['name']}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="city">{{trans('customer.city')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="city" value="{{$user->city}}" placeholder="{{trans('customer.city')}}" id="city" class="form-control">
                                    @error('city')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="address1">{{trans('customer.address1')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address1" value="{{old('address1' ,isset($user->address_1) ? $user->address_1 : '')}}" placeholder="{{trans('customer.address1')}}" id="address1" class="form-control">
                                    @error('address1')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="address2">{{trans('customer.address2')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address2" value="{{old('address2' ,isset($user->address_2) ? $user->address_2 : '')}}" placeholder="{{trans('customer.address2')}}" id="address2" class="form-control">
                                    @error('address2')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                        </fieldset>
                        <fieldset id="account">
                            <legend>Password</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="password">{{trans('customer.password')}}</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" value="" placeholder="{{trans('customer.password')}}" id="password" class="form-control">
                                    @error('password')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="Confirmation">Confirmation</label>
                                <div class="col-sm-8">
                                    <input type="password" name="Confirmation"  value="" placeholder="Confirmation" id="Confirmation" class="form-control">
                                    @error('Confirmation')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons clearfix">
                            <div class="pull-right">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane" id="tab-addresses">
                <div class="row">
                    <div id="content" class="col-sm-9">
                        <h2>My Addresses</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td class="text-center">ID</td>
                                    <td class="text-center">First Name</td>
                                    <td class="text-left">Last Name</td>
                                    <td class="text-left">Phone</td>
                                    <td class="text-left">Address1</td>
                                    <td class="text-left">Address2</td>
                                    <td class="text-left">Country</td>
                                    <td class="text-left">City</td>
                                    <td class="text-left">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">
                                       {{$addresses->address_id}}
                                        </td>
                                    <td class="text-center">
                                        {{$addresses->first_name}}
                                    </td>
                                    <td class="text-left">
                                        {{$addresses->last_name}}
                                    </td>
                                    <td class="text-left">{{$addresses->phone}}</td>
                                    <td class="text-left">{{$addresses->address_1}}</td>
                                    <td class="text-left">
                                        {{$addresses->address_2}}
                                    </td>
                                    <td class="text-left">
                                        {{$addresses->country}}
                                    </td>
                                    <td class="text-left">
                                        {{$addresses->city}}
                                    </td>
                                    <td style="width: 170px; ">
                                        <a href="#">
                                         <span data-toggle="tooltip" data-original-title="Edit Customer" type="button" class="btn btn-flat btn-primary" aria-describedby="tooltip218356">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                     </a>&nbsp;
                                        <span  data-toggle="tooltip" data-original-title="Delete Customer" class="btn btn-flat btn-danger">
                                                  <i class="fa fa-trash"></i>
                                          </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="buttons clearfix">
                            <div class="pull-right"><span   class="btn btn-primary">Add New</span></div>
                        </div>
                    </div>

                </div>
            </div>
             <div class="tab-pane" id="tab-wishlist">
                 <div class="row">
                     @php $wishlist= Cart::getListCart('wishlist'); @endphp
                     <div id="content" class="col-sm-9">
                         <h2>My Wish List</h2>
                         <div class="table-responsive">
                             <table class="table table-bordered table-hover">
                                 <thead>
                                 <tr>
                                     <td class="text-center">ID</td>
                                     <td class="text-left">Image</td>
                                     <td class="text-left">Name</td>
                                     <td class="text-left">Price</td>
                                     <td class="text-left">Action</td>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($wishlist['items'] as $list)
                                 <tr>
                                     <td class="text-center">
                                         {{$list['id']}}
                                     </td>
                                     <td class="text-left">
                                         {!! $list['image']!!}

                                     </td>
                                     <td class="text-left">
                                         {{$list['name']}}
                                     </td>
                                     <td class="text-left">  {{currency_symbol($list['price'])}}</td>


                                     <td style="width: 170px; ">
                                         <button type="button" onclick="addToCart('{{$list['id']}}' ,'default')" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                                         <a href="{{route('item.remove' , ['id'=> $list['id'] , 'instance'=>'wishlist'])}}" data-toggle="tooltip" title="" class="btn btn-danger"   data-original-title="Remove"><i class="fa fa-times-circle"></i></a>

                                     </td>
                                 </tr>
                                 @endforeach
                                 </tbody>
                             </table>
                         </div>

                     </div>

                 </div>
            </div>
             <div class="tab-pane" id="tab-order">


             </div>


         </div>



    </div>

@endsection

@push('styles')
    <link href="{{url('/')}}/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen">
@endpush
@push('javaScripts')
    <script src="{{url('/')}}/view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
    <script src="{{url('/')}}/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        $('.date').datetimepicker({
            pickTime: false
        });

        $('.time').datetimepicker({
            pickDate: false
        });

        $('.datetime').datetimepicker({
            pickDate: true,
            pickTime: true
        });
    </script>

@endpush
