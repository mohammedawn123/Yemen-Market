<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title"><?php echo  $data['heading_title']; ?></h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-5">
        	<a href="<?php echo $data['parent'] ; ?>" data-toggle="tooltip" title="Parent" id="button-parent" class="btn btn-default"><i class="fa fa-level-up"></i></a>
        	<a href="<?php echo $data['refresh'] ; ?>" data-toggle="tooltip" title="Refresh" id="button-refresh" class="btn btn-default"><i class="fa fa-refresh"></i>
 <input type="hidden" name="dir" value="<?php echo $data['refresh'] ; ?>" id="input-dir" /></a>
          <button type="button" data-toggle="tooltip" title="<?php echo $data['button_upload']; ?>" id="button-upload" class="btn btn-primary"><i class="fa fa-upload"></i></button>
          <button type="button" data-toggle="tooltip" title="<?php echo  $data['button_folder'] ; ?>" id="button-folder" class="btn btn-default"><i class="fa fa-folder"></i></button>
          <button type="button" data-toggle="tooltip" title="<?php echo $data['button_delete']; ?>" id="button-delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
        </div>
        <div class="col-sm-7">
          <div class="input-group">
            <input type="text" name="search" value="<?php echo $data['filter_name'] ; ?>" placeholder="<?php echo $data['entry_search'] ; ?>" class="form-control">
            <span class="input-group-btn">
            <button type="button" data-toggle="tooltip" title="<?php echo $data['button_search']  ; ?>" id="button-search" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </span></div>
        </div>
      </div>
      <hr />
      <?php foreach (array_chunk($data['images'], 4 ) as $image) { ?>
       <div class="row">
       	 <?php foreach ($image as $image) { ?>
       	 <div class="col-sm-3 text-center">


 <?php if ($image['type'] == 'directory') { ?>
<div class="text-center">
<a href="<?php echo $image['src']; ?>" class="directory" style="vertical-align: middle;"><i class="fa fa-folder fa-5x"></i></a>
 <input type="hidden" name="directory" value="<?php echo $image['name']; ?>" id="input-imajge" />
</div>
          <label>
            <input type="checkbox" name="path[]" value="<?php echo $image['path']; ?>" />
            <?php echo $image['name']; ?></label>
 	<?php } ?>

       	 	 <?php if ($image['type'] == 'image') { ?>

   <a href="<?php echo $image['src'] ; ?>" class="thumbnail">
   	<img src="<?php echo $image['thumb'] ; ?>" alt="<?php echo $image['name'] ; ?>" title="<?php echo $image['name'] ; ?>" /></a>
          <label>
            <input type="checkbox" name="path[]" value="<?php echo $image['path'] ; ?>" />
            <?php echo $image['name'] ; ?></label>

<?php } ?>

</div>

     <?php } ?>
     </div>
<?php } ?>
    </div>
    <div class="modal-footer"><?php echo 'pagination'; ?></div>
  </div>
</div>
<script type="text/javascript">
	    $.ajaxSetup({
headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    });
$('a.thumbnail').on('click', function(e) {
	e.preventDefault();

	$('#thumb-image').find('img').attr('src', $(this).find('img').attr('src'));


	$('#input-image').attr('value', $(this).parent().find('input').attr('value'));


	$('#modal-image').modal('hide');
});

$('a.directory').on('click', function(e) {
	e.preventDefault();
	$('#modal-image').load($(this).attr('href'));

});

$('.pagination a').on('click', function(e) {
	e.preventDefault();

	$('#modal-image').load($(this).attr('href'));
});

$('#button-parent').on('click', function(e) {
	  e.preventDefault();
	   $('#modal-image').load($(this).attr('href'));

});

$('#button-refresh').on('click', function(e) {
	e.preventDefault();

	 $('#modal-image').load($(this).attr('href'));
});

$('#button-search').on('click', function() {

	var url = 'index.php?route=common/filemanager&token=<?php echo 'token'; ?>&directory=<?php echo  $data['directory']; ?>';
		alert(url);
	var filter_name = $('input[name=\'search\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	<?php if (isset($thumb)) { ?>
	url += '&thumb=' + '<?php echo $thumb; ?>';
	<?php } ?>

	<?php if (isset($target)) { ?>
	url += '&target=' + '<?php echo $target; ?>';
	<?php } ?>

	$('#modal-image').load(url);
});
 </script>
<script type="text/javascript">

$('#button-upload').on('click', function() {
	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;">  {{ csrf_field()}}<input type="file" name="file" value="" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');
	var str='<?php echo $data['dir']; ?>' ;

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
			 $.ajax({
				url: "{{url('admin/uploads/filemanager/upload_file')}}" + '/'+ str  ,
				type: 'post',
				dataType: 'json',
				data:   new FormData($('#form-upload')[0]) ,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$('#button-upload').prop('disabled', true);
				},
				complete: function() {
					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
					$('#button-upload').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}

					if (json['success']) {
						alert(json['success']);

						$('#button-refresh').trigger('click');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('#button-folder').popover({
	html: true,
	placement: 'bottom',
	trigger: 'click',
	title: '<?php echo 'entry_folder'; ?>',
	content: function() {
		html  = '<div class="input-group">';
		html += '  <input type="text" name="folder" value="" placeholder="<?php echo 'entry_folder'; ?>" class="form-control">';
		html += '  <span class="input-group-btn"><button type="button" title="<?php echo 'button_folder'; ?>" id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
		html += '</div>';

		return html;
	}
});

$('#button-folder').on('shown.bs.popover', function() {
	$('#button-create').on('click', function() {
		$.ajax({
			url: "{{url('admin/uploads/filemanager/folder')}}" ,
			type: 'post',
			dataType: 'json',
			data:{ folder:  encodeURIComponent($('input[name=\'folder\']').val()) , directory:'<?php echo $data['directory']; ?>' },
			beforeSend: function() {
				$('#button-create').prop('disabled', true);

			},
			complete: function() {
				$('#button-create').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}

				if (json['success']) {
					alert(json['success']);

					$('#button-refresh').trigger('click');
				}
			}	,
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}

		});
	});
});

$('#modal-image #button-delete').on('click', function(e) {
	if (confirm('<?php echo $data['text_confirm'] ; ?>')) {
		$.ajax({
			url:  "{{url('admin/uploads/filemanager/delete_folder')}}" ,
			type: 'post',
			dataType: 'json',
			data: $('input[name^=\'path\']:checked'),
			beforeSend: function() {
				$('#button-delete').prop('disabled', true);
			},
			complete: function() {
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					alert(json['error']);
				}

				if (json['success']) {
					alert(json['success']);

					$('#button-refresh').trigger('click');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
});
//--></script>
