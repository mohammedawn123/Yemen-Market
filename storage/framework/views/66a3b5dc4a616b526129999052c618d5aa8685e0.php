  <?php $__env->startSection('content'); ?>
<br>
<br>
<br>
<br>
      <div class="row" style="margin-bottom: 250px">
          <div class="col-md-12">
              <div class="box-body">
                  <div class="error-page text-center">
                      <h3 class="text-red">403</h3>

                      <h4 class="text-red">Permission denied!</h4>
                      <?php if($url): ?>
                        <strong> <span><i class="fa fa-warning text-red" aria-hidden="true"></i> You can not access to url <code><?php echo e($url); ?></code> </span></strong>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>

    <?php $__env->stopSection(); ?>

<?php if($url): ?>
    <script>
        window.history.pushState("", "", '<?php echo e($url); ?>');
    </script>
<?php endif; ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/deny.blade.php ENDPATH**/ ?>