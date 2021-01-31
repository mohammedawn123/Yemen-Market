
<div class="marquee" data-direction='right' data-duration='20000'  data-duplicated='true' data-pauseOnHover="true" >
    عزيزنا العميل ... من خلال إنشاء حساب ، ستتمكن من التسوق بشكل أسرع ، والبقاء على اطلاع دائم بحالة الطلب ، وتتبع الطلبات التي قدمتها مسبقاً
</div>


<nav id="top" style="margin-top: 20px;" >

    <div class="container">

        <div class="pull-left">
            <form action="" method="post" id="form-currency">
                <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <strong>$</strong>
                        <span  >Currency</span>&nbsp;<i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                        @if(isset($currencies))
                            @foreach($currencies as $currency)
                                <li>
                                    <button class="currency-select btn btn-link btn-block" type="button" name="{{$currency->code}}">{{$currency->symbol}} {{$currency->name}}</button>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <input type="hidden" name="code" value="">
                <input type="hidden" name="redirect" value="">
            </form>
        </div>
        <div id="top-links" class="nav pull-right">
            <ul class="list-inline">
                <li><a href=""><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md">123456789</span></li>
                <li class="dropdown"><a href="" title="My Account" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md">My Account</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">

                        @if (Route::has('shop.login'))

                            @auth
                                <li> <a href="{{route('customer.index')}}" > My Profile </a> </li>

                                <li>

                                    <a href="#" onclick="$('#logout-form').submit();">
                                        {{trans('language.logout')}}
                                    </a>

                                    <form action="{{route('shop.logout')}}" method="post" id="logout-form" style="display:none;">
                                        @csrf
                                    </form>
                                </li>


                            @else
                                <li><a href="{{ route('shop.loginForm') }}">Login</a> </li>
                                <li>  <a href="{{ route('register') }}">Register</a>  </li>
                            @endauth


                        @endif
                    </ul>
                </li>
                <li><a href="" id="wishlist-total" >
                        <i class="fa fa-heart"></i>
                        <span class="hidden-xs hidden-sm hidden-md">Wish List</span>
                        <span style="border-radius: 50%; padding: 3px;   border: 1px solid;" class="count y-wishlist" id="shopping-wishlist">{{ Cart::instance('wishlist')->count() ?? 0}}</span>
                    </a></li>
                <li><a href="" title="Shopping Cart">
                        <i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span>
                        <span style="border-radius: 50%; padding: 3px;   border: 1px solid;" class="count y-cart">{{ Cart::instance('default')->count() ?? 0}}</span>

                    </a></li>
                <li><a href="" title="Checkout"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Checkout</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>


<header style="padding-top: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo"> <img style="width:210px; margin-top: -10px;" src="https://i.pinimg.com/originals/97/68/c2/9768c2ad09dff1393213c66c29e8fde6.jpg" alt="Yemen Market" title="Yemen Market">
                </div>
            </div>
            <div class="col-sm-5" style="margin-top: 10px;"><div id="search" class="input-group">
                    <input type="text" name="search" value="" placeholder="Search" class="form-control input-lg" >
                    <span class="input-group-btn">
<button type="button" class="btn btn-default btn-lg search" ><i class="fa fa-search"></i></button>
</span>
                </div></div>
            <div class="col-sm-3" style="margin-top: 10px;">
                <div id="cart" class="btn-group btn-block">
                    <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
                        <i class="fa fa-shopping-cart"></i>
                        <span id="cart-total">{{ Cart::instance('default')->count() ?? 0}} item(s) - {{currency_symbol( Cart::instance('default')->total()) ?? '$0'}}</span>
                    </button>
                @php $cart= Cart::getListCart('default')  ;   @endphp
                @if($cart['items'] == []  )                   <ul class="dropdown-menu pull-right" style="color:black;">
                        <li>
                            <p class="text-center">Your shopping cart is empty!</p>
                        </li>
                    </ul>
                @else
                 <ul class="dropdown-menu pull-right" style="color:black;"><li>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($cart['items'] as $item)
                                    <tr>
                                        <td class="text-center">
                                            <a href="#">
                                                {!! $item['image']!!}
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a href="#">{{$item['name']}}</a>
                                        </td>
                                        <td class="text-right">x {{$item['qty']}}</td>
                                        <td class="text-right">  {{currency_symbol($item['price'])}}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="cart.remove('555714');" title="Remove" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </li>
                        <li>
                            <div>
                                <table class="table table-bordered">
                                    <tbody><tr>
                                        <td class="text-right"><strong>Sub-Total</strong></td>
                                        <td class="text-right">  {{$cart['subtotal']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                                        <td class="text-right">$6.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>VAT (20%)</strong></td>
                                        <td class="text-right">$220.20</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Total</strong></td>
                                        <td class="text-right"> {{$cart['total']}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="text-right"><a href="#"><strong><i class="fa fa-shopping-cart"></i> View Cart</strong></a>
                                    &nbsp;&nbsp;&nbsp;<a href="#"><strong><i class="fa fa-share"></i> Checkout</strong></a></p>
                            </div>
                        </li>

                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <nav id="menu" class="navbar">
        <div class="navbar-header"><span id="category" class="visible-xs">Categories</span>
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav">
                @if(isset($categories))
                    @foreach($categories as $category)

                        <li class="dropdown">
                            <a href="{{$category['href']}}" class="dropdown-toggle" data-toggle="dropdown">{{$category['name']}}</a>
                            @if($category['children'])
                                <div class="dropdown-menu" style="">
                                    <div class="dropdown-inner">
                                        @foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children)
                                            <ul class="list-unstyled">
                                                @foreach($children as $child)
                                                    <li><a href="{{$child['href']}}">{{ $child['name']}} </a></li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                    <a href="{{$category['href']}}" class="see-all">Show All {{$category['name']}}</a>
                                </div>
                            @endif
                        </li>

                    @endforeach
                @endif
                <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">Test</a>
                    <div class="dropdown-menu" style="margin-left: -210px;">
                        <div class="dropdown-inner"> <ul class="list-unstyled">
                                <li><a href="">test 11 (0)</a></li>
                                <li><a href="">test 12 (0)</a></li>
                                <li><a href="">test 15 (0)</a></li>
                                <li><a href="">test 16 (0)</a></li>
                                <li><a href="">test 17 (0)</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="">test 18 (0)</a></li>
                                <li><a href="">test 19 (0)</a></li>
                                <li><a href="">test 20 (0)</a></li>
                                <li><a href="">test 21 (0)</a></li>
                                <li><a href="">test 22 (0)</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="">test 23 (0)</a></li>
                                <li><a href="">test 24 (0)</a></li>
                                <li><a href="">test 4 (0)</a></li>
                                <li><a href="">test 5 (0)</a></li>
                                <li><a href="">test 6 (0)</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="">test 7 (0)</a></li>
                                <li><a href="">test 8 (0)</a></li>
                                <li><a href="">test 9 (0)</a></li>

                            </ul>

                        </div>
                        <a href="" class="see-all">Show All MP3 Players</a> </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
