<div id="normalModal" style="" class="modal fade" aria-hidden="false">
    <div class="modal-backdrop fade in" style="height: 677px;"></div>
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header" style="padding: 8px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Create Currency</h5>
            </div>
            <div class="modal-body">

                <form class="form-horizontal contact-form"  method="post" action="" id="contact-form" >
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="name"><?php echo e(trans('orderstatus.name')); ?></label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" name="statuses[name]"  placeholder="Name" id="name" class="form-control">
                            <input  type="hidden" name="id"   id="id" >
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-primary save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> <!-- /.modal -->
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">

        function showPopup(id){
            var popup=document.getElementById("normalModal");
            if(id != null) {
                $.ajax({
                    url: '<?php echo e($urlEdit?? ''); ?>',
                    type: "get",
                    dateType: "application/json; charset=utf-8",
                    data: {id: id},
                    success: function (data)
                    {
                        $("#id").val(data.id);
                        $("#name").val(data.name);

                        $(".modal-title").html(data.title);
                        popup.classList.toggle("in");
                        popup.style.setProperty("display", "block");

                    },
                    error: function (data)
                    {
                        console.log('Error:', data);
                    }

                });
            }else{
                $('#contact-form').trigger("reset");
                $("#id").val('');
                $(".modal-title").html('Create New');
                popup.classList.toggle("in");
                popup.style.setProperty("display", "block");
            }

        }



    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/includes/pupupForms/order_status_popup.blade.php ENDPATH**/ ?>