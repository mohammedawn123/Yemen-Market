<?php $__env->startSection('content'); ?>

   
   <div class="row">


           <div  >
               <div id="fm"></div>
           </div>

   </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/file-manager/css/file-manager.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('home_scripts'); ?>
    <script src="<?php echo e(asset('vendor/file-manager/js/file-manager.js')); ?>"></script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/file_manager.blade.php ENDPATH**/ ?>