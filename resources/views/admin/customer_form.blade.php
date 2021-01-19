@extends('layouts.admin.index')
 @section('content')

     @push('title')
         <title>{{$title}}</title>
     @endpush
  <div class="container-fluid">

      <div class="panel panel-default">
          <div class="panel-heading">

              <h3 class="panel-title"><i class="fa fa-user"> </i>Customer Form</h3>
          </div>

      <div class="panel-body">


        <form action="{{$action}}" method="post"   class="form-horizontal" id="form-customer">
            {{ csrf_field()}}
            <div class="tab-pane  active" >


                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="first_name">{{trans('customer.first_name')}}</label>
                    <div class="col-sm-8">
                        <input type="text" required name="first_name" value="{{old('first_name' ,isset($customer->first_name) ? $customer->first_name : '')}}" placeholder="{{trans('customer.first_name')}}" id="first_name" class="form-control">
                        <input type="hidden" name="customer_id" value="{{$customer->customer_id ?? ''}}"  class="form-control">
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
                    <label class="col-sm-2 control-label" for="customer_group">
                        {{trans('customer.group')}}
                    </label>
                    <div class="col-sm-8">
                        <select name="customer_group" id="customer_group"
                                class="form-control">
                            @foreach($customer_groups as $key=>$group)
                                <option value="{{$key}}" {{old('customer_group' ,$customer->customer_group_id ??'')==$key ? 'selected' : '' }}> {{$group['name']}}</option>

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
                        <input type="password" name="Confirmation" value="" placeholder="Confirmation" id="Confirmation" class="form-control">
                        @error('Confirmation')
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


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status">
                        {{trans('customer.status')}}
                    </label>
                    <div class="col-sm-8">
                        <select name="status" id="input-status"
                                class="form-control">
                                 <option value="1" {{old('status' ,$customer->status ?? '')==1 ? 'selected' : '' }}> Enabled</option>
                                 <option value="0" {{old('status' ,$customer->status ?? '')==0 ? 'selected' : '' }}> Disabled</option>
                        </select>
                    </div>
                </div>


            </div>
        </form>
        </div>

  </div>


    @endsection
