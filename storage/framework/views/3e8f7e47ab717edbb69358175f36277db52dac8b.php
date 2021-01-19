<?php $__env->startSection('content'); ?>

        <div class="container-fluid"><br />
            <br />
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title"><i class="fa fa-lock"></i> <?php echo e(trans('product.text_login')); ?> </h1>
                        </div>
                        <div class="panel-body">
                            <?php  if (isset($success)) { ?>
                         <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo e($success); ?>

                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php } ?>
                            <?php  if (isset($error_login) ){ ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo e($error_login); ?>

                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php  } ?>
                            <form action="<?php echo e(route('admin.login')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="input-email"><?php echo e(trans('product.entry_email')); ?></label>
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="email"  placeholder="<?php echo e(trans('product.entry_email')); ?>" id="input-email" class="form-control" />

                                    </div>
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
                                <div class="form-group">
                                    <label for="input-password"><?php echo e(trans('product.entry_password')); ?></label>
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="password"  placeholder="<?php echo e(trans('product.entry_password')); ?>" id="input-password" class="form-control" />
                                    </div>
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
                                    <?php // if ($forgotten) { ?>
                                    <span class="help-block"><a href="#"><?php echo e(trans('product.text_forgotten')); ?></a></span>
                                    <?php // } ?>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo e(trans('product.button_login')); ?></button>
                                </div>
                                <?php // if ($redirect) { ?>
                                <input type="hidden" name="redirect" value="<?php echo 'redirect'; ?>" />
                                <?php // } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.auth.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>