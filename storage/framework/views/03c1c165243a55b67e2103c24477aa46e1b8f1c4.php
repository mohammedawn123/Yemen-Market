<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YemenMarket</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700"  type="text/css" rel="stylesheet">

         <link href="<?php echo e(url('/')); ?>/application/bootstrap.css" rel="stylesheet" media="screen">
         <link type="text/css" href="<?php echo e(url('/')); ?>/application/stylesheet.css" rel="stylesheet" media="screen">


    </head>
    <body>


        <div id="cms-demo">
             <div class="container">
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="demonstration-box">
                            <a href="<?php echo e(url('/shop')); ?>" target="_blank" class="box-overlay">
                                <span>View Store Front</span>
                            </a>
                            <h2>Store Front</h2>
                            <img src="<?php echo e(url('/')); ?>/application/store-front.png" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="demonstration-box">
                            <a href="<?php echo e(route('admin.loginAdmin')); ?>" target="_blank" class="box-overlay">
<span class="hidden-xs">View Administration
    <br>
<br>Email: <i>user3@gmail.com</i>
<br>Password: <i>123456</i>
</span>
                                <span class="visible-xs-block">View Administration</span>
                            </a>
                            <h2>Administration</h2>
                            <img src="<?php echo e(url('/')); ?>/application/store-admin.png" class="img-responsive">
                            <p class="visible-xs-block">Email : user3@gmail.com &amp; Password: 123456</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/welcome.blade.php ENDPATH**/ ?>