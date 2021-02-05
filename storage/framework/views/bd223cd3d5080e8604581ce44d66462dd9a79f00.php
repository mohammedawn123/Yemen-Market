<?php $__env->startSection('content'); ?>
    <?php
    use App\Models\Language;
    $languages=Language::getList()->toarray() ;
    ?>

    <div class="page-header">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?php echo e($action); ?>" method="post" enctype="multipart/form-data"
                          id="form-product" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        <?php echo method_field('PUT'); ?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-general"
                                                  data-toggle="tab"><?php echo e(trans('product.tab_general')); ?></a></li>
                            <li><a href="#tab-links" data-toggle="tab"><?php echo e(trans('product.tab_links')); ?></a></li>
                            <li><a href="#tab-data" data-toggle="tab"><?php echo e(trans('product.tab_data')); ?></a></li>
                            <li><a href="#tab-attribute" data-toggle="tab"><?php echo e(trans('product.tab_attribute')); ?></a></li>
                           <li><a href="#tab-discount" data-toggle="tab"><?php echo e(trans('product.tab_discount')); ?></a></li>
                            <li><a href="#tab-special" data-toggle="tab"><?php echo e(trans('product.tab_special')); ?></a></li>
                            <li><a href="#tab-image" data-toggle="tab"><?php echo e(trans('product.tab_image')); ?></a></li>
                            </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-general">
                                <ul class="nav nav-tabs" id="language">
                                    <?php foreach ($languages as $language){  ?>
                                    <li class="<?php echo $language['language_id']==1 ? 'active' : '' ; ?>">
                                        <a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
                                            <img src="<?php echo e(asset('/view/image/' .$language['image'])); ?>" title="<?php echo $language['name']; ?> " />
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
                                                   for="input-name<?php echo $language['language_id']; ?>"><?php echo e(trans('product.entry_name')); ?></label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="product_description[<?php echo $language['language_id']; ?>][name]"
                                                       value="<?php echo e(old('product_description.'.$language['language_id'].'.name' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''  )); ?>"
                                                       placeholder="<?php echo e(trans('product.entry_name')); ?>"
                                                       id="input-name<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>
                                                <?php $__errorArgs = ['product_description.'.$language['language_id'].'.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
                                                   for="input-description<?php echo $language['language_id']; ?>"><?php echo e(trans('product.entry_description')); ?></label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    name="product_description[<?php echo $language['language_id']; ?>][description]"
                                                    placeholder="<?php echo e(trans('product.entry_description')); ?>"
                                                    id="input-description<?php echo $language['language_id']; ?>"><?php echo e(old('product_description.'.$language['language_id'].'.description' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : '' )); ?></textarea>
                                                <?php $__errorArgs = ['product_description.'.$language['language_id'].'.description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo e(trans('product.entry_meta_title')); ?></label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="product_description[<?php echo $language['language_id']; ?>][meta_title]"
                                                       value="<?php echo e(old('product_description.'.$language['language_id'].'.meta_title' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_title'] : '' )); ?>"
                                                       placeholder="<?php echo e(trans('product.entry_meta_title')); ?>"
                                                       id="input-meta-title<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>
                                                <?php $__errorArgs = ['product_description.'.$language['language_id'].'.meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo e(trans('product.entry_meta_description')); ?></label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    name="product_description[<?php echo $language['language_id']; ?>][meta_description]"
                                                    rows="5" placeholder="<?php echo e(trans('product.entry_meta_description')); ?>"
                                                    id="input-meta-description<?php echo $language['language_id']; ?>"
                                                    class="form-control"><?php echo e(old('product_description.'.$language['language_id'].'.meta_description' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : '' )); ?></textarea>

                                                <?php $__errorArgs = ['product_description.'.$language['language_id'].'.meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo e(trans('product.entry_meta_keyword')); ?>

                                                </label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]"
                                                    rows="5" placeholder="<?php echo e(trans('product.entry_meta_keyword')); ?>"
                                                    id="input-meta-keyword<?php echo $language['language_id']; ?>"
                                                    class="form-control"><?php echo e(old('product_description.'.$language['language_id'].'.meta_keyword' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : '' )); ?></textarea>

                                                <?php $__errorArgs = ['product_description.'.$language['language_id'].'.meta_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label"
                                                   for="input-tag<?php echo $language['language_id']; ?>">
                                                <?php echo e(trans('product.entry_tag')); ?></label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="product_description[<?php echo $language['language_id']; ?>][tag]"
                                                       value="<?php echo e(old('product_description.'.$language['language_id'].'.tag' , isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : '' )); ?>"
                                                       placeholder="<?php echo e(trans('product.entry_tag')); ?>"
                                                       id="input-tag<?php echo $language['language_id']; ?>"
                                                       class="form-control"/>

                                                <?php $__errorArgs = ['product_description.'.$language['language_id'].'.tag'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-image"><?php echo e(trans('product.entry_image')); ?></label>
                                    <div class="col-sm-3">
                                        <a href="" id="thumb-image" data-toggle="image" class="thumbnail">
                                            <img name="product_image"
                                                 src="<?php echo e(old('product_image' ,isset($image)? asset('/view/image/'.$image) : asset('/view/image/no-image.jpg'))); ?>"
                                                 alt="" title="" data-placeholder="<?php //echo $placeholder; ?>"/></a>
                                        <input type="hidden" name="product[image]" value="<?php echo e(old('product.image' , isset($image)? $image : 'no-image.jpg')); ?>"
                                               id="input-image"/>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id"
                                       value="<?php echo e(old('product_id' , isset($product_id) ? $product_id : '')); ?>"
                                       id="input-id"  class="form-control"/>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label"
                                           for="input-model"><?php echo e(trans('product.entry_model')); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[model]"
                                               value="<?php echo e(old('product.model' , isset($model) ? $model : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_model')); ?>" id="input-model"
                                               class="form-control"/>

                                        <?php $__errorArgs = ['product.model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                                    </div>
                                </div>
                                <div class="form-group  required">
                                    <label class="col-sm-2 control-label" for="input-sku"><span data-toggle="tooltip"
                                            title="<?php echo e(trans('product.help_sku')); ?>"><?php echo e(trans('product.entry_sku')); ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[sku]" value="<?php echo e(old('product.sku' , isset($sku) ? $sku : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_sku')); ?>" id="input-sku"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['product.sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-upc">
                                        <span data-toggle="tooltip" title="<?php echo e(trans('product.help_upc')); ?>">
                                            <?php echo e(trans('product.entry_upc')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[upc]" value="<?php echo e(old('product.upc' , isset($upc) ? $upc : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_upc')); ?>" id="input-upc"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['product.upc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-ean">
                                        <span data-toggle="tooltip" title="<?php echo e(trans('product.help_ean')); ?>">
                                            <?php echo e(trans('product.entry_ean')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[ean]"
                                               value="<?php echo e(old('product.ean' , isset($ean) ? $ean : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_ean')); ?>" id="input-ean"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['ean'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-jan">
                                        <span data-toggle="tooltip" title="<?php echo e(trans('product.help_jan')); ?>">
                                            <?php echo e(trans('product.entry_jan')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[jan]"
                                               value="<?php echo e(old('product.jan' , isset($jan) ? $jan : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_jan')); ?>" id="input-jan"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['jan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-isbn">
                                        <span data-toggle="tooltip" title="<?php echo e(trans('product.help_isbn')); ?>">
                                            <?php echo e(trans('product.entry_isbn')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[isbn]"
                                               value="<?php echo e(old('product.isbn' , isset($isbn) ? $isbn : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_isbn')); ?>" id="input-isbn"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['product.isbn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-mpn">
                                        <span data-toggle="tooltip" title="<?php echo e(trans('product.help_mpn')); ?>">
                                            <?php echo e(trans('product.entry_mpn')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[mpn]"
                                               value="<?php echo e(old('product.mpn' , isset($mpn) ? $mpn : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_mpn')); ?>" id="input-mpn"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['mpn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-location"><?php echo e(trans('product.entry_location')); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[location]"
                                               value="<?php echo e(old('product.location' , isset($location) ? $location : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_location')); ?>" id="input-location"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-price"><?php echo e(trans('product.entry_price')); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[price]"
                                               value="<?php echo e(old('product.price' , isset($price) ? $price : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_price')); ?>" id="input-price"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-tax-class"><?php echo e(trans('product.entry_tax_class')); ?></label>
                                    <div class="col-sm-10">
                                        <select name="product[tax_class_id]" id="input-tax-class" class="form-control">
                                            <option value="0"><?php echo e(trans('product.text_none')); ?></option>
                                     <?php if(isset($tax_rates )): ?>   <?php  foreach ($tax_rates as $tax_rate) { ?>
                                          <option
                                                value="<?php echo e($tax_rate['tax_rate_id']); ?>" <?php echo e(old('product.tax_class_id' ,$tax_rate['tax_rate_id']?? '' )==$tax_rate['tax_rate_id']? 'selected' : ''); ?>>
                                                <?php echo e($tax_rate['name']); ?> </option>

                                            <?php } ?>
                                         <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-quantity"><?php echo e(trans('product.entry_quantity')); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[quantity]"
                                               value="<?php echo e(old('product.quantity' , isset($quantity) ? $quantity : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_quantity')); ?>" id="input-quantity"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-minimum">
                                        <span  data-toggle="tooltip" title="<?php echo e(trans('product.help_minimum')); ?>">
                                            <?php echo e(trans('product.entry_minimum')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[minimum]"
                                               value="<?php echo e(old('product.minimum' , isset($minimum) ? $minimum : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_minimum')); ?>" id="input-minimum"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-subtract">
                                        <?php echo e(trans('product.entry_subtract')); ?>

                                    </label>
                                    <div class="col-sm-10">
                                        <select name="product[subtract]" id="input-subtract" class="form-control">
                                            <option value="1"> <?php echo e(trans('product.text_yes')); ?></option>
                                            <option  value="0"
                                                <?php echo e(old('product.subtract' , '0')== '0' ? 'selected' : ''); ?> >
                                                <?php echo e(trans('product.text_no')); ?>

                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-stock-status">
                                        <span  data-toggle="tooltip" title="<?php echo e(trans('product.help_stock_status')); ?>">
                                            <?php echo e(trans('product.entry_stock_status')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="product[stock_status_id]" id="input-stock-status"
                                                class="form-control">
                                            <?php if(isset( $data['stock_statuses'])): ?>
                                        <?php foreach ($data['stock_statuses'] as $stock_status) { ?>
                                        <?php // if ($stock_status['status_id'] == $stock_status_id) { ?>
                                        <!--   <option value="1" selected="selected"><?php //echo 'stock_status[\'name\']'; ?></option>-->
                                            <?php// } else { ?>
                                            <option
                                                value="<?php echo e($stock_status['status_id']); ?>" <?php echo e(old('product.stock_status_id')==$stock_status['status_id'] ? 'selected'  : ''); ?>>
                                                <?php echo e($stock_status['name']); ?></option>
                                            <?php //} ?>
                                            <?php } ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo e(trans('product.entry_shipping')); ?></label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                        <?php  if(isset($shipping)) { ?>
                                         <input type="radio" name="product[shipping]" value="1" checked="checked" />
                                                <?php echo e(trans('product.text_yes')); ?>

                                            <?php } else { ?>
                                            <input type="radio" name="product[shipping]" value="1"/>
                                            <?php echo e(trans('product.text_yes')); ?>

                                            <?php } ?>
                                        </label>
                                        <label class="radio-inline">
                                        <?php if(!isset($shipping)) { ?>
                                     <input type="radio" name="product[shipping]" value="0" checked="checked" />
                                                <?php echo e(trans('product.text_no')); ?>

                                            <?php } else { ?>
                                            <input type="radio" name="product[shipping]" value="0"/>
                                            <?php echo e(trans('product.text_no')); ?>

                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-keyword"><span
                                            data-toggle="tooltip" title="<?php echo e(trans('product.help_keyword')); ?>">
                                            <?php echo e(trans('product.entry_keyword')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="keyword"
                                               value="<?php echo e(old('product.keyword' , isset($keyword) ? $keyword : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_keyword')); ?>" id="input-keyword"
                                               class="form-control"/>
                                        <?php $__errorArgs = ['keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e(trans('product.error_keyword')); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-date-available">
                                        <?php echo e(trans('product.entry_date_available')); ?>

                                    </label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <input type="text" name="product[date_available]"
                                                   value="<?php echo e(old('product.date_available' , isset($date_available) ? $date_available : '')); ?>"
                                                   placeholder="<?php echo e(trans('product.entry_date_available')); ?>"
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
                                        <?php echo e(trans('product.entry_dimension')); ?>

                                    </label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="text" name="product[length]"
                                                      value="<?php echo e(old('product.length' , isset($length) ? $length : '')); ?>"
                                                       placeholder="<?php echo e(trans('product.entry_length')); ?>" id="input-length"
                                                       class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="product[width]"
                                                       value="<?php echo e(old('product.width' , isset($width) ? $width : '')); ?>"
                                                       placeholder="<?php echo e(trans('product.entry_width')); ?>" id="input-width"
                                                       class="form-control"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="product[height]"
                                                       value="<?php echo e(old('product.height' , isset($height) ? $height : '')); ?>"
                                                       placeholder="<?php echo e(trans('product.entry_height')); ?>" id="input-height"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-length-class">
                                        <?php echo e(trans('product.entry_length_class')); ?>

                                    </label>
                                    <div class="col-sm-10">
                                        <select name="product[length_class_id]" id="input-length-class" class="form-control">
                                        <?php if(isset( $data['length_classes'])): ?>
                                        <?php foreach ($data['length_classes'] as $length_class) { ?>
                                            <option  value="<?php echo e($length_class['length_class_id']); ?>"
                                                <?php echo e(old('product.length_class_id')==$length_class['length_class_id'] ? 'selected' : ''); ?>>
                                                <?php echo e($length_class['length_class_descriptions'][0]['title']); ?>

                                            </option>
                                            <?php } ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-weight"><?php echo e(trans('product.entry_weight')); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[weight]"
                                               value="<?php echo e(old('product.weight' , isset($weight) ? $weight : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_weight')); ?>" id="input-weight"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-weight-class"><?php echo e(trans('product.entry_weight_class')); ?></label>
                                    <div class="col-sm-10">
                                        <select name="product[weight_class_id]" id="input-weight-class"
                                                class="form-control">
                                        <?php if(isset( $data['weight_classes'])): ?>
                                        <?php foreach ($data['weight_classes'] as $weight_class) { ?>
                                            <option
                                                value="<?php echo e($weight_class['weight_class_id']); ?>" <?php echo e(old('product.weight_class_id')==$weight_class['weight_class_id'] ? 'selected' : ''); ?>> <?php echo e($weight_class['weight_class_descriptions'][0]['title']); ?> </option>

                                            <?php } ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-status"><?php echo e(trans('product.entry_status')); ?></label>
                                    <div class="col-sm-10">
                                        <select name="product[status]" id="input-status" class="form-control">
                                            <option value="1" <?php echo e(old('product.status')=== 1 ? 'selected' : ''); ?>><?php echo e(trans('product.text_enabled')); ?>

                                            </option>
                                            <option
                                                value="0" <?php echo e(old('product.status')=== 0 ? 'selected' : ''); ?>><?php echo e(trans('product.text_disabled')); ?></option>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"
                                           for="input-sort-order"><?php echo e(trans('product.entry_sort_order')); ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product[sort_order]"
                                               value="<?php echo e(old('product.sort_order' , isset($sort_order) ? $sort_order : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_sort_order')); ?>" id="input-sort-order"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-links">
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-manufacturer">
                                        <span  data-toggle="tooltip" title="<?php echo e(trans('product.help_manufacturer')); ?>">
                                            <?php echo e(trans('product.entry_manufacturer')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="manufacturer"
                                               value="<?php echo e(old('manufacturer' , isset($manufacturer) ? $manufacturer->name : '')); ?>"
                                               placeholder="<?php echo e(trans('product.entry_manufacturer')); ?>"
                                               id="input-manufacturer" class="form-control"/>
                                        <input type="hidden" name="product[manufacturer_id]"
                                               value="<?php echo e(old('product.manufacturer_id' , isset($manufacturer) ? $manufacturer->id : '')); ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-category">
                                        <span  data-toggle="tooltip"  title="<?php echo e(trans('product.help_category')); ?>">
                                            <?php echo e(trans('product.entry_category')); ?>

                                        </span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="category" value=""
                                               placeholder="<?php echo e(trans('product.entry_category')); ?>" id="input-category"
                                               class="form-control"/>
                                        <div id="product-category" class="well well-sm"
                                             style="height: 150px; overflow: auto;">
                                            <?php if(isset($categories) && $categories !== null): ?>
                                              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div id="product-category"><i class="fa fa-minus-circle"></i>
                                                     <?php echo e($category['name']); ?>

                                                        <input type="hidden" name="product_category[]" value=" <?php echo e($category['category_id']); ?>" />
                                                 </div>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-related"><span
                                            data-toggle="tooltip"
                                            title="<?php echo e(trans('product.help_related')); ?>"><?php echo e(trans('product.entry_related')); ?></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="related" value=""
                                               placeholder="<?php echo e(trans('product.entry_related')); ?>" id="input-related"
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
                                        <?php if(isset($product_attributes)): ?>
                                      <?php $__currentLoopData = $product_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="attribute-row<?php echo $attribute_row; ?>">
                                            <td class="text-left" style="width: 45%;">
                                                <input type="text"
                                                                  name="product_attribute[<?php echo $attribute_row ; ?>][name]"
                                                                  value="<?php echo $product_attribute['name']; ?>"
                                                                  placeholder="<?php echo e(trans('product.entry_attribute')); ?>"
                                                                  class="form-control"/>
                                                <input type="hidden"
                                                       name="product_attribute[<?php echo $attribute_row ; ?>][attribute_id]"
                                                       value="<?php echo $product_attribute['attribute_id']; ?>"/>
                                            </td>
                                            <td class="text-right">
                                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <img  src="<?php echo e(asset('/view/image/' .$language['image'])); ?>"
                                                            title="<?php echo $language['name']; ?>"/>
                                                    </span>
                                                    <textarea name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo 'entry_text'; ?>" class="form-control"><?php echo isset($product_attribute['product_attribute_description'][$language['language_id']]) ? $product_attribute['product_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addAttribute();" data-toggle="tooltip"
                                                        title="<?php echo e(trans('product.button_attribute_add')); ?>"
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
                                            <td class="text-left"><?php echo e(trans('product.entry_customer_group')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_quantity')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_priority')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_price')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_date_start')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_date_end')); ?></td>
                                            <td  class="text-left">Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <?php $discount_row = 0 ;?>
                                        <?php if(isset($product_discounts)): ?>
                                        <?php $__currentLoopData = $product_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="discount-row<?php echo e($discount_row); ?>">
                                            <td class="text-left">
                                                <select
                                                    name="product_discount[<?php echo $discount_row; ?>][customer_group_id]"
                                                    class="form-control">
                                                    <?php $__currentLoopData = $customer_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e(old('product_discount'.$discount_row.'customer_group_id' ,$product_discount['customer_group_id'] ??'')==$key ? 'selected' : ''); ?>> <?php echo e($group['name']); ?></option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                                                                          placeholder="<?php echo e(trans('product.entry_priority')); ?>"
                                                                          class="form-control"/></td>
                                            <td class="text-right"><input type="text"
                                                                          name="product_discount[<?php echo $discount_row; ?>][price]"
                                                                          value="<?php echo $product_discount['price']; ?>"
                                                                          placeholder="<?php echo e(trans('product.entry_price')); ?>"
                                                                          class="form-control"/></td>
                                            <td class="text-left" style="width: 20%;">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="product_discount[<?php echo $discount_row; ?>][date_start]"
                                                           value="<?php echo $product_discount['date_start']; ?>"
                                                           placeholder="<?php echo e(trans('product.entry_date_start')); ?>"
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
                                                           placeholder="<?php echo e(trans('product.entry_date_end')); ?>"
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
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addDiscount();" data-toggle="tooltip"
                                                        title="<?php echo e(trans('product.button_discount_add')); ?>"
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
                                            <td class="text-left"><?php echo e(trans('product.entry_customer_group')); ?></td>
                                            <td class="text-right"><?php echo e(trans('product.entry_priority')); ?></td>
                                            <td class="text-right"><?php echo e(trans('product.entry_price')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_date_start')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_date_end')); ?></td>
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
                                                    <?php $__currentLoopData = $customer_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e(old('product_special'.$discount_row.'customer_group_id' ,$product_special['customer_group_id'] ??'')==$key ? 'selected' : ''); ?>> <?php echo e($group['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select></td>
                                            <td class="text-right">
                                                <input type="text"
                                                                          name="product_special[<?php echo $special_row; ?>][priority]"
                                                                          value="<?php echo e(old('product_special.'.$special_row.'.priority',$product_special['priority'])); ?>"
                                                                          placeholder="<?php echo e(trans('product.entry_quantity')); ?>"
                                                                          class="form-control"/>

                                                <input type="hidden"
                                                       name="product_special[<?php echo $special_row; ?>][product_special_id]"
                                                       value="<?php echo e(old('product_special.'.$special_row.'.product_special_id',$product_special['product_special_id'])); ?>"
                                                       class="form-control"/>    </td>
                                            <td class="text-right">
                                                <input type="text"
                                                                          name="product_special[<?php echo $special_row; ?>][price]"
                                                                          value="<?php echo e(old('product_special.'.$special_row.'.price',$product_special['price'])); ?>"
                                                                          placeholder="<?php echo e(trans('product.entry_price')); ?>"
                                                                          class="form-control"/>
                                            </td>
                                            <td class="text-left" style="width: 20%;">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="product_special[<?php echo $special_row; ?>][date_start]"
                                                           value="<?php echo e(old('product_special.'.$special_row.'.date_start',$product_special['date_start'])); ?>"
                                                           placeholder="<?php echo e(trans('product.entry_date_start')); ?>"
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
                                                           value="<?php echo e(old('product_special.'.$special_row.'.date_end',$product_special['date_end'])); ?>"
                                                           placeholder="<?php echo e(trans('product.entry_date_end')); ?>"
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
                                                        title="<?php echo e(trans('product.button_special_add')); ?>"
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
        <?php $__env->startPush('scripts'); ?>
            <script type="text/javascript">


                // Manufacturer
                $('input[name=\'manufacturer\']').autocomplete({
                    'source': function (request, response) {
                        var filter_name1 = $(this).val();
                        $.ajax({
                            url: "<?php echo e(url('admin/products/manufacturer_autocomplete')); ?>",
                            type: "post",
                            dataType: 'json',
                            data: {filter_name: filter_name1  ,   _token: '<?php echo e(csrf_token()); ?>'},
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
                            url: "<?php echo e(url('admin/products/CategoriesAutocomplete')); ?>",
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
                    '<input type="text" name="product_attribute['+ attribute_row +'][name]" value="" placeholder="<?php echo e(trans('product.entry_attribute')); ?>" class="form-control" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
                html += '  <td class="text-left">';
                <?php foreach ($languages as $language) { ?>
                    html += '<div class="input-group"><span class="input-group-addon"><img src="<?php echo e(asset('/view/image/'.$language['image'])); ?>" title="<?php echo $language['name']; ?>" /></span><textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo 'entry_text'; ?>" class="form-control"></textarea></div>';
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
                            url: "<?php echo e(route('attribute.autocomplete')); ?>",
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
                        html += '  <option value="<?php echo e($key); ?>" <?php echo e(old('product_discount'.$discount_row.'customer_group_id')==$key ? 'selected' : ''); ?>> <?php echo e($group['name']); ?></option>';
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
                    html += '  <option value="<?php echo e($key); ?>" <?php echo e(old("product_special" . $special_row . "customer_group_id" )==$key ? 'selected' : ''); ?>> <?php echo e($group['name']); ?></option>';
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

        <?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/product_form.blade.php ENDPATH**/ ?>