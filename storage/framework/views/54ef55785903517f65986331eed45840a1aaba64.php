 <?php $__env->startSection('content'); ?>

  <!-- Main content -->


  <div class="cart-qty">
      </div>
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
            <table class="table table-bordered table-hover display"  id="languages_datatable">
              <thead>
                <tr>
                     <td   class="text-left" style="width:1px;">
                         <button type="button"   class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button>

                     </td>
                    <td  class="text-center"><?php echo e(trans('language.column_flag')); ?></td>
                     <td  class="text-center"><?php echo e(trans('language.column_name')); ?></td>
                     <td  class="text-center"><?php echo e(trans('language.column_code')); ?></td>
                     <td  class="text-center"><?php echo e(trans('language.column_status')); ?></td>
                     <td  class="text-center"><?php echo e(trans('language.column_directory')); ?> </td>
                     <td  class="text-center"><?php echo e(trans('language.column_sort')); ?> </td>
                     <td><?php echo e(trans('language.column_action')); ?></td>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($languages)): ?>
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td style="width: 1px; padding: 0px;" class="text-center">
                               <input type="checkbox" class="grid-row-checkbox"   data-id=<?php echo e($row['language_id']); ?>>


                          </td>
                          <td  class="text-center">    <img src="<?php echo e(asset('/view/image/' . $row['image'] )); ?>" alt="" title="" data-placeholder="<?php //echo $placeholder; ?>" /></td>


                          <td   class="text-center">
                              <?php echo $row['name']; ?>


                          </td>


                          <td  class="text-center"><?php echo e($row['code']); ?></td>
                          <td   class="text-center">
                          <?php if($row['status']=== 1): ?>
                                  <span style="font-weight: 700;font-size: 80%;" class="badge badge-info">  <?php echo e("Enabled"); ?></span>
                              <?php else: ?>
                                  <span style="font-weight: 700;font-size: 80%;" class="badge badge-danger">  <?php echo e("disabled"); ?> </span>
                              <?php endif; ?>
                          </td>
                          <td   class="text-center">
                              <?php  if(  $row['direction']==="ltr") { ?>
                              <?php echo e('Left_to_Right'); ?>

                              <?php } else { ?>
                              <?php echo e('Right_to_Left'); ?>

                              <?php } ?>
                          </td>
                          <td  class="text-center"><?php echo e($row['sort']); ?></td>
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

  <?php $__env->startPush('languages_scripts'); ?>
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

          // tag a
          $(function(){
              $(document).pjax('a.page-link', '#pjax-container')
          })


          $(document).ready(function(){
              // does current browser support PJAX
              if ($.support.pjax) {
                  $.pjax.defaults.timeout = 5000; // time in milliseconds
              }
          });



          $(document).on('ready pjax:end', function(event) {
              $('.table-list input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%' /* optional */
              });
          })


      </script>
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
 $('#languages_datatable').DataTable({

              columns: [

                  { name: 'language_id' , orderable: false , searchable: false},
                  { name: 'image' , orderable: false , searchable: false},
                  {name: 'name' },
                  { name: 'code'  },
                  { name: 'status'  },
                  { name: 'direction' } ,
                  { name: 'sort' } ,
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
                          url: "<?php echo e(url('admin/languages/delete')); ?>",
                          data: {ids:ids ,
                              _token: '<?php echo e(csrf_token()); ?>',
                          },
                          success: function (data) {
                              if(data.error == 1){
                                  alertMsg('Warning', data.msg, 'error');
                                //  $.pjax.reload('#pjax-container');

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
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/languages_list.blade.php ENDPATH**/ ?>