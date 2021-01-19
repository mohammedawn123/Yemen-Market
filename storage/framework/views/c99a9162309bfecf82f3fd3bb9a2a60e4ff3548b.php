 <?php $__env->startSection('content'); ?>



  <div class="container-fluid">

      <div class="panel panel-default">


      <div class="panel-body">


<div class="well">
          <div class="row">
              <div class="col-sm-4">
             <div class="form-group" >
                <label class="control-label" for="global_filter"> <?php echo e(trans('role.label_search')); ?></label>
               <input type="text" name="global_filter"  placeholder="<?php echo e(trans('role.entry_search')); ?>"  class="global_filter form-control" id="global_filter" />

            </div>


             <div class="form-group"  data-column="1">
                <label class="control-label" for="input-name"> <?php echo e(trans('role.label_name')); ?> </label>
               <input type="text" name="filter_name"  placeholder="<?php echo e(trans('role.entry_name')); ?> "  class="column_filter form-control" id="col1_filter" />
             </div>


            </div>



           <div class="col-sm-4">
               <div class="form-group" data-column="2">
                   <label class="control-label" for="input-slug">  <?php echo e(trans('role.label_slug')); ?>  </label>
                   <input type="text" name="filter_slug"   placeholder=" <?php echo e(trans('role.entry_slug')); ?> "   class="column_filter form-control" id="col2_filter" />
               </div>
                <div class="form-group" data-column="3">
                <label class="control-label" for="input-name"> <?php echo e(trans('role.label_permissions')); ?> </label>
                <input type="text" name="filter_permission"   placeholder="<?php echo e(trans('role.entry_permissions')); ?> "   class="column_filter form-control" id="col3_filter"/>
            </div>



            </div>


              <div class="form-group" data-column="4">
                  <label class="col-sm-3 control-label" for="input-created_at"><?php echo e(trans('role.label_created_at')); ?> </label>
                  <div class="col-sm-3">
                      <div class="input-group date" data-column="4">
                          <input type="text" name="filter_created_at"   placeholder="yyyy-mm-dd" data-date-format="YYYY-MM-DD" id="col4_filter" class="column_filter form-control">
                          <span class="input-group-btn">
                    <button id="da" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span></div>
                  </div>
              </div>



              <div class="form-group" data-column="4">
                  <label class="col-sm-3 control-label" for="input-created_at"><?php echo e(trans('role.label_updated_at')); ?></label>
                  <div class="col-sm-3">
                      <div class="input-group date" data-column="5">
                          <input type="text" name="filter_updated_at"   placeholder="yyyy-mm-dd"" data-date-format="YYYY-MM-DD" id="col5_filter" class="column_filter form-control">
                          <span class="input-group-btn">
                    <button id="da" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span></div>
                  </div>

              </div>




          </div>
        </div>

            <section id="pjax-container" class="table-list">

          <div class="table-responsive">

            <table class="table table-bordered table-hover display"  style="width:1040px;" id="roles_datatable">
              <thead>
                <tr>
                     <td   class="text-center" style="width:1px;">  
                         <button type="button" class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button>

                     </td>
                    <td class="text-left "><?php echo e(trans('role.column_name')); ?></td>
                     <td class="text-left "><?php echo e(trans('role.column_slug')); ?></td>
                     <td class="text-left" style="width:200px;"><?php echo e(trans('role.column_permissions')); ?></td>
                     <td class="text-center"><?php echo e(trans('role.column_created_at')); ?> </td>
                     <td class="text-center"><?php echo e(trans('role.column_updated_at')); ?></td>
                     <td class="text-center"><?php echo e(trans('role.column_action')); ?></td>
                </tr>
              </thead>
                <tbody>
                <?php if(isset($roles)): ?>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="grid-row-checkbox"   data-id=<?php echo e($row['id']); ?>>

                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['slug']; ?></td>
                        <td>
                            <?php $__currentLoopData = $row->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span style="font-weight: 700;font-size: 75%;" class="badge badge-info"><?php echo e($permission->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td class="text-center"><?php echo $row['created_at']; ?></td>
                        <td class="text-center"><?php echo $row['updated_at']; ?></td>
                        <td class="text-center">
                           <div style="<?php echo e($row['slug'] === 'view.all' || $row['slug'] === 'administrator' ? 'display:none;' :''); ?> ">
                            <a href="roles/edit/<?php echo e($row['id']); ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                            <span onclick="deleteItem( <?php echo e($row['id']); ?> );"  title="admin.delete" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                           </div>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tbody>

            </table>
          </div>
            </section>

    </div>
  </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('roles_scripts'); ?>
    <script src="<?php echo e(url('/')); ?>/view/javascript/jquery.pjax.js" type="text/javascript"></script>
    <script type="text/javascript">


       $('.grid-refresh').click(function(){
            $.pjax.reload({container:'#pjax-container' });
        });
        /*   $('.refresh').click(function(){

        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5058
        });

        Toast.fire({
        type: 'success',
        title: 'Create new item success!',

        })
        $.pjax.reload({container:'#pjax-container'});
        });*/

        /*$(document).on('submit', function(event) {
        $.pjax.submit(event, '#pjax-container')
        })*/

        $(document).on('pjax:send', function() {
            $('#loading').show()


        })
        $(document).on('pjax:complete', function() {
            $('#loading').hide()
        })

        $(document).ready(function(){
            // does current browser support PJAX
            if ($.support.pjax) {
                $.pjax.defaults.timeout = 5000; // time in milliseconds
            }
        });

            $('.table-list input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });



    </script>

    <script type="text/javascript">

        $(document).ready( function () {

            $('#roles_datatable').DataTable({

                columns: [

                    {  name: 'id' , orderable: false , searchable: false},
                    { name: 'name' },
                    {  name: 'slug' },
                    {  name: 'Permission'  },
                    {name: 'created_at' } ,
                    { name: 'updated_at' } ,
                    {  name: 'Action' , orderable: false , searchable: false}
                ]
            });

            $('input.global_filter').on( 'keyup click', function () {
                filterGlobal();
            } );

            $('input.column_filter').on( 'keyup click ', function () {

                filterColumn( $(this).parents('div').attr('data-column') );
            } );

        });

        function filterGlobal () {
            $('#roles_datatable').DataTable().search(
                $('#global_filter').val()
            ).draw();
        }

        function filterColumn ( i ) {
            $('#roles_datatable').DataTable().column( i ).search(
                $('#col'+i+'_filter').val()

            ).draw();

        }

        /////////////////////// start icheck /////////////////////////////////////
        $(function () {
            //Enable check and uncheck all functionality
            $(".grid-select-all").click(function () {

                var clicks = $(this).data('clicks');
                if (clicks) {
                    //Uncheck all checkboxes
                    $("input[type='checkbox']").iCheck("uncheck");
                    $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                    //Check all checkboxes
                    $("input[type='checkbox']").iCheck("check");
                    $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
            });

        });
        function selectedRows()
        {
            var selected = [];
            $('.grid-row-checkbox:checked').each(function(){
                selected.push($(this).data('id'));
            });

            return selected;
        }
        // button delete all selected roles
        $('.grid-trash').on('click', function() {
            var ids = selectedRows().join();
            deleteItem(ids);
        });

        function deleteItem(ids)
        {

            Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,

            }).fire({
                title: 'Are you sure to delete this item?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,

                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            method: 'post',
                            url: "<?php echo e(url('admin/roles/delete')); ?>",
                            data: {ids:ids ,
                                _token: '<?php echo e(csrf_token()); ?>',
                            },
                            success: function (data) {
                                if(data.error == 1){
                                    alertMsg('Warning', data.msg, 'error');
                                    $.pjax.reload('#pjax-container');
                                    return;
                                }else{
                                    $.pjax.reload({container:'#pjax-container' });
                                    resolve(data);

                                }

                            }
                        });
                    });
                }

            }).then((result) => {
                if (result.value) {
                    alertMsg('Deleted!', 'Item has been deleted.', 'success');
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons.fire(
                    //   'Cancelled',
                    //   'Your imaginary file is safe :)',
                    //   'error'
                    // )
                }
            })
        } // end deleteitem function
        function alertMsg(title, msg, type) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            });
            swalWithBootstrapButtons.fire(
                title,
                msg,
                type
            )
        }
        /*  function alertConfirm(type,msg) {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5043
              });
              Toast.fire({
                  type: type,
                  title: msg
              })
          }*/



    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/roles_list.blade.php ENDPATH**/ ?>