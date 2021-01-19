
<nav id="top" >
    <div class="container">
        <div class="pull-left">
            <form action="" method="post" enctype="multipart/form-data" id="form-currency">
                <div class="btn-group">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <strong>$</strong>
                        <span class="hidden-xs hidden-sm hidden-md">Currency</span>&nbsp;<i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro</button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button>
                        </li>
                        <li>
                            <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US Dollar</button>
                        </li>
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
                        <li><a href="">Register</a></li>
                        <li><a href="">Login</a></li>
                    </ul>
                </li>
                <li><a href="" id="wishlist-total" title="Wish List (0)"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md">Wish List (0)</span></a></li>
                <li><a href="" title="Shopping Cart"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span></a></li>
                <li><a href="" title="Checkout"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Checkout</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>


<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo"> <h1><a href="">Your Store</a></h1>
                </div>
            </div>
            <div class="col-sm-5"><div id="search" class="input-group">
                    <input type="text" name="search" value="" placeholder="Search" class="form-control input-lg">
                    <span class="input-group-btn">
<button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
</span>
                </div></div>
            <div class="col-sm-3"><div id="cart" class="btn-group btn-block">
                    <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total">0 item(s) - $0.00</span></button>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <p class="text-center">Your shopping cart is empty!</p>
                        </li>
                    </ul>
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
