 <?php $__env->startSection('content'); ?>

     <?php $__env->startPush('title'); ?>
         <title><?php echo e($title); ?></title>
     <?php $__env->stopPush(); ?>
  <div class="container-fluid">

      <div class="panel panel-default">


      <div class="panel-body">


        <form action="<?php echo e($action); ?>" method="post"   class="form-horizontal" id="form-customer">
            <?php echo e(csrf_field()); ?>

            <div class="tab-pane  active" >
<br>

                <fieldset id="account">
                    <legend>Customer Personal Details</legend>
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="first_name"><?php echo e(trans('customer.first_name')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" required name="first_name" value="<?php echo e(old('first_name' ,isset($customer->first_name) ? $customer->first_name : '')); ?>" placeholder="<?php echo e(trans('customer.first_name')); ?>" id="first_name" class="form-control">
                        <input type="hidden" name="customer_id" value="<?php echo e($customer->customer_id ?? ''); ?>"  class="form-control">
                        <?php $__errorArgs = ['first_name'];
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
                    <label class="col-sm-2 control-label" for="last_name"><?php echo e(trans('customer.last_name')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" value="<?php echo e(old('last_name' ,isset($customer->last_name) ? $customer->last_name : '')); ?>" placeholder="<?php echo e(trans('customer.last_name')); ?>" id="last_name" class="form-control">
                       <?php $__errorArgs = ['last_name'];
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
                    <label class="col-sm-2 control-label" for="customer_group">
                        <?php echo e(trans('customer.group')); ?>

                    </label>
                    <div class="col-sm-8">
                        <select name="customer_group" id="customer_group"
                                class="form-control">
                            <?php $__currentLoopData = $customer_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(old('customer_group' ,$customer->customer_group_id ??'')==$key ? 'selected' : ''); ?>> <?php echo e($group['name']); ?></option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>


                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="phone"><?php echo e(trans('customer.phone')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="phone" value="<?php echo e(old('phone' ,isset($customer->phone) ? $customer->phone : '')); ?>" placeholder="0........" id="phone" class="form-control">
                        <?php $__errorArgs = ['phone'];
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
                    <label class="col-sm-2 control-label">Sex</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="1" <?php echo e(old('sex' ,$customer->sex ??'')==1 ? 'checked' : ''); ?> />
                            <?php echo e('men'); ?>

                        </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="0" <?php echo e(old('sex' ,$customer->sex ??'')==0 ? 'checked' : ''); ?>/>
                                    <?php echo e('women'); ?>


                                </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"
                           for="input-date-birthday">
                        <?php echo e(trans('customer.birthday')); ?> Date
                    </label>
                    <div class="col-sm-3">
                        <div class="input-group date">
                            <input type="text" name="birthday"
                                   value="<?php echo e(old('birthday' , $customer->birthday ?? null)); ?>"
                                   placeholder="<?php echo e(trans('customer.birthday')); ?>"
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
                    <label class="col-sm-2 control-label" for="email"><?php echo e(trans('customer.email')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="email" value="<?php echo e(old('email' ,isset($customer->email) ? $customer->email : '')); ?>" placeholder="<?php echo e(trans('customer.email')); ?>" id="email" class="form-control">
                        <?php $__errorArgs = ['email'];
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

                </fieldset>

                 <div class="form-group required">
                    <label class="col-sm-2 control-label" for="country">
                        <?php echo e(trans('customer.country')); ?>

                    </label>
                    <div class="col-sm-8">
                        <select name="country" id="country"
                                class="form-control">
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(old('country' ,$customer->country ?? 'YE')==$key ? 'selected' : ''); ?>> <?php echo e($country['name']); ?></option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="city"><?php echo e(trans('customer.city')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="city" value="<?php echo e(old('city' ,$customer->city?? '')); ?>" placeholder="<?php echo e(trans('customer.city')); ?>" id="city" class="form-control">
                        <?php $__errorArgs = ['city'];
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
                    <label class="col-sm-2 control-label" for="address1"><?php echo e(trans('customer.address1')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="address1" value="<?php echo e(old('address1' ,isset($customer->address_1) ? $customer->address_1 : '')); ?>" placeholder="<?php echo e(trans('customer.address1')); ?>" id="address1" class="form-control">
                        <?php $__errorArgs = ['address1'];
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
                    <label class="col-sm-2 control-label" for="address2"><?php echo e(trans('customer.address2')); ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="address2" value="<?php echo e(old('address2' ,isset($customer->address_2) ? $customer->address_2 : '')); ?>" placeholder="<?php echo e(trans('customer.address2')); ?>" id="address2" class="form-control">
                        <?php $__errorArgs = ['address2'];
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
                                 <option value="1" <?php echo e(old('status' ,$customer->status ?? '')==1 ? 'selected' : ''); ?>> Enabled</option>
                                 <option value="0" <?php echo e(old('status' ,$customer->status ?? '')==0 ? 'selected' : ''); ?>> Disabled</option>
                        </select>
                    </div>
                </div>
                <fieldset id="account">
                    <legend>Customer Password</legend>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="password"><?php echo e(trans('customer.password')); ?></label>
                        <div class="col-sm-8">
                            <input type="password" name="password" value="" placeholder="<?php echo e(trans('customer.password')); ?>" id="password" class="form-control">
                            <?php $__errorArgs = ['password'];
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
                        <label class="col-sm-2 control-label" for="Confirmation">Confirmation</label>
                        <div class="col-sm-8">
                            <input type="password" name="Confirmation" value="" placeholder="Confirmation" id="Confirmation" class="form-control">
                            <?php $__errorArgs = ['Confirmation'];
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
                </fieldset>

            </div>
        </form>
        </div>

  </div>


    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/customer_form.blade.php ENDPATH**/ ?>