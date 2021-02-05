@extends('layouts.admin.index')
@section('content')
    <?php
    use App\Models\Language;
    $languages=Language::getList()->toarray() ;
    ?>

    <div class="page-header">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{$action}}" method="post" enctype="multipart/form-data"
                          id="form-product" class="form-horizontal">
                        {{ csrf_field()}}
                        @method('PUT')
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-general"
                                                  data-toggle="tab">{{trans('product.tab_general')}}</a></li>
                            <li><a href="#tab-links" data-toggle="tab">{{trans('product.tab_links')}}</a></li>
                            <li><a href="#tab-data" data-toggle="tab">{{trans('product.tab_data')}}</a></li>
                            <li><a href="#tab-attribute" data-toggle="tab">{{trans('product.tab_attribute')}}</a></li>
                           <li><a href="#tab-discount" data-toggle="tab">{{trans('product.tab_discount')}}</a></li>
                            <li><a href="#tab-special" data-toggle="tab">{{trans('product.tab_special')}}</a></li>
                            <li><a href="#tab-image" data-toggle="tab">{{trans('product.tab_image')}}</a></li>
                            </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-general">
                                <ul class="nav nav-tabs" id="language">
                                    <?php foreach ($languages as $language){  ?>
                                    <li class="<?php echo $language['language_id']==1 ? 'active' : '' ; ?>">
                                        <a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
                                            <img src="{{asset('/view/image/' .$language['image'])}}" title="<?php echo $language['name']; ?> " />
                                            <?php echo $language['name']; ?>
                                        </a>
                                       </li>

                                    <?php } ?>
                                </ul>
                                <div class="tab-content">
                                    <?php foreach ($languages as $language) { ?>
                                    <div class="tab-pane  <?php echo $language['language_id']==1 ? 'active' : '' ; ?>" id="language<?php echo $language['language_id']; ?>">
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-name<?php echo $language['language_id']; ?>">{{trans('product.entry_name')}}</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="product_description[<?php echo $language['language_id']; ?>][name]"
                                                       value="{{old('product_description.'.$language['language_id'].'.name' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''  )}}"
                                                       placeholder="{{trans('product.entry_name')}}"
                                                       id="input-name<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>
                                                @error('product_description.'.$language['language_id'].'.name')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror

                                                <input type="hidden"
                                                       name="product_description[<?php echo $language['language_id']; ?>][language_id]"
                                                       value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['language_id'] :$language['language_id']; ?>"
                                                       id="input-language<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>
                                                <?php if (isset($error_name[$language['language_id']])) { ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-description<?php echo $language['language_id']; ?>">{{trans('product.entry_description')}}</label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    name="product_description[<?php echo $language['language_id']; ?>][description]"
                                                    placeholder="{{trans('product.entry_description')}}"
                                                    id="input-description<?php echo $language['language_id']; ?>">{{old('product_description.'.$language['language_id'].'.description' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : '' )}}</textarea>
                                                @error('product_description.'.$language['language_id'].'.description')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-meta-title<?php echo $language['language_id']; ?>">{{trans('product.entry_meta_title')}}</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="product_description[<?php echo $language['language_id']; ?>][meta_title]"
                                                       value="{{old('product_description.'.$language['language_id'].'.meta_title' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_title'] : '' )}}"
                                                       placeholder="{{trans('product.entry_meta_title')}}"
                                                       id="input-meta-title<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>
                                                @error('product_description.'.$language['language_id'].'.meta_title')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-meta-description<?php echo $language['language_id']; ?>">{{trans('product.entry_meta_description')}}</label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    name="product_description[<?php echo $language['language_id']; ?>][meta_description]"
                                                    rows="5" placeholder="{{trans('product.entry_meta_description')}}"
                                                    id="input-meta-description<?php echo $language['language_id']; ?>"
                                                    class="form-control">{{old('product_description.'.$language['language_id'].'.meta_description' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : '' )}}</textarea>

                                                @error('product_description.'.$language['language_id'].'.meta_description')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-meta-keyword<?php echo $language['language_id']; ?>">{{trans('product.entry_meta_keyword')}}
                                                </label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]"
                                                    rows="5" placeholder="{{trans('product.entry_meta_keyword')}}"
                                                    id="input-meta-keyword<?php echo $language['language_id']; ?>"
                                                    class="form-control">{{old('product_description.'.$language['language_id'].'.meta_keyword' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : '' )}}</textarea>

                                                @error('product_description.'.$language['language_id'].'.meta_keyword')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-tag<?php echo $language['language_id']; ?>">
                                                {{trans('product.entry_tag')}}</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="product_description[<?php echo $language['language_id']; ?>][tag]"
                                                       value="{{old('product_description.'.$language['language_id'].'.tag' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : '' )}}"
                                                       placeholder="{{trans('product.entry_tag')}}"
                                                       id="input-tag<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>

                                                @error('product_description.'.$language['language_id'].'.tag')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-image">{{trans('product.entry_image')}}</label>
                                    <div class="col-sm-3">
                                        <a href="" id="thumb-image" data-toggle="image" class="thumbnail">
                                            <img name="product_image"
                                                 src="{{old('product_image' ,isset($image)? asset('/view/image/'.$image) : asset('/view/image/no-image.jpg'))}}"
                                                 alt="" title="" data-placeholder="<?php //echo $placeholder; ?>"/></a>
                                        <input type="hidden" name="product[image]" value="{{old('product.image' , isset($image)? $image : 'no-image.jpg')}}"
                                               id="input-image"/>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id"
                                       value="{{old('product_id' , isset($product_id) ? $product_id : '')}}"
                                       id="input-id"  class="form-control"/>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label"
                                           for="input-model">{{trans('product.entry_model')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[model]"
                                               value="{{old('product.model' , isset($model) ? $model : '')}}"
                                               placeholder="{{trans('product.entry_model')}}" id="input-model"
                                               class="form-control"/>

                                        @error('product.model')

                                        <div class="text-danger">{{$message}}</div>
                                        @enderror


                                    </div>
                                </div>
                                <div class="form-group  required">
                                    <label class="col-sm-2 control-label" for="input-sku"><span data-toggle="tooltip"
                                            title="{{trans('product.help_sku')}}">{{trans('product.entry_sku')}}</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[sku]" value="{{old('product.sku' , isset($sku) ? $sku : '')}}"
                                               placeholder="{{trans('product.entry_sku')}}" id="input-sku"
                                               class="form-control"/>
                                        @error('product.sku')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-upc">
                                        <span data-toggle="tooltip" title="{{trans('product.help_upc')}}">
                                            {{trans('product.entry_upc')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[upc]" value="{{old('product.upc' , isset($upc) ? $upc : '')}}"
                                               placeholder="{{trans('product.entry_upc')}}" id="input-upc"
                                               class="form-control"/>
                                        @error('product.upc')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-ean">
                                        <span data-toggle="tooltip" title="{{trans('product.help_ean')}}">
                                            {{trans('product.entry_ean')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[ean]"
                                               value="{{old('product.ean' , isset($ean) ? $ean : '')}}"
                                               placeholder="{{trans('product.entry_ean')}}" id="input-ean"
                                               class="form-control"/>
                                        @error('ean')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-jan">
                                        <span data-toggle="tooltip" title="{{trans('product.help_jan')}}">
                                            {{trans('product.entry_jan')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[jan]"
                                               value="{{old('product.jan' , isset($jan) ? $jan : '')}}"
                                               placeholder="{{trans('product.entry_jan')}}" id="input-jan"
                                               class="form-control"/>
                                        @error('jan')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-isbn">
                                        <span data-toggle="tooltip" title="{{trans('product.help_isbn')}}">
                                            {{trans('product.entry_isbn')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[isbn]"
                                               value="{{old('product.isbn' , isset($isbn) ? $isbn : '')}}"
                                               placeholder="{{trans('product.entry_isbn')}}" id="input-isbn"
                                               class="form-control"/>
                                        @error('product.isbn')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-mpn">
                                        <span data-toggle="tooltip" title="{{trans('product.help_mpn')}}">
                                            {{trans('product.entry_mpn')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[mpn]"
                                               value="{{old('product.mpn' , isset($mpn) ? $mpn : '')}}"
                                               placeholder="{{trans('product.entry_mpn')}}" id="input-mpn"
                                               class="form-control"/>
                                        @error('mpn')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-location">{{trans('product.entry_location')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[location]"
                                               value="{{old('product.location' , isset($location) ? $location : '')}}"
                                               placeholder="{{trans('product.entry_location')}}" id="input-location"
                                               class="form-control"/>
                                        @error('location')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-price">{{trans('product.entry_price')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[price]"
                                               value="{{old('product.price' , isset($price) ? $price : '')}}"
                                               placeholder="{{trans('product.entry_price')}}" id="input-price"
                                               class="form-control"/>
                                        @error('price')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-tax-class">{{trans('product.entry_tax_class')}}</label>
                                    <div class="col-sm-10">
                                        <select name="product[tax_class_id]" id="input-tax-class" class="form-control">
                                            <option value="0">{{trans('product.text_none')}}</option>
                                     @if(isset($tax_rates ))   <?php  foreach ($tax_rates as $tax_rate) { ?>
                                          <option
                                                value="{{$tax_rate['tax_rate_id']}}" {{old('product.tax_class_id' ,$tax_rate['tax_rate_id']?? '' )==$tax_rate['tax_rate_id']? 'selected' : ''}}>
                                                {{$tax_rate['name']}} </option>

                                            <?php } ?>
                                         @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-quantity">{{trans('product.entry_quantity')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[quantity]"
                                               value="{{old('product.quantity' , isset($quantity) ? $quantity : '')}}"
                                               placeholder="{{trans('product.entry_quantity')}}" id="input-quantity"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-minimum">
                                        <span  data-toggle="tooltip" title="{{trans('product.help_minimum')}}">
                                            {{trans('product.entry_minimum')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[minimum]"
                                               value="{{old('product.minimum' , isset($minimum) ? $minimum : '')}}"
                                               placeholder="{{trans('product.entry_minimum')}}" id="input-minimum"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-subtract">
                                        {{trans('product.entry_subtract')}}
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="product[subtract]" id="input-subtract" class="form-control">
                                            <option value="1"> {{trans('product.text_yes')}}</option>
                                            <option  value="0"
                                                {{old('product.subtract' , '0')== '0' ? 'selected' : ''}} >
                                                {{trans('product.text_no')}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-stock-status">
                                        <span  data-toggle="tooltip" title="{{trans('product.help_stock_status')}}">
                                            {{trans('product.entry_stock_status')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="product[stock_status_id]" id="input-stock-status"
                                                class="form-control">
                                            @if(isset( $data['stock_statuses']))
                                        <?php foreach ($data['stock_statuses'] as $stock_status) { ?>
                                        <?php // if ($stock_status['status_id'] == $stock_status_id) { ?>
                                        <!--   <option value="1" selected="selected"><?php //echo 'stock_status[\'name\']'; ?></option>-->
                                            <?php// } else { ?>
                                            <option
                                                value="{{$stock_status['status_id']}}" {{old('product.stock_status_id')==$stock_status['status_id'] ? 'selected'  : ''}}>
                                                {{$stock_status['name']}}</option>
                                            <?php //} ?>
                                            <?php } ?>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{trans('product.entry_shipping')}}</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                        <?php  if(isset($shipping)) { ?>
                                         <input type="radio" name="product[shipping]" value="1" checked="checked" />
                                                {{trans('product.text_yes')}}
                                            <?php } else { ?>
                                            <input type="radio" name="product[shipping]" value="1"/>
                                            {{trans('product.text_yes')}}
                                            <?php } ?>
                                        </label>
                                        <label class="radio-inline">
                                        <?php if(!isset($shipping)) { ?>
                                     <input type="radio" name="product[shipping]" value="0" checked="checked" />
                                                {{trans('product.text_no')}}
                                            <?php } else { ?>
                                            <input type="radio" name="product[shipping]" value="0"/>
                                            {{trans('product.text_no')}}
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-keyword"><span
                                            data-toggle="tooltip" title="{{trans('product.help_keyword')}}">
                                            {{trans('product.entry_keyword')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="keyword"
                                               value="{{old('product.keyword' , isset($keyword) ? $keyword : '')}}"
                                               placeholder="{{trans('product.entry_keyword')}}" id="input-keyword"
                                               class="form-control"/>
                                        @error('keyword')
                                        <div class="text-danger">{{trans('product.error_keyword')}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-date-available">
                                        {{trans('product.entry_date_available')}}
                                    </label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <input type="text" name="product[date_available]"
                                                   value="{{old('product.date_available' , isset($date_available) ? $date_available : '')}}"
                                                   placeholder="{{trans('product.entry_date_available')}}"
                                                   data-date-format="YYYY-MM-DD" id="input-date-available"
                                                   class="form-control"/>
                                            <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">
                                                   <i class="fa fa-calendar"></i>
                                            </button>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-length">
                                        {{trans('product.entry_dimension')}}
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="text" name="product[length]"
                                                      value="{{old('product.length' , isset($length) ? $length : '')}}"
                                                       placeholder="{{trans('product.entry_length')}}" id="input-length"
                                                       class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="product[width]"
                                                       value="{{old('product.width' , isset($width) ? $width : '')}}"
                                                       placeholder="{{trans('product.entry_width')}}" id="input-width"
                                                       class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="product[height]"
                                                       value="{{old('product.height' , isset($height) ? $height : '')}}"
                                                       placeholder="{{trans('product.entry_height')}}" id="input-height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-length-class">
                                        {{trans('product.entry_length_class')}}
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="product[length_class_id]" id="input-length-class" class="form-control">
                                        @if(isset( $data['length_classes']))
                                        <?php foreach ($data['length_classes'] as $length_class) { ?>
                                            <option  value="{{$length_class['length_class_id']}}"
                                                {{old('product.length_class_id')==$length_class['length_class_id'] ? 'selected' : ''}}>
                                                {{$length_class['length_class_descriptions'][0]['title']}}
                                            </option>
                                            <?php } ?>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-weight">{{trans('product.entry_weight')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[weight]"
                                               value="{{old('product.weight' , isset($weight) ? $weight : '')}}"
                                               placeholder="{{trans('product.entry_weight')}}" id="input-weight"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-weight-class">{{trans('product.entry_weight_class')}}</label>
                                    <div class="col-sm-10">
                                        <select name="product[weight_class_id]" id="input-weight-class"
                                                class="form-control">
                                        @if(isset( $data['weight_classes']))
                                        <?php foreach ($data['weight_classes'] as $weight_class) { ?>
                                            <option
                                                value="{{$weight_class['weight_class_id']}}" {{old('product.weight_class_id')==$weight_class['weight_class_id'] ? 'selected' : ''}}> {{$weight_class['weight_class_descriptions'][0]['title']}} </option>

                                            <?php } ?>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-status">{{trans('product.entry_status')}}</label>
                                    <div class="col-sm-10">
                                        <select name="product[status]" id="input-status" class="form-control">
                                            <option value="1" {{old('product.status')=== 1 ? 'selected' : ''}}>{{trans('product.text_enabled')}}
                                            </option>
                                            <option
                                                value="0" {{old('product.status')=== 0 ? 'selected' : ''}}>{{trans('product.text_disabled')}}</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-sort-order">{{trans('product.entry_sort_order')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[sort_order]"
                                               value="{{old('product.sort_order' , isset($sort_order) ? $sort_order : '')}}"
                                               placeholder="{{trans('product.entry_sort_order')}}" id="input-sort-order"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-links">
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-manufacturer">
                                        <span  data-toggle="tooltip" title="{{trans('product.help_manufacturer')}}">
                                            {{trans('product.entry_manufacturer')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="manufacturer"
                                               value="{{old('manufacturer' , isset($manufacturer) ? $manufacturer->name : '')}}"
                                               placeholder="{{trans('product.entry_manufacturer')}}"
                                               id="input-manufacturer" class="form-control"/>
                                        <input type="hidden" name="product[manufacturer_id]"
                                               value="{{old('product.manufacturer_id' , isset($manufacturer) ? $manufacturer->id : '')}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-category">
                                        <span  data-toggle="tooltip"  title="{{trans('product.help_category')}}">
                                            {{trans('product.entry_category')}}
                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="category" value=""
                                               placeholder="{{trans('product.entry_category')}}" id="input-category"
                                               class="form-control"/>
                                        <div id="product-category" class="well well-sm"
                                             style="height: 150px; overflow: auto;">
                                            @if(isset($categories) && $categories !== null)
                                              @foreach ($categories as $category)

                                                <div id="product-category"><i class="fa fa-minus-circle"></i>
                                                     {{$category['name'] }}
                                                        <input type="hidden" name="product_category[]" value=" {{$category['category_id']}}" />
                                                 </div>

                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-related"><span
                                            data-toggle="tooltip"
                                            title="{{trans('product.help_related')}}">{{trans('product.entry_related')}}</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="related" value=""
                                               placeholder="{{trans('product.entry_related')}}" id="input-related"
                                               class="form-control"/>
                                        <div id="product-related" class="well well-sm"
                                             style="height: 150px; overflow: auto;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-attribute">
                                <div class="table-responsive">
                                    <table id="attribute" class="table table-striped table-bordered table-hover">

                                        <tbody>
                                        <?php $attribute_row = 0; ?>
                                        @if(isset($product_attributes))
                                      @foreach ($product_attributes as $product_attribute)
                                        <tr id="attribute-row<?php echo $attribute_row; ?>">
                                            <td class="text-left" style="width: 45%;">
                                                <input type="text"
                                                                  name="product_attribute[<?php echo $attribute_row ; ?>][name]"
                                                                  value="<?php echo $product_attribute['name']; ?>"
                                                                  placeholder="{{trans('product.entry_attribute')}}"
                                                                  class="form-control"/>
                                                <input type="hidden"
                                                       name="product_attribute[<?php echo $attribute_row ; ?>][attribute_id]"
                                                       value="<?php echo $product_attribute['attribute_id']; ?>"/>
                                            </td>
                                            <td class="text-right">
                                                @foreach ($languages as $language)
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <img  src="{{asset('/view/image/' .$language['image'])}}"
                                                            title="<?php echo $language['name']; ?>"/>
                                                    </span>
                                                    <textarea name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo 'entry_text'; ?>" class="form-control"><?php echo isset($product_attribute['product_attribute_description'][$language['language_id']]) ? $product_attribute['product_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
                                                </div>
                                                @endforeach
                                            </td>
                                            <td class="text-left">
                                                <button type="button"
                                                        onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();"
                                                        data-toggle="tooltip" title="<?php echo 'button_remove'; ?>"
                                                        class="btn btn-danger"><i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $attribute_row++; ?>
                                      @endforeach
                                      @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addAttribute();" data-toggle="tooltip"
                                                        title="{{trans('product.button_attribute_add')}}"
                                                        class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                             <div class="tab-pane" id="tab-discount">
                                <div class="table-responsive">
                                    <table id="discount" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">{{trans('product.entry_customer_group')}}</td>
                                            <td class="text-left">{{trans('product.entry_quantity')}}</td>
                                            <td class="text-left">{{trans('product.entry_priority')}}</td>
                                            <td class="text-left">{{trans('product.entry_price')}}</td>
                                            <td class="text-left">{{trans('product.entry_date_start')}}</td>
                                            <td class="text-left">{{trans('product.entry_date_end')}}</td>
                                            <td  class="text-left">Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <?php $discount_row = 0 ;?>
                                        @if(isset($product_discounts))
                                        @foreach ($product_discounts as $product_discount)
                                        <tr id="discount-row{{$discount_row}}">
                                            <td class="text-left">
                                                <select
                                                    name="product_discount[<?php echo $discount_row; ?>][customer_group_id]"
                                                    class="form-control">
                                                    @foreach($customer_groups as $key=>$group)
                                                        <option value="{{$key}}" {{old('product_discount'.$discount_row.'customer_group_id' ,$product_discount['customer_group_id'] ??'')==$key ? 'selected' : '' }}> {{$group['name']}}</option>

                                                    @endforeach

                                                </select>
                                            </td>
                                            <td class="text-right"><input type="text"
                                                                          name="product_discount[<?php echo $discount_row; ?>][quantity]"
                                                                          value="<?php echo $product_discount['quantity']; ?>"
                                                                          placeholder="<?php echo 'quantity'; ?>"
                                                                          class="form-control"/>
                                                <input type="hidden"
                                                       name="product_discount[<?php echo $discount_row; ?>][product_discount_id]"
                                                       value="<?php echo $product_discount['product_discount_id']; ?>"
                                                      /></td>
                                            <td class="text-right"><input type="text"
                                                                          name="product_discount[<?php echo $discount_row; ?>][priority]"
                                                                          value="<?php echo $product_discount['priority']; ?>"
                                                                          placeholder="{{trans('product.entry_priority')}}"
                                                                          class="form-control"/></td>
                                            <td class="text-right"><input type="text"
                                                                          name="product_discount[<?php echo $discount_row; ?>][price]"
                                                                          value="<?php echo $product_discount['price']; ?>"
                                                                          placeholder="{{trans('product.entry_price')}}"
                                                                          class="form-control"/></td>
                                            <td class="text-left" style="width: 20%;">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="product_discount[<?php echo $discount_row; ?>][date_start]"
                                                           value="<?php echo $product_discount['date_start']; ?>"
                                                           placeholder="{{trans('product.entry_date_start')}}"
                                                           data-date-format="YYYY-MM-DD" class="form-control"/>
                                                    <span class="input-group-btn">
                          <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                          </span></div>
                                            </td>
                                            <td class="text-left" style="width: 20%;">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="product_discount[<?php echo $discount_row; ?>][date_end]"
                                                           value="<?php echo $product_discount['date_end']; ?>"
                                                           placeholder="{{trans('product.entry_date_end')}}"
                                                           data-date-format="YYYY-MM-DD" class="form-control"/>
                                                    <span class="input-group-btn">
                          <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                          </span></div>
                                            </td>
                                            <td class="text-left">
                                                <button type="button"
                                                        onclick="$('#discount-row<?php echo $discount_row; ?>').remove();"
                                                        data-toggle="tooltip" title="<?php echo 'button_remove'; ?>"
                                                        class="btn btn-danger"><i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                       <?php $discount_row++ ; ?>
                                        @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addDiscount();" data-toggle="tooltip"
                                                        title="{{trans('product.button_discount_add')}}"
                                                        class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-special">
                                <div class="table-responsive">
                                    <table id="special" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">{{trans('product.entry_customer_group')}}</td>
                                            <td class="text-right">{{trans('product.entry_priority')}}</td>
                                            <td class="text-right">{{trans('product.entry_price')}}</td>
                                            <td class="text-left">{{trans('product.entry_date_start')}}</td>
                                            <td class="text-left">{{trans('product.entry_date_end')}}</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $special_row = 0; ?>
                                        <?php if(isset($product_specials)) { ?>

                                        <?php foreach ($product_specials as $product_special) {?>
                                        <tr id="special-row<?php echo $special_row; ?>">
                                            <td class="text-left"><select
                                                    name="product_special[<?php echo $special_row; ?>][customer_group_id]"
                                                    class="form-control">
                                                    @foreach($customer_groups as $key=>$group)
                                                        <option value="{{$key}}" {{old('product_special'.$discount_row.'customer_group_id' ,$product_special['customer_group_id'] ??'')==$key ? 'selected' : '' }}> {{$group['name']}}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="text-right">
                                                <input type="text"
                                                                          name="product_special[<?php echo $special_row; ?>][priority]"
                                                                          value="{{old('product_special.'.$special_row.'.priority',$product_special['priority'])}}"
                                                                          placeholder="{{trans('product.entry_quantity')}}"
                                                                          class="form-control"/>

                                                <input type="hidden"
                                                       name="product_special[<?php echo $special_row; ?>][product_special_id]"
                                                       value="{{old('product_special.'.$special_row.'.product_special_id',$product_special['product_special_id'])}}"
                                                       class="form-control"/>    </td>
                                            <td class="text-right">
                                                <input type="text"
                                                                          name="product_special[<?php echo $special_row; ?>][price]"
                                                                          value="{{old('product_special.'.$special_row.'.price',$product_special['price'])}}"
                                                                          placeholder="{{trans('product.entry_price')}}"
                                                                          class="form-control"/>
                                            </td>
                                            <td class="text-left" style="width: 20%;">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="product_special[<?php echo $special_row; ?>][date_start]"
                                                           value="{{old('product_special.'.$special_row.'.date_start',$product_special['date_start'])}}"
                                                           placeholder="{{trans('product.entry_date_start')}}"
                                                           data-date-format="YYYY-MM-DD" class="form-control"/>
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">
                                                      <i class="fa fa-calendar"></i>
                                                    </button>
                                                   </span>
                                                </div>
                                            </td>
                                            <td class="text-left" style="width: 20%;">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="product_special[<?php echo $special_row; ?>][date_end]"
                                                           value="{{old('product_special.'.$special_row.'.date_end',$product_special['date_end'])}}"
                                                           placeholder="{{trans('product.entry_date_end')}}"
                                                           data-date-format="YYYY-MM-DD" class="form-control"/>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">
                                                           <i class="fa fa-calendar"></i>
                                                        </button>
                                                   </span></div>
                                            </td>
                                            <td class="text-left">
                                                <button type="button"
                                                        onclick="$('#special-row<?php echo $special_row; ?>').remove();"
                                                        data-toggle="tooltip" title="<?php echo 'button_remove'; ?>"
                                                        class="btn btn-danger"><i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                       <?php $special_row++ ?>
                                      <?php }?>
                                      <?php }?>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addSpecial();" data-toggle="tooltip"
                                                        title="{{trans('product.button_special_add')}}"
                                                        class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">


                // Manufacturer
                $('input[name=\'manufacturer\']').autocomplete({
                    'source': function (request, response) {
                        var filter_name1 = $(this).val();
                        $.ajax({
                            url: "{{url('admin/products/manufacturer_autocomplete')}}",
                            type: "post",
                            dataType: 'json',
                            data: {filter_name: filter_name1  ,   _token: '{{ csrf_token() }}'},
                            success: function (json) {
                                json.unshift({
                                    manufacturer_id: 0,
                                    name: '<?php echo 'text_none'; ?>'
                                });

                                response($.map(json, function (item) {
                                    return {
                                        label: item['name'],
                                        value: item['id']
                                    }
                                }));
                            }
                        });
                    },
                    'select': function (item) {
                        $('input[name=\'manufacturer\']').val(item['label']);
                        $('input[name=\'product[manufacturer_id]\']').val(item['value']);
                    }
                });
                // Category
                $('input[name=\'category\']').autocomplete({
                    'source': function (request, response) {
                        var filter_name1 = $(this).val();
                        $.ajax({
                            url: "{{url('admin/products/CategoriesAutocomplete')}}",
                            type: "get",
                            dataType: 'json',
                            data: {filter_name: filter_name1},
                            success: function (json) {
                                response($.map(json, function (item) {
                                    return {
                                        label: item['name'],
                                        value: item['category_id']
                                    }
                                }));
                            }
                        });
                    },
                    'select': function (item) {
                        $('input[name=\'category\']').val('');

                        $('#product-category' + item['value']).remove();

                        $('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');
                    }
                });


                $('#product-category').delegate('.fa-minus-circle', 'click', function () {
                    $(this).parent().remove();
                });

                $('#category-filter').delegate('.fa-minus-circle', 'click', function () {
                    $(this).parent().remove();
                });

                </script>







        <script type="text/javascript">
            <?php foreach ($languages as $language) { ?>
            $('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
            <?php } ?>
            </script>
        <script type="text/javascript">


            $('#product-category').delegate('.fa-minus-circle', 'click', function () {
                $(this).parent().remove();
            });



            </script>
        <script type="text/javascript">
            var attribute_row =  <?php echo $attribute_row; ?>;

            function addAttribute() {
                html = '<tr id="attribute-row' + attribute_row + '">';
                html += '  <td class="text-left" style="width: 20%;">' +
                    '<input type="text" name="product_attribute['+ attribute_row +'][name]" value="" placeholder="{{trans('product.entry_attribute')}}" class="form-control" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
                html += '  <td class="text-left">';
                <?php foreach ($languages as $language) { ?>
                    html += '<div class="input-group"><span class="input-group-addon"><img src="{{asset('/view/image/'.$language['image'])}}" title="<?php echo $language['name']; ?>" /></span><textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo 'entry_text'; ?>" class="form-control"></textarea></div>';
                <?php } ?>
                    html += '  </td>';
                html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="<?php echo 'button_remove'; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                html += '</tr>';

                $('#attribute tbody').append(html);

                attributeautocomplete(attribute_row);

                attribute_row++;
            }

            function attributeautocomplete(attribute_row) {
                $('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
                    'source': function (request, response) {
                        $.ajax({
                            url: "{{route('attribute.autocomplete')}}",
                            dataType: 'json',
                            success: function (json) {
                                response($.map(json, function (item) {
                                    return {
                                        category: item.attribute_group,
                                        label: item.name,
                                        value: item.attribute_id
                                    }
                                }));
                            }
                        });
                    },
                    'select': function (item) {
                        $('input[name=\'product_attribute[' + attribute_row + '][name]\']').val(item['label']);
                        $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
                    }
                });
            }


            $('#attribute tbody tr').each(function (index, element) {
                attributeautocomplete(index);
            });
            </script>
            <script type="text/javascript">
                var discount_row = <?php echo $discount_row; ?>;

                function addDiscount() {
                    html  = '<tr id="discount-row' + discount_row + '">';
                    html += '  <td class="text-left"><select name="product_discount[' + discount_row + '][customer_group_id]" class="form-control">';
                    <?php  foreach($customer_groups as $key=>$group) { ?>
                        html += '  <option value="{{$key}}" {{old('product_discount'.$discount_row.'customer_group_id')==$key ? 'selected' : '' }}> {{$group['name']}}</option>';
                    <?php  } ?>
                        html += '  </select></td>';
                    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" placeholder="<?php echo 'entry_quantity'; ?>" class="form-control" />   <input type="hidden" name="product_discount['+ discount_row +'][product_discount_id]" value="" /></td>';
                    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" placeholder="<?php echo 'entry_priority'; ?>" class="form-control" /></td>';
                    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" placeholder="<?php echo 'entry_price'; ?>" class="form-control" /></td>';
                    html += '  <td class="text-left"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="<?php echo 'entry_date_start'; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
                    html += '  <td class="text-left"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="<?php echo 'entry_date_end'; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
                    html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="<?php echo 'button_remove'; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                    html += '</tr>';

                    $('#discount tbody').append(html);

                    $('.date').datetimepicker({
                        pickTime: false
                    });

                    discount_row++;
                }
               </script>


            <script type="text/javascript">
            var special_row = <?php echo $special_row; ?>;

            function addSpecial() {
                html = '<tr id="special-row' + special_row + '">';
                html += '  <td class="text-left"><select name="product_special[' + special_row + '][customer_group_id]" class="form-control">';
                <?php  foreach($customer_groups as $key=>$group) { ?>
                    html += '  <option value="{{$key}}" {{old("product_special" . $special_row . "customer_group_id" )==$key ? 'selected' : '' }}> {{$group['name']}}</option>';
                <?php  } ?>
                    html += '  </select></td>';
                html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][priority]" value="" placeholder="product-entry_priority" class="form-control" /> <input type="hidden" name="product_special['+ special_row +'][product_special_id]" value="" /></td>';
                html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][price]" value="" placeholder="product-entry_price" class="form-control" /></td>';
                html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_start]" value="" placeholder="product-entry_date_start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
                html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_end]" value="" placeholder="product.entry_date_end" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
                html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="<?php echo 'button_remove'; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                html += '</tr>';

                $('#special tbody').append(html);

                $('.date').datetimepicker({
                    pickTime: false
                });

                special_row++;
            }
        </script>

        @endpush


@endsection
