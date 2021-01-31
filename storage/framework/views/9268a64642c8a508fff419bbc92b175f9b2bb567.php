<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('shop.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-account" data-toggle="tab">My Account</a></li>

            <li><a href="#tab-addresses" data-toggle="tab">Addresses</a></li>
            <li><a href="#tab-wishlist" data-toggle="tab">Wish List</a></li>
            <li><a href="#tab-order" data-toggle="tab">Order History</a></li>

        </ul>


        <div class="tab-content" style="min-height: 450px; padding: 10px;">

            <div class="tab-pane active" id="tab-account">
                <div id="content" class="col-sm-9">
                    <h1>My Account Information</h1>
                    <form action="<?php echo e(route('customer.update')); ?>" method="post"   class="form-horizontal">
                        <?php echo csrf_field(); ?>
                        <fieldset>
                            <legend>Personal Details</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">First Name </label>
                                <div class="col-sm-8">
                                    <input type="text" name="first_name" value="<?php echo e($user->first_name); ?>" placeholder="First Name" id="input-firstname" class="form-control">
                                    <input type="hidden" name="customer_id" value="<?php echo e($user->customer_id); ?>"  id="customer_id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_name" value="<?php echo e($user->last_name); ?>" placeholder="Last Name" id="input-lastname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="<?php echo e($user->email); ?>" placeholder="E-Mail" id="input-email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                                <div class="col-sm-8">
                                    <input type="tel" name="phone" value="<?php echo e($user->phone); ?>" placeholder="Telephone" id="input-telephone" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sex</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="1" <?php echo e($user->sex  ==1 ? 'checked' : ''); ?> />
                                        <?php echo e('men'); ?>

                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" value="0" <?php echo e($user->sex   ==0 ? 'checked' : ''); ?>/>
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
                                               value="<?php echo e($user->birthday); ?>"
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
                                <label class="col-sm-2 control-label" for="country">
                                    <?php echo e(trans('customer.country')); ?>

                                </label>
                                <div class="col-sm-8">
                                    <select name="country" id="country"
                                            class="form-control">
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php echo e($user->country ==$key ? 'selected' : ''); ?>> <?php echo e($country['name']); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="city"><?php echo e(trans('customer.city')); ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="city" value="<?php echo e($user->city); ?>" placeholder="<?php echo e(trans('customer.city')); ?>" id="city" class="form-control">
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
                                    <input type="text" name="address1" value="<?php echo e(old('address1' ,isset($user->address_1) ? $user->address_1 : '')); ?>" placeholder="<?php echo e(trans('customer.address1')); ?>" id="address1" class="form-control">
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
                                    <input type="text" name="address2" value="<?php echo e(old('address2' ,isset($user->address_2) ? $user->address_2 : '')); ?>" placeholder="<?php echo e(trans('customer.address2')); ?>" id="address2" class="form-control">
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

                        </fieldset>
                        <fieldset id="account">
                            <legend>Password</legend>
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
                        <div class="buttons clearfix">
                            <div class="pull-right">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane" id="tab-addresses">
                <div class="row">
                    <div id="content" class="col-sm-9">
                        <h2>My Addresses</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td class="text-center">ID</td>
                                    <td class="text-center">First Name</td>
                                    <td class="text-left">Last Name</td>
                                    <td class="text-left">Phone</td>
                                    <td class="text-left">Address1</td>
                                    <td class="text-left">Address2</td>
                                    <td class="text-left">Country</td>
                                    <td class="text-left">City</td>
                                    <td class="text-left">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">
                                       <?php echo e($addresses->address_id); ?>

                                        </td>
                                    <td class="text-center">
                                        <?php echo e($addresses->first_name); ?>

                                    </td>
                                    <td class="text-left">
                                        <?php echo e($addresses->last_name); ?>

                                    </td>
                                    <td class="text-left"><?php echo e($addresses->phone); ?></td>
                                    <td class="text-left"><?php echo e($addresses->address_1); ?></td>
                                    <td class="text-left">
                                        <?php echo e($addresses->address_2); ?>

                                    </td>
                                    <td class="text-left">
                                        <?php echo e($addresses->country); ?>

                                    </td>
                                    <td class="text-left">
                                        <?php echo e($addresses->city); ?>

                                    </td>
                                    <td style="width: 170px; ">
                                        <a href="#">
                                         <span data-toggle="tooltip" data-original-title="Edit Customer" type="button" class="btn btn-flat btn-primary" aria-describedby="tooltip218356">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                     </a>&nbsp;
                                        <span  data-toggle="tooltip" data-original-title="Delete Customer" class="btn btn-flat btn-danger">
                                                  <i class="fa fa-trash"></i>
                                          </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="buttons clearfix">
                            <div class="pull-right"><span   class="btn btn-primary">Add New</span></div>
                        </div>
                    </div>

                </div>
            </div>
             <div class="tab-pane" id="tab-wishlist">
                 <div class="row">
                     <?php $wishlist= Cart::getListCart('wishlist'); ?>
                     <div id="content" class="col-sm-9">
                         <h2>My Wish List</h2>
                         <div class="table-responsive">
                             <table class="table table-bordered table-hover">
                                 <thead>
                                 <tr>
                                     <td class="text-center">ID</td>
                                     <td class="text-left">Image</td>
                                     <td class="text-left">Name</td>
                                     <td class="text-left">Price</td>
                                     <td class="text-left">Action</td>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <?php $__currentLoopData = $wishlist['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                     <td class="text-center">
                                         <?php echo e($list['id']); ?>

                                     </td>
                                     <td class="text-left">
                                         <?php echo $list['image']; ?>


                                     </td>
                                     <td class="text-left">
                                         <?php echo e($list['name']); ?>

                                     </td>
                                     <td class="text-left">  <?php echo e(currency_symbol($list['price'])); ?></td>


                                     <td style="width: 170px; ">
                                         <button type="button" onclick="addToCart('<?php echo e($list['id']); ?>' ,'default')" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                                         <span  data-toggle="tooltip" data-original-title="Delete Customer" class="btn btn-flat btn-danger">
                                                  <i class="fa fa-trash"></i>
                                          </span>
                                     </td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </tbody>
                             </table>
                         </div>

                     </div>

                 </div>
            </div>
             <div class="tab-pane" id="tab-order">



                 Left (default):
                 <div class="marquee">jQuery marquee is the best marquee plugin in the world</div>
                 <br/>

                 Right:
                 <div class="marquee" data-direction='right'   data-gap='80'   >نیوزی لینڈ کے شہر ہیملٹن میں کھیلے جانے والے چوتھے میچ میں بھارت کو سات وکٹ سے شکست کا سامنا کرنا پڑا ہ</div>
                 <br/>

                 Up:
                 <div class="marquee ver" data-direction='up' data-duration='1000' data-pauseOnHover="true">jQuery marquee is the best marquee plugin in the world. jQuery marquee is the best marquee plugin in the world <b>end</b></div>
                 <br/>

                 Down:
                 <div class="marquee ver" data-direction='down' data-duration=1000>jQuery marquee is the best marquee plugin in the world. jQuery marquee is the best marquee plugin in the world <b>end</b></div>
                 <br/>


             </div>


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

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/account.blade.php ENDPATH**/ ?>