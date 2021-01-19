 <?php $__env->startSection('content'); ?>

  <!-- Main content -->



  <div class="container-fluid">

      <div class="panel panel-default">


      <div class="panel-body">



<div class="well">
          <div class="row">

             <div class="form-group" >
                <label class="control-label" for="global_filter"> <?php echo e(trans('user.label_search')); ?> </label>
               <input type="text" name="global_filter"  placeholder="<?php echo e(trans('user.label_search')); ?> "  class="global_filter form-control" id="global_filter" />

            </div>
                 <div class="col-sm-4">
             <div class="form-group"  data-column="0">
                <label class="control-label" for="input-id"> <?php echo e(trans('user.label_roles')); ?> </label>
               <input type="text" name="filter_id"  placeholder="<?php echo e(trans('user.entry_roles')); ?>"  class="column_filter form-control" id="col0_filter" />
             </div>
             <div class="form-group" data-column="3">
                <label class="control-label" for="input-sort"> <?php echo e(trans('user.label_permissions')); ?> </label>
                 <input type="text" name="filter_sort"   placeholder="<?php echo e(trans('user.entry_permissions')); ?> "   class="column_filter form-control" id="col3_filter" />
              </div>

            </div>



           <div class="col-sm-4">
                <div class="form-group" data-column="2">
                <label class="control-label" for="input-name"><?php echo e(trans('user.label_username')); ?> </label>
                <input type="text" name="filter_name"   placeholder="<?php echo e(trans('user.entry_username')); ?>"   class="column_filter form-control" id="col2_filter"/>
            </div>


              <div class="form-group" data-column="4">
                <label class="control-label" for="input-status">Admin_Status</label>
                <select name="filter_status" id="input-status" class="column_filter  form-control" >
                  <option value="" >All </option>
                  <?php //if ($filter_status) { ?>
                 <!-- <option value="1" selected="selected">enabled</option>-->
                  <?php //} else { ?>
                  <option value="Enabled" id="col4_filter">Enabled</option>
                  <?php //} ?>
                  <?php //if (!$filter_status && !is_null($filter_status)) { ?>
                <!--  <option value="0" selected="selected"><?php //echo $text_disabled; ?></option>-->
                  <?php //} else { ?>
                  <option value="Disabled" id="col4_filter">Disabled</option>
                  <?php //} ?>
                </select>
              </div>

            </div>

          </div>
        </div>

          <section id="pjax-container" class="table-list">

          <div class="table-responsive">
            <table class="table table-bordered table-hover display"  style="width:1040px;" id="users_datatable">
              <thead>
                <tr>
                     <td   class="text-left" style="width:1px;">
                         <button type="button"   class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button>

                     </td>
                     <td><?php echo e(trans('user.column_photo')); ?></td>
                     <td><?php echo e(trans('user.column_name_email')); ?></td>
                     <td  style="width:200px;"><?php echo e(trans('user.column_roles')); ?></td>
                     <td  style="width:200px;"><?php echo e(trans('user.column_permissions')); ?></td>
                     <td>Status</td>
                     <td><?php echo e(trans('user.column_created_at')); ?> </td>
                     <td><?php echo e(trans('user.column_updated_at')); ?> </td>
                     <td><?php echo e(trans('user.column_action')); ?></td>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($users)): ?>
                  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td style="width: 1px; padding: 0px;" class="text-center">
                               <input type="checkbox" class="grid-row-checkbox"   data-id=<?php echo e($row['id']); ?>>


                          </td>
                          <td style="width: 1px; padding: 0px;" class="text-center">
                              <?php echo $row['photo']; ?>


                          </td>
                           <td>
                              Name: <small style="font-weight: bolder;"><?php echo e($row['name']); ?></small><br>
                              Email: <small style="font-weight: bolder; color: blue; "><?php echo e($row['email']); ?></small> </td>



                          <td ><?php echo $row['roles']; ?></td>
                          <td  ><?php echo $row['permissions']; ?></td>
                          <td  ><?php echo $row['status']; ?></td>
                          <td style="width: 100px;" class="text-center"><small style="font-weight: bolder;  "><?php echo e($row['created_at']); ?></small></td>
                          <td style="width: 100px;" class="text-center"><small style="font-weight: bolder;  "><?php echo e($row['updated_at']); ?></small></td>
                          <td style="width: 100px;" class="text-center">
                              <?php echo $row['action']; ?>

                          </td>

                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              </tbody>
            </table>
          </div>

          </section> </div>
  </div>
  </div>
 <?php $__env->stopSection(); ?>
  <?php $__env->startPush('scripts'); ?>
      <script src="<?php echo e(url('/')); ?>/view/javascript/jquery.pjax.js" type="text/javascript"></script>

      <script type="text/javascript">

      function filterGlobal () {
          $('#users_datatable').DataTable().search(
              $('#global_filter').val()
          ).draw();
      }

      function filterColumn ( i ) {
          $('#users_datatable').DataTable().column( i ).search(
              i==4 ? $('select.column_filter').children("option:selected").val() :  $('#col'+i+'_filter').val()

          ).draw();

      }

      $(document).ready( function () {
 $('#users_datatable').DataTable({

              columns: [

                  { name: 'id' , orderable: false , searchable: false},
                  { name: 'photo' , orderable: false , searchable: false},
                  {name: 'email' },
                  { name: 'roles'  },
                  { name: 'permissions'  },
                  { name: 'created_at' } ,
                  { name: 'updated_at' } ,
                  {name: 'Action' , orderable: false , searchable: false}
              ]
          });

          $('input.global_filter').on( 'keyup click', function () {
              filterGlobal();
          } );

          $('input.column_filter').on( 'keyup click', function () {

              filterColumn( $(this).parents('div').attr('data-column') );
          } );
          $('select.column_filter').change(  function () {

              filterColumn( $(this).parents('div').attr('data-column') );
          } );


      });


////////////////////////////////////////////////////////////////


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
                          url: "<?php echo e(url('admin/users/delete')); ?>",
                          data: {ids:ids ,
                              _token: '<?php echo e(csrf_token()); ?>',
                          },
                          success: function (data) {
                              if(data.error == 1){
                                  alertJs('error', data.msg);

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
                  alertJs('success','Item has been deleted.');
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

  </script>
  <?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/users_list.blade.php ENDPATH**/ ?>