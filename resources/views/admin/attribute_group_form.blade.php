@extends('layouts.admin.index')
 @section('content')

     @push('title')
         <title>{{$title}}</title>
     @endpush
  <div class="container-fluid">

      <div class="panel panel-default">
          <div class="panel-heading">

              <h3 class="panel-title"><i class="fa fa-list"> </i>Attribute Group Form</h3>
          </div>

      <div class="panel-body">


        <form action="{{$action}}" method="post"   class="form-horizontal" id="form-attribute_group">
            {{ csrf_field()}}
            <div class="tab-pane  active" >
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sort">Sort Order</label>
                    <div class="col-sm-10">
                        <input type="text" name="sort_order" value="{{$attribute_group->sort_order ?? 0}}" placeholder="Sort Order" id="input-sort" class="form-control">
                        <input type="hidden" name="attribute_group_id" value="{{$attribute_group->attribute_group_id ?? ''}}"  class="form-control">
                    </div>
                </div>

                @php
                    $descriptions=($attribute_group) ? $attribute_group->Attribute_group_description->keyby('language_id')->toArray() : [];

                @endphp
                @foreach($languages as  $language)
                    <label class="col-sm-2 control-label" >{{$language['name']}} Name</label>
                <div class="input-group" style=" margin-bottom: 5px;">
                    <span class="input-group-addon">
                        <img src="{{asset('/view/image/' .$language['image'])}}" title="{{$language['name']}}">
                    </span>

                        <textarea name="descriptions[{{$language['language_id']}}][name]" rows="5" style="width: 60%;" placeholder="{{$language['name']}} Name" id="input-meta-description1" class="form-control">{{$descriptions[$language['language_id']]['name'] ?? ''}}</textarea>
                       <input type="hidden" name="descriptions[{{$language['language_id']}}][language_id]" value="{{$language['language_id']}}"/>
                </div>
                    @error('descriptions.'.$language['language_id'].'.name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror

                @endforeach
            </div>
        </form>
        </div>

  </div>


    @endsection
