
<link href="<?php echo e(url('/')); ?>/view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo e(url('/')); ?>/view/javascript/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo e(url('/')); ?>/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen">

<?php if(trans('product.direction')=='rtl'): ?>
    <link href="<?php echo e(url('/')); ?>/view/javascript/bootstrap/css/bootstrap-a.css" rel="stylesheet" media="screen">
    <link type="text/css" href="<?php echo e(url('/')); ?>/view/stylesheet/stylesheet-a.css" rel="stylesheet" media="screen">
<!--    <link type="text/css" href="<?php echo e(url('/')); ?>/view/stylesheet/adminlte.min.css" rel="stylesheet" media="print">-->
<?php endif; ?>
<?php if(trans('product.direction')=='ltr'): ?>
    <link href="<?php echo e(url('/')); ?>/view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link type="text/css" href="<?php echo e(url('/')); ?>/view/stylesheet/stylesheet.css" rel="stylesheet" media="screen">
<!--    <link type="text/css" href="<?php echo e(url('/')); ?>/view/stylesheet/adminlte.min.css" rel="stylesheet" media="print">-->

<?php endif; ?>
<link type="text/css" href="<?php echo e(url('/')); ?>/view/javascript/iCheck/square/blue.css" rel="stylesheet" media="screen">

<!--codemirror-->
<link href="<?php echo e(url('/')); ?>/view/javascript/codemirror/lib/codemirror.css" rel="stylesheet" />
<!--<link href="<?php echo e(url('/')); ?>/view/javascript/codemirror/theme/monokai.css" rel="stylesheet" />-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.5.2/css/OverlayScrollbars.min.css" rel="stylesheet"/>

<!-- datatable  -->
<link  href="<?php echo e(url('/')); ?>/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
<?php echo $__env->yieldPushContent('styles'); ?>

<style type="text/css" class="init">
  table.dataTable thead .sorting {
    background-image: url("<?php echo e(url('/')); ?>/view/image/sort_both.png");
}
  .permission  .dropdown-menu  ,  .users  .dropdown-menu  , .routesAdmin .dropdown-menu {
       width: 96%;
      max-height: 170px;
      overflow: auto;
  }
  .lang-files > li.active > a, .lang-files > li.active > a:hover, .lang-files > li.active > a:focus {
      color: #337;
      background-color: #dddddd9e;
  }

  #loading {
      display: none;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 50;
      background: rgba(255,255,255,0.7);
  }
  .overlay {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      transform: -webkit-translate(-50%, -50%);
      transform: -moz-translate(-50%, -50%);
      transform: -ms-translate(-50%, -50%);
      color: rgb(31, 34, 43);
      z-index: 9999;
      background: rgba(255,255,255,0.7);
  }
/* order status*/

  .badge-info {
      color: #fff;
      background-color: #337ab7;
  }
  .badge-primary {
      color: #fff;
      background-color: #007bff;
  }
  .badge-warning {
      color: #fff;
      background-color: #ffc107;
  }
  .badge-danger {
      color: #fff;
      background-color: #dc3545;
  }
  .badge-success {
      color: #fff;
      background-color: #28a745;
  }
  .badge1 {
      height: 90px;
      margin-bottom: 20px;
      border-radius: .25rem;
      box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
  }
  .badge1 a{
      color: rgb(255, 255, 255) !important;
      background: rgba(0,0,0,.1);
      display: block; text-align: center;
      font-size: 14px;
      margin-top: 7px;
  }
</style>




<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/includes/header.blade.php ENDPATH**/ ?>