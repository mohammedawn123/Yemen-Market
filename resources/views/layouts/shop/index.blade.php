<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>YemenMarket</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('shop.includes.header')
<style type="text/css">
    .btn-primary , .btn-inverse , #menu,.search ,.dropdown-menu , .footer , #top , #menu .btn-navbar ,.product-thumb .button-group button {

        background-color: #5b5555;
        background-image: linear-gradient(to bottom, #683e3e, #bb1e1e);
        background-repeat: repeat-x;
        border-color: #222222 #222222 #000000;
        color: #ffffff;
    }
    .btn-primary:hover , .btn-inverse:hover{
        background-color: #414546;
        background-position: 0 -15px;
    }
    .btn-default:active
    {
        background-color: #5b5555;
        color: #ffffff;
    }
    .dropdown-menu li > a:hover , #menu .see-all:hover , #top #form-currency .currency-select:hover{
        text-decoration: none;
        color: #ffffff;
        background-color: #171616;
        background-image: linear-gradient(to bottom, #2d2828, #2f2c2c);
        background-repeat: repeat-x;
    }
.form-control{ border: 1px solid #fbb7b7 ;}
    .list-group a { color: #5F2226;  border: 1px solid #fbb7b7 ;}
    a.list-group-item:focus, a.list-group-item:hover, button.list-group-item:focus, button.list-group-item:hover {
        color: #555;
        text-decoration: none;
        background-color: #fdb9b9;
    }
    .form-control:focus , .product-thumb  {
        border-color: #f3aeb4;
        outline: 0;
         box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(208, 94, 158, 0.6);
    }
    .swiper-viewport{     box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(208, 94, 158, 0.6);}
    h1, h2, h3, h4, h5, h6 , legend{
        color: #860909;
    }
    .nav-tabs   {
        border-bottom: 1px solid #e09797;
    }
    .nav>li>a {
        color: #4c0505;
        font-weight: bold;
    }
     .nav-tabs>li.active>a , .nav-tabs>li.active>a:hover ,.nav-tabs>li.active>a:focus{
        border: 1px solid #e09797;
         border-bottom-color: transparent;
         background-color: #ffd9d9;
    }


    .nav-tabs>li>a:hover {
        border-color: #e09797 #e09797 #ddd;
    }
    .nav>li>a:focus, .nav>li>a:hover {
        text-decoration: none;
        background-color: #ffd9d9;
    }



    .marquee {
        width: 100%;
        overflow: hidden;
        border: 1px solid #ccc;
        background: #ea7575;
        color: white;
        font-weight: bold;
        font-size: 15px;
        text-align: center;

        position: fixed;
        z-index: 1000;
    }

    .ver {
        height: 30px;
        width: 200px;
    }
</style>
</head>
<body>
@include('shop.includes.navbar')
<div class="container">
    @include('shop.includes.message')

    @yield('content')

</div>
@include('shop.includes.footer')

{{-- sweetalert2 --}}
<script src="{{url('/')}}/view/javascript/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/view/javascript/promise-polyfill.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.5.2/js/jquery.overlayScrollbars.min.js"></script>
@stack('javaScripts')

<script type="text/javascript">
    $('.marquee').marquee();
    function addToCart(id,instance = null){
        $.ajax({
            url: "{{route('cart.add')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                "id": id,
                "instance":instance,
                _token: '{{ csrf_token() }}'

            },
            async: false,
            success: function(data){

                error = parseInt(data.error);
                if(error ==0)
                {
                    setTimeout(function () {
                        if(data.instance =='default'){
                            $('.y-cart').html(data.count_cart);
                            $('#cart-total').html(data.total);
                        }else{
                            $('.y-'+data.instance).html(data.count_cart);
                        }
                    }, 1000);
                    alertJs('success', data.msg);
                }else{
                    if(data.redirect){
                        window.location.replace(data.redirect);
                        return;
                    }
                    alertJs('error', data.msg);
                }

            }
        });
    }
</script>
<script type="text/javascript">
    $(function() {
        $("body").overlayScrollbars({ });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

        });
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

</script>

    <script type="text/javascript"><!--
        $('#slideshow0').swiper({
            mode: 'horizontal',
            slidesPerView: 1,
            pagination: '.slideshow0',
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 30,
            autoplay: 2500,
            autoplayDisableOnInteraction: true,
            loop: true
        });
        --></script>

    <script type="text/javascript"><!--
        $('#carousel0').swiper({
            mode: 'horizontal',
            slidesPerView: 5,
            pagination: '.carousel0',
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            autoplay: 2500,
            loop: true
        });
        --></script>


</body>
</html>

