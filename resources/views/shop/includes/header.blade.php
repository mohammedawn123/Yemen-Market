
<script type="text/javascript" src="{{asset('/catalog/view/javascript/jquery/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>

<link href="{{url('/')}}/catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="{{url('/')}}/catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>

<link href="{{url('/')}}/catalog/view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<link type="text/css" href="{{url('/')}}/catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet" media="screen">
<link type="text/css" href="{{url('/')}}/catalog/view/javascript/jquery/swiper/css/swiper.min.css" rel="stylesheet" media="screen">
<link type="text/css" href="{{url('/')}}/catalog/view/javascript/jquery/swiper/css/opencart.css" rel="stylesheet" media="screen">
<script src="{{url('/')}}/catalog/view/javascript/jquery/swiper/js/swiper.jquery.js" type="text/javascript"></script>
<script src="{{url('/')}}/catalog/view/javascript/common.js" type="text/javascript"></script>
@stack('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.5.2/css/OverlayScrollbars.min.css" rel="stylesheet"/>


<style type="text/css" class="init">

    #top{
        position: fixed;
        right: 0px;
        left: 0px;
        z-index: 1000;
        background-color: rgb(21, 21, 21);
        background-image: linear-gradient(to bottom, rgb(22, 28, 30), rgb(18, 11, 8));
        background-repeat: repeat-x;
        border-color: rgb(18, 11, 8) rgb(18, 11, 8) rgb(7, 5, 7);
        min-height: 40px;

    }

    #top-links a {
        color: rgb(255, 255, 255);

    }

    .nav .open > a, .nav .open > a:focus,.nav .open > a:hover {
        background-color: rgb(21, 21, 21) ;
       color: rgb(255, 255, 255);
    }

    #top-links  .dropdown-menu {

         background-color:rgb(21, 21, 21) ;
    }

    header {
        padding-top: 20px;

    }
    #menu {
        background-color: rgb(21, 21, 21);
        background-image: linear-gradient(to bottom, rgb(22, 28, 30), rgb(18, 11, 8));
        background-repeat: repeat-x;
        border-color: rgb(18, 11, 8) rgb(18, 11, 8) rgb(7, 5, 7);
        min-height: 40px;
    }

    #menu  .dropdown-inner  a {

        color: rgb(255, 255, 255);

    }
     .dropdown-menu {

        background-color: rgb(21, 21, 21);
    }
    #menu .btn-navbar {
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        background-color: rgb(54, 54, 54);
        background-image: linear-gradient(to bottom, rgb(68, 68, 68), rgb(34, 34, 34));
        background-repeat: repeat-x;
        border-color: rgb(34, 34, 34) rgb(34, 34, 34) rgb(0, 0, 0);
    }
   ul  .open   a {font-weight: bold;}
   ul  .open  .dropdown-menu  li:hover {  background-color:rgb(35, 161, 209);}

</style>
