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
                        <label class="col-sm-3 control-label" for="name">Name</label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" name="currency[name]"  placeholder="Name" id="name" class="form-control">
                            <input  type="hidden" name="id"   id="id" >
                        </div>
                    </div>


                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="code">Code</label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" name="currency[code]"  placeholder="Code" id="code" class="form-control">
                        </div>
                    </div>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="symbol">symbol</label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" name="currency[symbol]"  placeholder="Symbol" id="symbol" class="form-control">
                        </div>
                    </div>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="exchange_rate">Exchange Rate</label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" name="currency[exchange_rate]"  placeholder="Exchange Rate" id="exchange_rate" class="form-control">
                        </div>
                    </div>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="decimals">
                                        <span  data-toggle="tooltip" title="the number of decimal points">
                                         Decimals
                                        </span>
                        </label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" value="0" name="currency[decimals]"  placeholder="Decimals" id="decimals" class="form-control">
                        </div>
                    </div>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="symbol_first">
                            Symbol First
                        </label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" value="0" name="currency[symbol_first]"  placeholder="Symbol First" id="symbol_first" class="form-control">
                        </div>
                    </div>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="thousands">
                            Thousands
                        </label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" value="." name="currency[thousands]"  placeholder="Thousands" id="thousands" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="status">Status</label>
                        <div class="col-sm-8">
                            <select style="height: 27px; font-size: 12px;" name="currency[status]" id="status" class="form-control">
                                <option value="1" ><?php echo e(trans('product.text_enabled')); ?>      </option>
                                <option value="0" ><?php echo e(trans('product.text_disabled')); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group required" style="margin-bottom: 5px;">
                        <label class="col-sm-3 control-label" for="sort">
                            Sort Order
                        </label>
                        <div class="col-sm-8">
                            <input style="height: 27px; font-size: 12px;" type="text" value="1" name="currency[sort]"  placeholder="Sort Order" id="sort" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary save">Save changes</button>
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
                    url:'<?php echo e($urlEdit?? ''); ?>',
                    type: "get",
                    dateType: "application/json; charset=utf-8",
                    data: {id: id},
                    success: function (data) {
                        $("#id").val(data.id);
                        $("#name").val(data.name);
                        $("#code").val(data.code);
                        $("#symbol").val(data.symbol);
                        $("#exchange_rate").val(data.exchange_rate);
                        $("#decimals").val(data.decimals);
                        $("#symbol_first").val(data.symbol_first);
                        $("#thousands").val(data.thousands);
                        $("#status").val(data.status);
                        $("#sort").val(data.sort);

                        $(".modal-title").html(data.title);
                        popup.classList.toggle("in");
                        popup.style.setProperty("display", "block");

                    },
                    error: function (data) {
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
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/includes/pupupForms/popup.blade.php ENDPATH**/ ?>