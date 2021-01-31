@extends('layouts.shop.index')

@section('content')
    @include('shop.includes.breadcrumb')

    <div id="account-register" class="container">

        <div class="row">
            <div id="content" class="col-sm-9">
                <h1>Register Account</h1>
                <p>If you already have an account with us, please login at the
                    <a href="{{ route('shop.loginForm')}}">login page</a>.</p>
                <form action="{{ route('register') }}" method="post"   class="form-horizontal">
                    @csrf
                    <div class="tab-pane  active" >
                        <br>

                        <fieldset id="account">
                            <legend>Your Personal Details</legend>
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
                                <label class="col-sm-2 control-label" for="phone">{{trans('customer.phone')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" value="{{old('phone' ,isset($customer->phone) ? $customer->phone : '')}}" placeholder="0........" id="phone" class="form-control">
                                    @error('phone')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sex</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="1" {{old('sex' ,$customer->sex ??'')==1 ? 'checked' : '' }} />
                                        {{'men'}}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="0" {{old('sex' ,$customer->sex ??'')==0 ? 'checked' : '' }}/>
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
                                               value="{{old('birthday' , $customer->birthday ?? null)}}"
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
                                <label class="col-sm-2 control-label" for="email">{{trans('customer.email')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="{{old('email' ,isset($customer->email) ? $customer->email : '')}}" placeholder="{{trans('customer.email')}}" id="email" class="form-control">
                                    @error('email')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                        </fieldset>

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

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="city">{{trans('customer.city')}}</label>
                            <div class="col-sm-8">
                                <input type="text" name="city" value="{{old('city' ,$customer->city?? '')}}" placeholder="{{trans('customer.city')}}" id="city" class="form-control">
                                @error('city')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
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


                        <fieldset id="account">
                            <legend>Your Password</legend>
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

                    </div>
                    <div class="buttons">
                        <div class="pull-right">

                            <input type="submit" value="{{ __('Register') }}" class="btn btn-primary">
                        </div>
                    </div>
                </form>



            </div>
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <div class="list-group">
                    <a href="#" class="list-group-item">Login</a>
                    <a href="#" class="list-group-item">Register</a>
                    <a href="#" class="list-group-item">Forgotten Password</a>
                    <a href="#" class="list-group-item">My Account</a>
                    <a href="#" class="list-group-item">Address Book</a>
                    <a href="#" class="list-group-item">Wish List</a>
                    <a href="#" class="list-group-item">Order History</a>
                    <a href="#" class="list-group-item">Downloads</a>
                    <a href="#" class="list-group-item">Recurring payments</a>
                    <a href="#" class="list-group-item">Reward Points</a>
                    <a href="#" class="list-group-item">Returns</a>
                    <a href="#" class="list-group-item">Transactions</a>
                    <a href="#" class="list-group-item">Newsletter</a>
                </div>
            </aside>
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
