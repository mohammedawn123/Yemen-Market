
<?php if(Session('breadcrumbs')): ?>
        <nav id="breadcrumb">
            <ul class="breadcrumb" style="background-color: #fff; border: 0px;">
                    <?php $__currentLoopData = Session('breadcrumbs')['breadcrumbs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumbs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route($breadcrumbs['href'])); ?>">  <?php echo $breadcrumbs['text']; ?> </a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
        </nav>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/includes/breadcrumb.blade.php ENDPATH**/ ?>