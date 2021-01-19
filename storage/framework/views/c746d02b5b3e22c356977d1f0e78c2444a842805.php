 <?php $__env->startSection('content'); ?>
     <?php $__env->startPush('title'); ?>
         <title><?php echo e($title); ?></title>
     <?php $__env->stopPush(); ?>


  <div class="container-fluid">
      <div class="panel panel-default">


      <div class="panel-body">
          <div class="table-responsive" style="margin-bottom: 15px;padding-bottom: 5px; border-bottom: 1px solid #e9e9e9;">
              <div class="box-header1 with-border">
                  <div class="pull-right">
                      <?php if(!empty($topMenuRight) && count($topMenuRight)): ?>
                          <?php $__currentLoopData = $topMenuRight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="menu-right">
                                  <?php echo trim($item); ?>

                              </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                  </div>
              </div>
              <div class="box-header1 with-border">

                  <div class="pull-left">
                      <?php if(!empty($optionRows)): ?>
                  <div id="buttons"  >

                      <div class="btn-group">

                          <button type="button"   class="btn btn-default grid-select-all" data-toggle="tooltip"  data-original-title="<?php echo e(trans('list.button_select_all')); ?>"><i class="fa fa-square-o"></i></button>
                          <button style="margin:0 5px 0 5px;" type="button"  class="btn  btn-danger grid-trash" data-toggle="tooltip"  data-original-title="<?php echo e(trans('list.button_delete_all')); ?>">
                              <i class="fa fa-trash-o" ></i> </button>
                      </div>

                  </div>
                          <div id="optionRow"  >
                      <b>Show</b>
                      <div class="btn-group">
                          <form action="<?php echo e($urlSort); ?>" class="button_search">
                              <div   class="btn-group pull-right">
                          <select  onchange="$(this).submit();" class="form-control"  name="show_rows" id="show_rows">
                              <?php echo $optionRows ?? ''; ?>

                          </select>
                              </div>

                          </form>
                      </div>
                     <b>entries </b>
                  </div>
                  <?php endif; ?>
                      <?php if(!empty($buttonSort)): ?>
                          <div id="selectSort"   class="menu-left">

                              <div class="btn-group" style="float: left;">
                                  <select class="form-control" name="order_sort" id="order_sort">
                                      <?php echo $optionSort??''; ?>

                                  </select>
                              </div>
                              <div class="btn-group">
                                  <a style="    border-top-left-radius: 0;
    border-bottom-left-radius: 0;" class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="<?php echo e(trans('admin.sort')); ?>" id="button_sort">
                                      <i class="fa fa-sort-amount-asc"></i>
                                  </a>
                              </div>
                          </div>


                      <?php endif; ?>



                  </div>

              </div>
          </div>
              <div class="table-responsive">
              <section id="pjax-container" class="table-list">

            <table class="table table-bordered table-hover"  style="width: 100%;"   id="users_datatable">
              <thead>
              <tr>
                  <th  class="text-left" style="width:45px; background-color: #337ab7; color: #fff ;     border: 1px solid #ddd;">
                   
                  </th>
                    <?php $__currentLoopData = $listTh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th style="background-color: #337ab7;color: #fff;    border: 1px solid #ddd;"><?php echo $th; ?></th>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tr>
              </thead>
              <tbody>
              <?php $__currentLoopData = $dataTr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyRow => $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td style="width: 1px; padding: 3px;" class="text-center">
                          <input  type="checkbox" class="grid-row-checkbox"   data-id=<?php echo e($tr['id']); ?>>
                      </td>
                      <?php $__currentLoopData = $tr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trtd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                         <td style="<?php echo e($key === 'action' ? 'width: 170px;' : ''); ?> "><?php echo $trtd; ?></td>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



               </tbody>
            </table>

                  <div class="box-footer clearfix">
                      <?php echo $resultItems??''; ?>

                      <?php echo $pagination??''; ?>

                  </div>


              </section>

          </div>

      </div>


          
          <?php if(isset($page)): ?>   <?php echo $__env->make('admin.includes.pupupForms.'.$page, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>

      </div>

  </div>

 <?php $__env->stopSection(); ?>


  <?php $__env->startPush('scripts'); ?>
      <script src="<?php echo e(url('/')); ?>/view/javascript/jquery.pjax.js" type="text/javascript"></script>

      <script type="text/javascript">

          $('select[name="order_sort"]').on('change', function(e) {
              var url ="<?php echo e($urlSort.'?sort_order='); ?>"+$('#order_sort option:selected').val();
              $.pjax({url: url, container: '#pjax-container'})
          });
          $('#button_sort').click(function(event) {
              var url ='<?php echo e($urlSort??''); ?>?sort_order='+$('#order_sort option:selected').val();
              $.pjax({url: url, container: '#pjax-container'})
          });
          $(document).on('submit', '.button_search', function(event) {
              $.pjax.submit(event, '#pjax-container')
          })
         $('input[name="keyword"]').on('keyup click', function(e) {
             var url ="<?php echo e($urlSort.'?keyword='); ?>"+$(this).val();
              $.pjax({url: url, container: '#pjax-container'});
              $('#loading').hide();
          });
          $('select[name="status"]').on('change', function(e) {
              var url ="<?php echo e($urlSort.'?status='); ?>"+$(this).val();
              $.pjax({url: url, container: '#pjax-container'});

          });


      </script>

 <script type="text/javascript">

     $('.save').on('click', function() {
         $('#contact-form').submit();
     });

     $("#contact-form").on('submit',function (e) {
         e.preventDefault();
         $.ajax({
             data: $(this).serialize(),
             url:'<?php echo e($urlSave?? ''); ?>',
             type: "POST" ,
             dataType: 'json',
             success: function (data)
             {
                 hidePopup()
                 alertJs(data.type, data.msg);
                 $.pjax.reload({container:'#pjax-container' });
             } ,
             error: function (data)
             {
                 console.log('Error:', data);
             }

         });

     });
     $(".close").click(function () {
         hidePopup();
     });



     function deleteItem(ids)
      {

          Swal.mixin({
              customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger',
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
                          url: '<?php echo e($urlDeleteItem ?? ''); ?>',
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


<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/list.blade.php ENDPATH**/ ?>