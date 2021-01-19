@extends('layouts.admin.index')
 @section('content')

     @push('title')
         <title>{{$title}}</title>
     @endpush
  <div class="container-fluid">

      <div class="panel panel-default">
          <div class="panel-heading">

              <h3 class="panel-title"><i class="fa fa-list"> </i>Attribute Form</h3>
          </div>

      <div class="panel-body">


        <div class="row">




        <form action="{{$action}}" method="post"   class="form-horizontal" id="form-attributes">
            {{ csrf_field()}}
                <div class="table-responsive">
                    <table id="attribute" class="table table-striped   table-hover">

                        <tbody>
                        <tr id="attribute-row0" style="background-color: white ;">
                            <td class="text-left" style="width: 45%;     border: none;">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-subtract">
                                        Attribute Group
                                    </label>
                                    @php
                                       $attribute_group= ($attribute) ? $attribute->attribute_group_id : '';
                                    @endphp
                                    <div class="col-sm-9">
                                        <input type="hidden" name="attribute_id" value="{{$attribute->attribute_id ?? ''}}"/>
                                        <select name="attribute_group" id="input-group" class="form-control">
                                            @foreach ($attribute_groups as $k => $v)
                                                <option value="{{ $k }}"
                                                    {{  ($k === $attribute_group)?'selected':'' }}>{{ $v['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('attribute_group')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sort">Sort Order</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sort_order" value="{{$attribute->sort_order ?? 0}}"
                                               placeholder="Sort Order" id="input-sort"
                                               class="form-control"/>
                                        @error('sort_order')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror

                                    </div>
                                </div>
                            </td>
                            <td class="text-left" style="    border: none;">
                                @php
                                    $description=($attribute) ? $attribute->Attribute_description->keyby('language_id')->toArray() : [];

                                    @endphp
                                @foreach($languages as  $language)
                                <div class="input-group" style=" margin-bottom: 5px;">
                                                    <span class="input-group-addon">
                                                        <img src="{{asset('/view/image/' .$language['image'])}}" title="{{$language['name']}}">
                                                    </span>
                                    <textarea name="descriptions[{{$language['language_id']}}][name]" rows="5" placeholder="{{$language['name']}} Name" class="form-control">{{$description[$language['language_id']]['name'] ?? ''}}</textarea>
                                    <input type="hidden" name="descriptions[{{$language['language_id']}}][language_id]" value="{{$language['language_id']}}"/>

                                </div>
                                    @error('descriptions.'.$language['language_id'].'.name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror

                                @endforeach
                            </td>

                        </tr>
                        </tbody>

                    </table>
                </div>


        </form>
        </div>
    </div>
  </div>


    @endsection
