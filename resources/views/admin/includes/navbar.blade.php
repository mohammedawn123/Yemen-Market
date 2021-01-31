

<?php
use App\Models\Language;
$lang1=Language::getList()->toArray() ;

?>
<header id="header" class="navbar navbar-static-top"  style="position: fixed;
         right: 0px; left: 0px; top:0px;">

    <div class="navbar-header">
        <a type="button" id="button-menu" class="pull-left"><i class="fa fa-dedent fa-lg"></i></a>

         <a href="#" id="navbar-brand1" class="navbar-brand">
            <img src="{{url('view/image/logo.png')}}" alt="Yemen Market" title="Yemen Market"></a></div>
    <ul class="nav pull-right">

        @auth
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img style="width: 35px;
height: 35px;"  class="img-thumbnail" src="{{ isset(Auth::user()->photo ) ?  asset( '/view/image/'.Auth::user()->photo )  :   asset('/view/image/user_photo4.png') }}"  alt="User Image">
                    <span>{{ Auth::user()->name }}</span>
                    <span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-menu-left">

                    <li><a href="{{route('admin.users.edit' , ['id'=>Auth::user()->id])}}" target="_blank"><span class="glyphicon glyphicon-user"></span> My Account</a></li>

                </ul>
            </li>
        @endauth
            {{--  <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                  <span class="label label-danger pull-left">1</span>
                  <i class="fa fa-bell fa-lg"></i>
              </a>
            <ul class="dropdown-menu dropdown-menu-right alerts-dropdown">
              <li class="dropdown-header">Orders</li>
              <li><a href="#" style="display: block; overflow: auto;"><span class="label label-warning pull-right">0</span>Pending</a></li>
              <li><a href="#"><span class="label label-success pull-right">0</span>Completed</a></li>
              <li><a href="#"><span class="label label-danger pull-right">0</span>Returns</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Customers</li>
              <li><a href="#"><span class="label label-success pull-right">0</span>Customers Online</a></li>
              <li><a href="#"><span class="label label-danger pull-right">0</span>Pending approval</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Products</li>
              <li><a href="#"><span class="label label-danger pull-right">1</span>Out of stock</a></li>
              <li><a href="#"><span class="label label-danger pull-right">0</span>Reviews</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Affiliates</li>
              <li><a href="#"><span class="label label-danger pull-right">0</span>Pending approval</a></li>
            </ul>
          </li>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-life-ring fa-lg"></i>
              </a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-header">Stores <i class="fa fa-shopping-cart"></i></li>
                      <li><a href="#" target="_blank">اسم متجرك</a></li>
                      <li class="divider"></li>
              <li class="dropdown-header">Help <i class="fa fa-life-ring"></i></li>
              <li><a href="#" target="_blank">Homepage</a></li>
              <li><a href="#" target="_blank">Documentation</a></li>
              <li><a href="#" target="_blank">Support Forum</a></li>
            </ul>
          </li>--}}
          {{--  <li>
                <form action="{{route('admin.logout')}}" method="post">
                    @csrf
                <a  href="#" onclick="this.parentNode.submit(); return false;" >
                    <span class="hidden-xs hidden-sm hidden-md">{{trans('language.logout')}}</span>
                    <i class="fa fa-sign-out fa-lg"></i>
                </a>
                </form>
            </li>--}}


  <li>
      <a href="#" onclick="$('#logout-form').submit();">
          <span class="hidden-xs hidden-sm hidden-md">{{trans('language.logout')}}</span>
            <i class="fa fa-sign-out fa-lg"></i>
        </a>

      <form action="{{route('admin.logout')}}" method="post" id="logout-form" style="display:none;">
      @csrf
      </form>
  </li>

  </ul>
    <ul class="nav navbar-nav">

        <li class="dropdown">
            <a   href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="parent">{{session('name')}} <img src="{{asset('/view/image/' .session('image'))}}"
              /> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach ($lang1 as $language)

                    <li>
                        <a href="{{url('admin/locale' , $language['code'])}}"  >
                            <img data-toggle="image"  src="{{asset('/view/image/' .$language['image'])}}"
                                 title="{{ $language['name']}}"/>
                            {{ $language['name']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
  </header>
  <!-- Main Sidebar Container -->




