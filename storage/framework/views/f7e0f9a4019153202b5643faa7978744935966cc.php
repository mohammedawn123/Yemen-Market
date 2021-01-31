<!DOCTYPE html>
<html lang="<?php echo e(trans('product.code')); ?>" dir="<?php echo e(trans('product.direction')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php echo $__env->yieldPushContent('title'); ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>
<body   >
<div id="container" style="background-color: #f6f6f6;">
    <?php echo $__env->make('admin.includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.includes.SidebarMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="content" style="min-height: 570px; overflow: hidden;" >

    <?php echo $__env->make('admin.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

</div>

    <div id="loading">
        <div id="overlay" class="overlay"><i class="fa fa-spinner fa-pulse fa-5x fa-fw "></i></div>
    </div>
    <?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>








<script type="text/javascript" src="<?php echo e(asset('/view/javascript/jquery/jquery-2.1.1.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(url('/')); ?>/view/javascript/bootstrap/js/bootstrap.js"></script>

<script type="text/javascript" src="<?php echo e(url('/')); ?>/view/javascript/summernote/summernote.js"></script>

<script src="<?php echo e(url('/')); ?>/view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/view/javascript/common.js" type="text/javascript"></script>


<script src="<?php echo e(url('/')); ?>/view/javascript/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/view/javascript/promise-polyfill.js" type="text/javascript"></script>

<!-- iCheck -->
<script src="<?php echo e(url('/')); ?>/view/javascript/iCheck/icheck.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.5.2/js/jquery.overlayScrollbars.min.js"></script>



<!-- datatable  -->
<script src="<?php echo e(url('/')); ?>/datatable/css/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(function() {
        //The passed argument has to be at least a empty object or a object with your desired options
        $("body").overlayScrollbars({ });
        $(".sidebar").overlayScrollbars({ });
        $(".box").overlayScrollbars({ });
    });
    function filterGlobal () {
        $('#laravel_datatable').DataTable().search(
            $('#global_filter').val()
        ).draw();
    }

    function filterColumn ( i ) {
        $('#laravel_datatable').DataTable().column( i ).search(
            i==4 ? $('select.column_filter').children("option:selected").val() :  $('#col'+i+'_filter').val()

        ).draw();

    }
    function delete_one_category(category_id) {

        window.location="categories/delete/" + category_id ;

    }
    $(document).ready( function () {





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
</script>


<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

        });

        /*$(document).ready(function () {*/
        $(".contact-icon").click(function () {
            $("#contact-popup").show();
        });




    });
</script>
<script type="text/javascript">

    $('.grid-refresh').click(function(){
        $.pjax.reload({container:'#pjax-container' });
    });

    $(document).on('pjax:send', function() {
        $('#loading').show()
    })

    $(document).on('pjax:complete', function() {
        $('#loading').hide()
    })

    $(document).ready(function(){
        // does current browser support PJAX
        if ($.support.pjax) {
            $.pjax.defaults.timeout = 2000; // time in milliseconds
        }
    });
    $(document).on('submit', '.button_search', function(event) {
        $.pjax.submit(event, '#pjax-container')
    })

     /*   $('.table-list input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /!* optional *!/
        });*/
    $(document).on('ready pjax:end', function(event) {
        $('.table-list input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    })



</script>

<script type="text/javascript">


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

    function alertJs(type = 'error', msg = '') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,

            timer: 4000
        });
        Toast.fire({
            type: type,
            title: msg
        })
    }

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
    function alertConfirm(type,msg) {
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
    }
    function hidePopup()
    {
        var popup=document.getElementById("normalModal");
        popup.classList.remove('modal', 'fade', 'in');
        popup.classList.toggle('modal');
        popup.classList.toggle('fade');
        popup.style.setProperty("display" , "none" );
    }

  </script>
<?php echo $__env->yieldPushContent('home_scripts'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>

<?php echo $__env->yieldPushContent('category_scripts'); ?>
<?php echo $__env->yieldPushContent('product_scripts'); ?>
<?php echo $__env->yieldPushContent('users_scripts'); ?>
<?php echo $__env->yieldPushContent('roles_scripts'); ?>
<?php echo $__env->yieldPushContent('permissions_scripts'); ?>
<?php echo $__env->yieldPushContent('permission_form_scripts'); ?>
<?php echo $__env->yieldPushContent('product_form_scripts'); ?>
<?php echo $__env->yieldPushContent('lang_script'); ?>
<?php echo $__env->yieldPushContent('languages_scripts'); ?>
<?php echo $__env->yieldPushContent('attribute_group_scripts'); ?>
<?php echo $__env->yieldPushContent('customer_group'); ?>
<?php echo $__env->yieldPushContent('order_scripts'); ?>

<script type="text/javascript">

    $('.date').datetimepicker({
        pickTime: false
      });


    $('.time').datetimepicker({
        pickDate: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });
 </script>

</body>
</html>

<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/layouts/admin/index.blade.php ENDPATH**/ ?>