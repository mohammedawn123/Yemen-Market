<?php $__env->startSection('content'); ?>
   <?php $__env->startPush('title'); ?>
         <title><?php echo e($title); ?></title>
     <?php $__env->stopPush(); ?>

   <div class="row">
      <div class="col-md-12">
          <div class="box-body">
            <div class="error-page text-center">
            	<br>
            	<br>
              <h1>Welcome to admin system!</h1>
            </div>
        </div>
      </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('styles'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/default.blade.php ENDPATH**/ ?>