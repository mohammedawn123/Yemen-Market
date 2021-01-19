 <?php $__env->startSection('content'); ?>

  <!-- Main content -->



  <div class="container-fluid">

      <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-list"> </i> <?php echo e(trans('permission.text_form')); ?></h3>
      </div>
      <div class="panel-body">


        <div class="row">


            <form action="<?php echo e($action); ?>" method="post"  class="form-horizontal" id="permission_form">
            <?php echo e(csrf_field()); ?>


               <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name">
                    &nbsp;  &nbsp;      <?php echo e(trans('permission.label_name')); ?> </label>
                <div class="col-sm-8">
                <div class="input-group">

                    <div class="input-group-btn">
                        <button  type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                            <span class="glyphicon glyphicon-user"></span>
                        </button>
                    </div>
                    <input type="text" name="name" value="<?php echo e(old('name',isset($permission->name)? $permission->name : '')); ?>"
                           placeholder="  <?php echo e(trans('permission.entry_name')); ?> "
                           id="input-name" class="form-control"/>
                    <input type="hidden" name="permission_id"
                           value="<?php echo e(isset($permission->id) ?  $permission->id  :''); ?>"/>

                </div>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">
                      <i class="fa fa-info-circle"></i>
                        <?php echo e($message); ?>

                      </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

            </div>
                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-slug">   &nbsp;  &nbsp;  <?php echo e(trans('permission.label_slug')); ?> </label>
                <div class="col-sm-8">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button  type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                            <span class="glyphicon glyphicon-screenshot"></span>
                        </button>
                    </div>
                    <input type="text"   name="slug" value="<?php echo e(old('slug', isset($permission->slug)  ?  $permission->slug :  '')); ?>"
                           placeholder=" <?php echo e(trans('permission.entry_slug')); ?>"
                           id="input-slug" class="form-control"/>

                </div>
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">
                      <i class="fa fa-info-circle"></i>
                        <?php echo e($message); ?>

                      </span>
                     <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


            </div>


                  <div class="form-group" >
                      <label class="col-sm-2 control-label" for="input-path">   &nbsp;  &nbsp; <?php echo e(trans('permission.label_http_path')); ?></label>
                      <div class="col-sm-8  routesAdmin">
                          <div class="input-group">

                              <div class="input-group-btn">
                              <button  type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                                  <span class="caret"></span>
                              </button>
                          </div>
                              <input type="text" name="path"
                                     placeholder="<?php echo e(trans('permission.entry_http_path')); ?>" id="input-path"
                                     class="form-control">

                          </div>
                          <div id="permission-path" class="well well-sm"
                               style="height: 150px; overflow: auto;">

                        <?php if(isset($routeAdmin)){

                               $old_http_uri = old('permission_paths',($permission)?explode(',', $permission->http_uri):[]);

                           foreach($routeAdmin as  $route)  {
                                if( in_array($route['uri'], $old_http_uri) ) { ?>
                                                  <div id="permission-path"><i class="fa fa-minus-circle" style="color:#d9534f;"></i>
                                                      <?php echo e(($route['name'])?$route['method'].'::'.$route['name']:$route['uri']); ?>

                                                      <input class="permission_paths" type="hidden" name="permission_paths[]" value="<?php echo e($route['uri']); ?>"  />
                                                  </div>
                                              <?php }   } }?>


                          </div>
                      </div>
                  </div>





        </form>
        </div>
    </div>
  </div>

  <?php $__env->startPush('permission_form_scripts'); ?>
  <script type="text/javascript">

      // permission
      $('input[name=\'path\']').autocomplete({
          'source': function (request, response) {
              var filter_name1 = $('input[name=\'path\']').val();
              $.ajax({
                  url: "<?php echo e(route('routeAdmin.autocomplete')); ?>",
                  type: "post",
                  dataType: 'json',
                  data: {filter_name: filter_name1 , old_http_uri:get_path()},
                  success: function (json) {
                      console.log(json)
                      response($.map(json, function (item) {

                          return {
                              label: item['uri'],
                              value: item['key'],
                              flag:item['flag']

                          }
                      }));

                  }
              });
          },
      'select': function (item) {
          $('input[name=\'path\']').val('');

          $('#permission-path' + item['value']).remove();

          $('#permission-path').append('<div id="permission-path' + item['value'] + '">' +
              '<i class="fa fa-minus-circle" style="color:#d9534f;"></i> ' + item['label'] + '<input class="permission_paths"  type="hidden" name="permission_paths[]" value="' + item['label'] + '" /></div>');
      }
      });
      $('#permission-path').delegate('.fa-minus-circle', 'click', function () {
          $(this).parent().remove();
      });
      function get_path()
      {
          var selected = [];
          $('.permission_paths').each(function(){
              selected.push($(this).val());
          });

          return selected;
      }


  </script>
  <?php $__env->stopPush(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/permission_form.blade.php ENDPATH**/ ?>