  <?php $__env->startSection('content'); ?>
      <div id="content1">
      <div class="container-fluid">


          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo e('Language Form'); ?> </h3>
              </div>
              <div class="panel-body">
                  <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data" id="form-language" class="form-horizontal">

                      <?php echo e(csrf_field()); ?>

                      <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo 'General'; ?></a></li>
                          <li >

                              <a    id="files-tab1" href="#tab-option" data-toggle="tab"><?php echo 'Translation Files'; ?></a></li>

                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab-general">
                              <div class="form-group required">
                                  <label class="col-sm-2 control-label" for="input-name">Name</label>
                                  <div class="col-sm-10">
                                      <input type="text" name="name" value="<?php echo e(isset($name) ? $name : ''); ?>" placeholder="Name"   id="input-name" class="form-control" />
                                      <input type="hidden" name="language_id" value="<?php echo e(isset($language_id) ? $language_id : ''); ?>"  id="input-name" class="form-control" />
                                  </div>
                              </div>

                              <div class="form-group required">
                                  <label class="col-sm-2 control-label" for="input-code">Code</label>
                                  <div class="col-sm-10">
                                      <input type="text" name="code" value="<?php echo e(isset($code) ? $code : ''); ?>" placeholder="Code"   id="input-code" class="form-control" />
                                      </div>
                              </div>
                              <div class="form-group required">
                                  <label class="col-sm-2 control-label">Flag </label>
                                  <div class="col-sm-3">
                                      <a href="" id="thumb-image" data-toggle="image" >
                                          <img src="<?php echo e(isset($image) ? asset('/view/image/' . $image ) : asset('/view/image/no-image.jpg')); ?>" alt="" title="" data-placeholder="<?php //echo $placeholder; ?>" /></a>
                                      <input type="hidden" name="image" value="<?php echo isset($image ) ? $image : 'no-image.jpg' ;  ?>" id="input-image" />
                                  </div>
                              </div>


                              <div class="form-group required">
                                  <label class="col-sm-2 control-label">status</label>
                                  <div class="col-sm-10">
                                      <label class="radio-inline">
                                          <input type="radio" name="status" value="1" <?php echo e(old('status' ,$status ??'')==1 ? 'checked' : ''); ?> />
                                          <?php echo e('Enabled'); ?>

                                      </label>
                                      <label class="radio-inline">
                                          <input type="radio" name="status" value="0" <?php echo e(old('status' ,$status ??'')==0 ? 'checked' : ''); ?>/>
                                          <?php echo e('Disabled'); ?>


                                      </label>
                                  </div>
                              </div>

                              <div class="form-group required">
                                  <label class="col-sm-2 control-label">Direction</label>
                                  <div class="col-sm-10">
                                      <label class="radio-inline">
                                          <input type="radio" name="Directory" value="ltr" <?php echo e(old('Directory' ,$directory ??'')==='ltr' ? 'checked' : ''); ?> />
                                          <?php echo e('Left_to_Right'); ?>

                                      </label>
                                      <label class="radio-inline">
                                          <input type="radio" name="Directory" value="rtl" <?php echo e(old('Directory' ,$directory ??'')==='rtl' ? 'checked' : ''); ?>/>
                                          <?php echo e('Right_to_Left'); ?>


                                      </label>
                                  </div>
                              </div>


                              <div class="form-group required">
                                  <label class="col-sm-2 control-label" for="input-code">Sort Order</label>
                                  <div class="col-sm-10">
                                      <input type="text" name="sort" value="<?php echo e($sort ?? ''); ?>" placeholder="Sort Order"   id="input-code" class="form-control" />
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane" id="tab-option">
                  <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="list-group">
                              <div class="list-group-item">
                                  <h4 class="list-group-item-heading"><?php echo e('Stores'); ?></h4>
                              </div>
                              <div class="list-group-item">
                                  <select name="store_id" class="form-control">
                                      <option value="0"><?php echo e('default'); ?></option>
                                      <option value="1"><?php echo e('default12'); ?></option>

                                  </select>
                              </div>
                          </div>
                          <div class="list-group">
                              <div class="list-group-item">
                                  <h4 class="list-group-item-heading"><i class="fa fa-file-text"></i><?php echo e(' Files'); ?></h4>
                              </div>
                              <div id="path"></div>
                          </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-12">
                          <div id="alert"></div>
                           
                          <div id="code" style="display: none;">
                              <ul class="nav nav-tabs">
                              </ul>
                              <div class="tab-content"></div>
                          </div>
                      </div>
                  </div>
              </div>

              </div>
          </form>
          </div>

      </div>
      </div>
      </div>
      <?php $__env->startPush('lang_script'); ?>

          <!-- codemirror -->
          <script type="text/javascript" src="<?php echo e(url('/')); ?>/view/javascript/codemirror/lib/codemirror.js"></script>
          <script type="text/javascript" src="<?php echo e(url('/')); ?>/view/javascript/codemirror/lib/xml.js"></script>
          <script type="text/javascript" src="<?php echo e(url('/')); ?>/view/javascript/codemirror/lib/formatting.js"></script>


          <script type="text/javascript">
         $('select[name="store_id"]').on('change', function(e) {
              $.ajax({
                  url: "<?php echo e(url('admin/languages/path')); ?>"+ '/<?php echo e($code ?? 'templang'); ?>',
                  dataType: 'json',
                  beforeSend: function() {
                      $('select[name="store_id"]').prop('disabled', true);
                  },
                  complete: function() {
                      $('select[name="store_id"]').prop('disabled', false);
                  },
                  success: function(json) {
                      html = '';

                   /*   if (json['directory']) {
                          for (i = 0; i < json['directory'].length; i++) {
                              html += '<a href="' + json['directory'][i]['path'] + '" class="list-group-item directory">' + json['directory'][i]['name'] + ' <i class="fa fa-arrow-right fa-fw pull-right"></i></a>';
                          }
                      }*/

                      if (json['file']) {
                          for (i = 0; i < json['file'].length; i++) {
                              html += '<a href="' + json['file'][i]['path'] + '" class="list-group-item file">' + json['file'][i]['name'] + ' <i class="fa fa-arrow-right fa-fw pull-right"></i></a>';
                          }
                      }

                      $('#path').html(html);
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                  }
              });
          });

          $('select[name="store_id"]').trigger('change');

       /*   $('#path').on('click', 'a.directory', function(e) {
              console.log($(node).attr('href'));

              e.preventDefault();

              var node = this;

              $.ajax({
                  url: 'index.php?route=design/theme/path&user_token=<?php echo e('user_token'); ?>&store_id=' + $('select[name="store_id"]').val() + '&path=' + $(node).attr('href'),
                  dataType: 'json',
                  beforeSend: function() {
                      $(node).find('i').removeClass('fa-arrow-right');
                      $(node).find('i').addClass('fa-circle-o-notch fa-spin');
                  },
                  complete: function() {
                      $(node).find('i').removeClass('fa-circle-o-notch fa-spin');
                      $(node).find('i').addClass('fa-arrow-right');
                  },
                  success: function(json) {
                      html = '';

                      if (json['directory']) {
                          for (i = 0; i < json['directory'].length; i++) {
                              html += '<a href="' + json['directory'][i]['path'] + '" class="list-group-item directory">' + json['directory'][i]['name'] + ' <i class="fa fa-arrow-right fa-fw pull-right"></i></a>';
                          }
                      }

                      if (json['file']) {
                          for (i = 0; i < json['file'].length; i++) {
                              html += '<a href="' + json['file'][i]['path'] + '" class="list-group-item file">' + json['file'][i]['name'] + ' <i class="fa fa-arrow-right fa-fw pull-right"></i></a>';
                          }
                      }

                      if (json['back']) {
                          html += '<a href="' + json['back']['path'] + '" class="list-group-item directory">' + json['back']['name'] + ' <i class="fa fa-arrow-left fa-fw pull-right"></i></a>';
                      }

                      $('#path').html(html);
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                  }
              });
          });
*/
          $('#path').on('click', 'a.file', function(e) {
              e.preventDefault();

              var node = this;

              // Check if the file has an extension
              var pos = $(node).attr('href').lastIndexOf('.');

              if (pos != -1) {
                  var tab_id = $('select[name="store_id"]').val() + '-' + $(node).attr('href').slice(0, pos).replace(/\//g, '-').replace(/_/g, '-');
              } else {
                  var tab_id = $('select[name="store_id"]').val() + '-' + $(node).attr('href').replace(/\//g, '-').replace(/_/g, '-');
              }

              if (!$('#tab-' + tab_id).length) {
                  $.ajax({
                      url: "<?php echo e(url('admin/languages/getcontent')); ?>" +'/<?php echo e($code ?? 'templang'); ?>' + '/' +$(node).attr('href') ,
                      dataType: 'json',
                      beforeSend: function() {
                          $(node).find('i').removeClass('fa-arrow-right');
                          $(node).find('i').addClass('fa-circle-o-notch fa-spin');
                      },
                      complete: function() {
                          $(node).find('i').removeClass('fa-circle-o-notch fa-spin');
                          $(node).find('i').addClass('fa-arrow-right');
                      },
                      success: function(json) {
                          if (json['code']) {
                              $('#code').show();

                              $('#code .nav-tabs').append('<li><a href="#tab-' + tab_id + '" data-toggle="tab">' + $(node).attr('href') + '&nbsp;&nbsp;<i class="fa fa-minus-circle"></i></a></li>');

                              html  = '<div class="tab-pane" id="tab-' + tab_id + '">';
                              html += '  <textarea class="code" name="code1[' + $(node).attr('href') + ']"  rows="30" ></textarea>';
                              html += '  <input type="hidden" name="store_id" value="' + $('select[name="store_id"]').val() + '" />';
                              html += '  <input type="hidden" name="path" value="' + $(node).attr('href') + '" />';
                              html += '  <br />';
                              html += '  <div class="pull-right">';
                              html += '    <button type="button" data-toggle="tooltip" data-original-title="only Save this file (' + $(node).attr('href') + ') " data-loading-text="loading" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo e('Save this file'); ?></button>';
                              html += '  </div>';
                              html += '</div>';

                              $('#code .tab-content').append(html);

                              $('#code  .nav-tabs a[href=\'#tab-' + tab_id + '\']').tab('show');

                              // Initialize codemirrror
                              var codemirror = CodeMirror.fromTextArea(document.querySelector('#code .tab-content .active textarea'), {
                                  mode: 'text/html',
                                  height: '800px',
                                  direction:"ltr",
                                  lineNumbers: true,
                                  autofocus: true,
                                  theme: 'monokai'
                              });

                              codemirror.setValue(json['code']);
                          }
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                      }
                  });
              }
          });

          $('#code .nav-tabs').on('click', 'i.fa-minus-circle', function(e) {
              e.preventDefault();

              if ($(this).parent().parent().is('li.active')) {
                  index = $(this).parent().parent().index();

                  if (index == 0) {
                      $(this).parent().parent().parent().find('li').eq(index + 1).find('a').tab('show');
                  } else {
                      $(this).parent().parent().parent().find('li').eq(index - 1).find('a').tab('show');
                  }
              }

              $(this).parent().parent().remove();

              $($(this).parent().attr('href')).remove();

              if (!$('#code > ul > li').length) {
                  $('#code').hide();

              }
          });

          $('#code .tab-content').on('click', '.btn-primary', function(e) {
              var node = this;

              var editor = $('#code .tab-content .active .CodeMirror')[0].CodeMirror;

              $.ajax({
                  url: "<?php echo e(url('admin/languages/save')); ?>" +'/<?php echo e($code ?? 'templang'); ?>/'+$('#code .tab-content .active input[name="path"]').val(),
                  type: 'post',
                  data: 'code=' + encodeURIComponent(editor.getValue()),
                  dataType: 'json',
                  beforeSend: function() {
                      $(node).button('loading');
                  },
                  complete: function() {
                      $(node).button('reset');
                  },
                  success: function(json) {
                      $('.alert-dismissible').remove();

                      if (json['error']) {
                          $('#alert').prepend('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                      }

                      if (json['success']) {
                          $('#alert').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                      }

                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                  }
              });
          });


       </script>
      <?php $__env->stopPush(); ?>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/language_form.blade.php ENDPATH**/ ?>