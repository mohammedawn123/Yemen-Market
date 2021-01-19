
<div  style="padding: 0 15px 0 15px ;" id="cover">
<?php if(session('success')): ?>
    <div class="alert alert-success" id="alertsuccess"><i class="fa fa-check-circle"></i> <?php echo e(session('success')); ?>

        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>
<?php if (session('warning')) { ?>
<div   class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo session('warning'); ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php  } ?>
</div>
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/includes/message.blade.php ENDPATH**/ ?>