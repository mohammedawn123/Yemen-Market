<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('shop.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="row">
        <div id="content" class="col-sm-9">
            <div class="row">
                <div class="col-sm-6">
                    <div class="well" style="background-color: #fff;">
                        <h2>New Customer</h2>
                        <p><strong>Register Account</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Continue</a></div>
                </div>
                <div class="col-sm-6">
                    <div class="well"  style="background-color: #fff;">
                        <?php  if (isset($error_login) ){ ?>
                        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo e($error_login); ?>

                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php  } ?>
                        <form method="POST" action="<?php echo e(route('shop.login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="control-label" for="input-email"><?php echo e(__('E-Mail Address')); ?></label>
                                <input type="email" name="email"   placeholder="E-Mail Address" id="input-email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-password"><?php echo e(__('Password')); ?></label>
                                <input type="password" value="" placeholder="Password" id="input-password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                        <label class="form-check-label" for="remember">
                                            <?php echo e(__('Remember Me')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Login')); ?>

                                    </button>

                                    <?php if(Route::has('password.request')): ?>
                                        <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                            <?php echo e(__('Forgot Your Password?')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
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
<?php $__env->stopSection(); ?>
<!--Shift+Ctrl+Alt+J
Alt+J-->

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/auth/login.blade.php ENDPATH**/ ?>