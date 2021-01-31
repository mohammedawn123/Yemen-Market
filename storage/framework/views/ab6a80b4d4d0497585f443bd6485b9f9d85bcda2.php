 <?php $__env->startSection('content'); ?>

     <?php $__env->startPush('title'); ?>
         <title><?php echo e($title); ?></title>
     <?php $__env->stopPush(); ?>
  <div class="container-fluid">

      <div class="panel panel-default">
          <div class="panel-heading">

              <h3 class="panel-title"><i class="fa fa-user"> </i>Customer Group Form</h3>
          </div>

      <div class="panel-body">


        <form action="<?php echo e($action); ?>" method="post"   class="form-horizontal" id="form-customer_group">
            <?php echo e(csrf_field()); ?>

            <div class="tab-content">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sort_order">Sort Order</label>
                    <div class="col-sm-8">
                        <input type="text" name="sort" value="<?php echo e($customer_group->sort_order ?? ''); ?>" placeholder="sort order" id="sort_order" class="form-control">
                        <input type="hidden" name="id" value="<?php echo e($customer_group->customer_group_id ?? ''); ?>" placeholder="sort order" id="customer_group_id" class="form-control">
                        <?php $__errorArgs = ['sort'];
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
                    <label class="col-sm-2 control-label" for="input-status">
                        <?php echo e(trans('customer.status')); ?>

                    </label>
                    <div class="col-sm-8">
                        <select name="status" id="input-status"
                                class="form-control">
                            <option value="1" <?php echo e(old('status' ,$customer_group->status ?? '')==1 ? 'selected' : ''); ?>> Enabled</option>
                            <option value="0" <?php echo e(old('status' ,$customer_group->status ?? '')==0 ? 'selected' : ''); ?>> Disabled</option>
                        </select>
                    </div>
                </div>
                <br>
                <br>
            <ul class="nav nav-tabs">

                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="<?php echo e(($language['code'])==='en' ? 'active' : ''); ?>">
                          <a href="#tab-<?php echo e($language['code']); ?>" data-toggle="tab">
                              <img src="<?php echo e(asset('/view/image/' .$language['image'])); ?>" title="<?php echo e($language['code']); ?>" />
                              <?php echo e($language['name']); ?>

                          </a>
                      </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
<?php

$description=isset($customer_group)?  $customer_group->descriptions->keyBy('language_id')->toArray() :'';

?>
                <div class="tab-content">
            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane <?php echo e(($language['code'])==='en' ? 'active' : ''); ?>" id="tab-<?php echo e($language['code']); ?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="city">Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="customer_group[<?php echo e($language['language_id']); ?>][name]" value="<?php echo e($description[$language['language_id']]['name'] ??''); ?>" placeholder="name" id="name" class="form-control">
                                <input type="hidden" name="customer_group[<?php echo e($language['language_id']); ?>][language_id]" value="<?php echo e($language['language_id']); ?>" placeholder="name" id="id" class="form-control">
                                <?php $__errorArgs = ['name'];
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
                                   for="input-description<?php echo e($language['language_id']); ?>"><?php echo e(trans('product.entry_description')); ?></label>
                            <div class="col-sm-8">
                                                <textarea
                                                    name="customer_group[<?php echo e($language['language_id']); ?>][description]"
                                                    placeholder="<?php echo e(trans('product.entry_description')); ?>"
                                                    id="input-description<?php echo e($language['language_id']); ?>">
                                                    <?php echo e($description[$language['language_id']]['description'] ??''); ?>


                                                    </textarea>
                                <?php $__errorArgs = ['description'];
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            </div>
               </form>
        </div>

  </div>


    <?php $__env->stopSection(); ?>
<?php $__env->startPush('customer_group'); ?>
          <script type="text/javascript"><!--
              <?php foreach ($languages as $language) { ?>
              $('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
              <?php } ?>
              //--></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/customer_group_form.blade.php ENDPATH**/ ?>