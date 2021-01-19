

<?php
use App\Models\Language;
$lang1=Language::getList()->toArray() ;

?>
<header id="header" class="navbar navbar-static-top"  style="position: fixed;
         right: 0px; left: 0px; top:0px;">

    <div class="navbar-header">
        <a type="button" id="button-menu" class="pull-left"><i class="fa fa-dedent fa-lg"></i></a>

         <a href="#" id="navbar-brand1" class="navbar-brand">
            <img src="<?php echo e(url('view/image/logo.png')); ?>" alt="Yemen Market" title="Yemen Market"></a></div>
    <ul class="nav pull-right">

        <?php if(auth()->guard()->check()): ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img style="width: 35px;
height: 35px;"  class="img-thumbnail" src="<?php echo e(isset(Auth::user()->photo ) ?  asset( '/view/image/'.Auth::user()->photo )  :   asset('/view/image/user_photo4.png')); ?>"  alt="User Image">
                    <span><?php echo e(Auth::user()->name); ?></span>
                    <span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-menu-left">

                    <li><a href="<?php echo e(route('admin.users.edit' , ['id'=>Auth::user()->id])); ?>" target="_blank"><span class="glyphicon glyphicon-user"></span> My Account</a></li>

                </ul>
            </li>
        <?php endif; ?>
            
            <li>
                <a href="<?php echo e(route('admin.logout')); ?>" >
                    <span class="hidden-xs hidden-sm hidden-md"><?php echo e(trans('language.logout')); ?></span>
                    <i class="fa fa-sign-out fa-lg"></i>
                </a>

            </li>


  </ul>
    <ul class="nav navbar-nav">

        <li class="dropdown">
            <a   href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="parent"><?php echo e(session('name')); ?> <img src="<?php echo e(asset('/view/image/' .session('image'))); ?>"
              /> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php $__currentLoopData = $lang1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>
                        <a href="<?php echo e(url('admin/locale' , $language['code'])); ?>"  >
                            <img data-toggle="image"  src="<?php echo e(asset('/view/image/' .$language['image'])); ?>"
                                 title="<?php echo e($language['name']); ?>"/>
                            <?php echo e($language['name']); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    </ul>
  </header>
  <!-- Main Sidebar Container -->




<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/includes/navbar.blade.php ENDPATH**/ ?>