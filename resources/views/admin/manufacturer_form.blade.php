@extends('layouts.admin.index')
 @section('content')

     @push('title')
         <title>{{$title}}</title>
     @endpush
  <div class="container-fluid">

      <div class="panel panel-default">
          <div class="panel-heading">

              <h3 class="panel-title"><i class="fa fa-list"> </i>Manufacturer Form</h3>
          </div>

      <div class="panel-body">


        <form action="{{$action}}" method="post"   class="form-horizontal" id="form-manufacturers">
            {{ csrf_field()}}
            <div class="tab-pane  active" >
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-image">{{trans('manufacturer.label_image')}}</label>
                    <div class="col-sm-3">
                        <a href="" id="thumb-image" data-toggle="image" class="thumbnail">
                            <img name="image1" src="{{old('image1' ,isset($manufacturer->image)? asset('/view/image/'.$manufacturer->image) : asset('/view/image/no-image.jpg'))}}" alt="" title="" data-placeholder=""></a>
                        <input type="hidden" name="image" value="{{old('image' , isset($manufacturer->image)? $manufacturer->image : 'no-image.jpg')}}" id="input-image">
                        @error('image')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-name">{{trans('manufacturer.label_name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name' ,isset($manufacturer->name) ? $manufacturer->name : '')}}" placeholder="{{trans('manufacturer.entry_name')}}" id="input-name" class="form-control">
                        <input type="hidden" name="manufacturer_id" value="{{$manufacturer->id ?? ''}}"  class="form-control">
                        @error('name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-email">{{trans('manufacturer.label_email')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" value="{{old('email' ,isset($manufacturer->email) ? $manufacturer->email : '')}}" placeholder="{{trans('manufacturer.label_email')}}" id="input-email" class="form-control">
                        @error('email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-phone">{{trans('manufacturer.label_phone')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" value="{{old('phone' ,isset($manufacturer->phone) ? $manufacturer->phone : '')}}" placeholder="{{trans('manufacturer.label_phone')}}" id="input-phone" class="form-control">
                       </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-address">{{trans('manufacturer.label_address')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" value="{{old('address' ,isset($manufacturer->address) ? $manufacturer->address : '')}}" placeholder="{{trans('manufacturer.label_address')}}" id="input-address" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status">
                        {{trans('manufacturer.label_status')}}
                    </label>
                    <div class="col-sm-10">
                        <select name="status" id="input-status"
                                class="form-control">
                               {{-- <option
                                    value="{{$stock_status['status_id']}}" {{old('product.stock_status_id')==$stock_status['status_id'] ? 'selected'  : ''}}>
                                    {{$stock_status['name']}}</option>--}}
                            <option value="1" {{old('status' ,isset($manufacturer->status) ? $manufacturer->status : '')==1 ? 'selected' : '' }}> Enabled</option>
                            <option value="0" {{old('status' ,isset($manufacturer->status) ? $manufacturer->status : '')==0 ? 'selected' : '' }}> Disabled</option>


                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sort">{{trans('manufacturer.label_sort')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="sort" value="{{old('sort' ,isset($manufacturer->sort_order) ? $manufacturer->sort_order : '')}}" placeholder="{{trans('manufacturer.label_sort')}}" id="input-address" class="form-control">
                        @error('sort')
                        <div class="text-danger">{{$message}}</div>
                        @enderror

                    </div>
                </div>


            </div>
        </form>
        </div>

  </div>


    @endsection
