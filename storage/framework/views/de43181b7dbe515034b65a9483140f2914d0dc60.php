<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('shop.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="account-register" class="container">

        <div class="row">
            <div id="content" class="col-sm-9">
                <h1>Register Account</h1>
                <p>If you already have an account with us, please login at the
                    <a href="<?php echo e(route('shop.loginForm')); ?>">login page</a>.</p>
                <form action="<?php echo e(route('register')); ?>" method="post"   class="form-horizontal">
                    <?php echo csrf_field(); ?>
                    <div class="tab-pane  active" >
                        <br>

                        <fieldset id="account">
                            <legend>Your Personal Details</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="first_name"><?php echo e(trans('customer.first_name')); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" required name="first_name" value="<?php echo e(old('first_name' ,isset($customer->first_name) ? $customer->first_name : '')); ?>" placeholder="<?php echo e(trans('customer.first_name')); ?>" id="first_name" class="form-control">
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


                        <fieldset id="account">
                            <legend>Your Password</legend>
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
                                    <input type="password" name="Confirmation"  value="" placeholder="Confirmation" id="Confirmation" class="form-control">
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
                    <div class="buttons">
                        <div class="pull-right">

                            <input type="submit" value="<?php echo e(__('Register')); ?>" class="btn btn-primary">
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(url('/')); ?>/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('javaScripts'); ?>
    <script src="<?php echo e(url('/')); ?>/view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/auth/register.blade.php ENDPATH**/ ?>