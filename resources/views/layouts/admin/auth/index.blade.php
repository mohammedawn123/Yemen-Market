<!DOCTYPE html>
<html dir="{{trans('product.direction')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>YemenMarket</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{url('/')}}/view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
     <link href="{{url('/')}}/view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link type="text/css" href="{{url('/')}}/view/stylesheet/stylesheet.css" rel="stylesheet" media="screen">

</head>
<body >
<div id="container">


<div id="content" style=" padding-top:110px; margin-bottom:0px;">

    @yield('content')

</div>


</div>

@include('admin.includes.footer')




</body>
</html>
