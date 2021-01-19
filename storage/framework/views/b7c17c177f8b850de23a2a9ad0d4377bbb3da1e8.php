 <?php $__env->startSection('content'); ?>



     <div class="container-fluid">

    <div class="panel panel-default">

      <div class="panel-body">
        <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data" id="form-category" class="form-horizontal">

        <?php echo e(csrf_field()); ?>

          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo e(trans('product.tab_general')); ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo e(trans('product.tab_data')); ?></a></li>
            <li><a href="#tab-design" data-toggle="tab"><?php echo e(trans('product.tab_design')); ?> </a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">




              <ul class="nav nav-tabs" id="language">
                  <?php
                  foreach ($languages as $language){
                  ?>
                  <li class="<?php echo $language['language_id']==1 ? 'active' : '' ; ?>">
                      <a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
                          <img src="<?php echo e(asset('/view/image/' .$language['image'])); ?>" title="<?php echo $language['name']; ?> " />
                          <?php echo $language['name']; ?>
                      </a>
                  </li>

                  <?php } ?>
              </ul>

                <div class="tab-content">
                    <?php
                    foreach ($languages as $language){
                    ?>
                        <div class="tab-pane <?php echo $language['language_id']==1 ? 'active' : '' ; ?>" id="language<?php echo $language['language_id']; ?>">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name<?php  echo $language['language_id']; ?>"><?php echo e(trans('category.entry_name')); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="category_description[<?php echo $language['language_id'] ; ?>][name]" value="<?php  echo isset($Category['category_description'][ $language['language_id'] ]['name'] ) ? $Category['category_description'][ $language['language_id'] ]['name'] : ''; ?>" placeholder="<?php echo e(trans('category.entry_name')); ?>"   id="input-name<?php echo $language['language_id'] ;  ?>" class="form-control" />
                                    <input type="hidden" name="category_description[<?php echo $language['language_id'] ; ?>][language_id]" value="<?php  echo isset($Category['category_description'][ $language['language_id'] ]['language_id'] ) ? $Category['category_description'][ $language['language_id']  ]['language_id'] : $language['language_id'] ; ?>"  id="input-name<?php echo $language['language_id'];  ?>" class="form-control" />
                                    <input type="hidden" name="category_id" value="<?php echo isset($Category['category_id'] ) ?
                                        $Category['category_id'] : '0';  ?>" />

                                    <?php if (isset($error_name[$language['language_id']])) { ?>
                                    <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description<?php  echo $language['language_id'];  ?>"><?php echo e(trans('category.entry_description')); ?></label>
                                <div class="col-sm-10">
                                    <textarea name="category_description[<?php echo $language['language_id'] ;  ?>][description]" placeholder="<?php echo e(trans('category.entry_description')); ?>" id="input-description<?php echo $language['language_id'];  ?>" class="form-control"><?php  echo isset($Category['category_description'][$language['language_id']]['description']) ? $Category['category_description'][$language['language_id']]['description'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"> <?php echo e(trans('category.entry_meta_title')); ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="category_description[<?php echo $language['language_id'] ; ?>][meta_title]" value="<?php  echo isset($Category['category_description'][$language['language_id']]['meta_title']) ? $Category['category_description'][$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo e(trans('category.entry_meta_title')); ?>" id="input-meta-title<?php  echo $language['language_id'] ; ?>" class="form-control" />
                                    <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                                    <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"> <?php echo e(trans('category.entry_meta_description')); ?></label>
                                <div class="col-sm-10">
                                    <textarea name="category_description[<?php  echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo e(trans('category.entry_meta_description')); ?>" id="input-meta-description<?php  echo $language['language_id']; ?>" class="form-control"><?php echo isset($Category['category_description'][$language['language_id']]['meta_description'] ) ? $Category['category_description'][ $language['language_id']]['meta_description'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-meta-keyword<?php  echo $language['language_id']; ?>"><?php echo e(trans('category.entry_meta_keyword')); ?> </label>
                                <div class="col-sm-10">
                                <textarea name="category_description[<?php   echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo e(trans('category.entry_meta_keyword')); ?>" id="input-meta-keyword<?php  echo $language['language_id'] ; ?>" class="form-control"><?php echo isset($Category['category_description'][$language['language_id']]['meta_keyword'] ) ?
                              $Category['category_description'][ $language['language_id'] ]['meta_keyword'] : '';    ?></textarea>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent"><?php echo e(trans('category.entry_parent')); ?></label>
                <div class="col-sm-10">
                      <input type="text" name="path" value="<?php echo e(isset($Category['parent_category'][0]['name'] ) ? $Category['parent_category'][0]['name'] : ''); ?>" placeholder="<?php echo e(trans('category.entry_parent')); ?>" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="<?php echo isset($Category['parent_id'] ) ?
 $Category['parent_id'] : '0';  ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php //echo $help_keyword; ?>"><?php echo e(trans('category.entry_keyword')); ?> </span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo isset($Category['category_description']['meta_keyword'] ) ? $Category['category_description']['meta_keyword'] : '';  ?>" placeholder="<?php echo e(trans('category.entry_keyword')); ?> " id="input-keyword" class="form-control" />
                  <?php //if ($error_keyword) { ?>
                 <!-- <div class="text-danger"><?php ////echo $error_keyword; ?></div> -->
                  <?php //} ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo e(trans('category.entry_image')); ?> </label>
                <div class="col-sm-3">
                    <a href="" id="thumb-image" data-toggle="image" class="thumbnail">
                        <img src="<?php echo isset($Category['image'] ) ? asset('/view/image/' .$Category['image'])  : asset('/view/image/no-image.jpg') ;  ?>" alt="" title="" data-placeholder="<?php //echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo isset($Category['image'] ) ? $Category['image']  : 'no-image.jpg' ;  ?>" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="<?php //echo $help_top; ?>"><?php echo e(trans('category.entry_top')); ?> </span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php  if ( isset($Category['parent_id']) && $Category['parent_id']=="0" ) { ?>
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      <?php  } else { ?>
                     <input type="checkbox" name="top" value="0" id="input-top" />
                      <?php  } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-column"><span data-toggle="tooltip" title="<?php //echo $help_column; ?>"><?php echo e(trans('category.entry_column')); ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="column" value="<?php  echo isset($Category['column'] ) ? $Category['column'] : ''; ?>" placeholder="<?php echo e(trans('category.entry_column')); ?>" id="input-column" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"> <?php echo e(trans('category.entry_sort_order')); ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php  echo isset($Category['sort_order'] ) ? $Category['sort_order'] : ''; ?>" placeholder=" <?php echo e(trans('category.entry_sort_order')); ?>" id="input-sort-order" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">   <?php echo e(trans('category.entry_status')); ?> </label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php  if (isset($Category['status'])) { ?>
                        <?php  if ($Category['status']==1) { ?>
                    <option value="1" selected="selected">   <?php echo e(trans('category.text_enabled')); ?>  </option>
                    <option value="0" >  <?php echo e(trans('category.text_disabled')); ?>   </option>
                  <?php  } else { ?> ?>
                  <option value="1"  >  <?php echo e(trans('category.text_enabled')); ?>   </option>
                    <option value="0" selected="selected"> <?php echo e(trans('category.text_disabled')); ?>  </option>
                     <?php  } ?>
                    <?php } else { ?>
                     <option value="1"> <?php echo e(trans('category.text_enabled')); ?>  </option>
                    <option value="0" selected="selected"> <?php echo e(trans('category.text_disabled')); ?>  </option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                 </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php $__env->stopSection(); ?>

<?php $__env->startPush('category_scripts'); ?>
    <script type="text/javascript">
        <?php foreach ($languages as $language) { ?>
        $('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
        <?php } ?>
        </script>
    <script type="text/javascript">
        $('input[name=\'path\']').autocomplete({
            'source': function(request, response) {
                var filter_name1=$(this).val();

                $.ajax({
                    url: "<?php echo e(url('admin/categories/autocomplete')); ?>"  ,
                    type:"post" ,
                    dataType: 'json',
                    data: { filter_name: filter_name1 } ,
                    success: function(json) {
                        json.unshift({
                            category_id: 0,
                            name: ' --- None --- '
                        });

                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['category_id']
                            }
                        }));

                    }
                });
            },
            'select': function(item) {
                $('input[name=\'path\']').val(item['label']);
                $('input[name=\'parent_id\']').val(item['value']);
            }
        });



    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/category_form.blade.php ENDPATH**/ ?>