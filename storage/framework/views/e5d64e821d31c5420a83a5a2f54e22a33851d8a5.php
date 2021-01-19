<!DOCTYPE html>
<html dir="<?php echo e(trans('product.direction')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>YemenMarket</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    <?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>
<body >
<div id="container">


<div id="content" style=" padding-top:110px; margin-bottom:0px;">

    <?php echo $__env->yieldContent('content'); ?>

</div>


</div>

<?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




</body>
</html>
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/layouts/admin/auth/index.blade.php ENDPATH**/ ?>