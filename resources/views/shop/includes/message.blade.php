
<div  style="padding: 0 15px 0 15px ;" id="cover">
@if(session('success'))
    <div class="alert alert-success" id="alertsuccess"><i class="fa fa-check-circle"></i> {{session('success')  }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif
<?php if (session('warning')) { ?>
<div   class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo session('warning'); ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php  } ?>
</div>
