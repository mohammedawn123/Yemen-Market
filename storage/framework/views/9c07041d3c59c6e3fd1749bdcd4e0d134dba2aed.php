
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
                        <?php if(isset($currencies)): ?>
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <button class="currency-select btn btn-link btn-block" type="button" name="<?php echo e($currency->code); ?>"><?php echo e($currency->symbol); ?> <?php echo e($currency->name); ?></button>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
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

                        <?php if(Route::has('shop.login')): ?>

                            <?php if(auth()->guard()->check()): ?>
                                <li> <a href="<?php echo e(route('customer.index')); ?>" > My Profile </a> </li>

                                <li>

                                    <a href="#" onclick="$('#logout-form').submit();">
                                        <?php echo e(trans('language.logout')); ?>

                                    </a>

                                    <form action="<?php echo e(route('shop.logout')); ?>" method="post" id="logout-form" style="display:none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>


                            <?php else: ?>
                                <li><a href="<?php echo e(route('shop.loginForm')); ?>">Login</a> </li>
                                <li>  <a href="<?php echo e(route('register')); ?>">Register</a>  </li>
                            <?php endif; ?>


                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="" id="wishlist-total" >
                        <i class="fa fa-heart"></i>
                        <span class="hidden-xs hidden-sm hidden-md">Wish List</span>
                        <span style="border-radius: 50%; padding: 3px;   border: 1px solid;" class="count y-wishlist" id="shopping-wishlist"><?php echo e(Cart::instance('wishlist')->count() ?? 0); ?></span>
                    </a></li>
                <li><a href="<?php echo e(route('cart.list')); ?>" title="Shopping Cart">
                        <i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span>
                        <span style="border-radius: 50%; padding: 3px;   border: 1px solid;" class="count y-cart"><?php echo e(Cart::instance('default')->count() ?? 0); ?></span>

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

                    <button  type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
                        <i class="fa fa-shopping-cart"></i>
                        <span id="cart-total"><?php echo e(Cart::instance('default')->count() ?? 0); ?> item(s) - <?php echo e(currency_symbol( Cart::instance('default')->total()) ?? '$0'); ?></span>
                    </button>


                 <ul id="pjax-container" class="dropdown-menu pull-right" style="color:black;">
                     <?php $cart= Cart::getListCart('default')  ;   ?>
                     <?php if($cart['items'] == []  ): ?>
                              <li>
                                 <p class="text-center">Your shopping cart is empty!</p>
                             </li>

                     <?php else: ?>
                     <li>
                            <table class="table table-striped">
                                <tbody>
                                <?php $__currentLoopData = $cart['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="#">
                                                <?php echo $item['image']; ?>

                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a href="#"><?php echo e($item['name']); ?></a>
                                        </td>
                                        <td class="text-right">x <?php echo e($item['qty']); ?></td>
                                        <td class="text-right">  <?php echo e(currency_symbol($item['price'])); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('item.remove' , ['id'=> $item['id'] , 'instance'=>'default'])); ?>" data-toggle="tooltip" title="" class="btn btn-danger"   data-original-title="Remove"><i class="fa fa-times-circle"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </li>
                        <li>
                            <div>
                                <table class="table table-bordered">
                                    <tbody><tr>
                                        <td class="text-right"><strong>Sub-Total</strong></td>
                                        <td class="text-right">  <?php echo e($cart['subtotal']); ?></td>
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
                                        <td class="text-right"> <?php echo e($cart['total']); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="text-right">
                                    <a href="<?php echo e(route('cart.list')); ?>"><strong><i class="fa fa-shopping-cart"></i> View Cart</strong></a>
                                    &nbsp;&nbsp;&nbsp;<a href="#"><strong><i class="fa fa-share"></i> Checkout</strong></a></p>
                            </div>
                        </li>
                      <?php endif; ?>
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
                <?php if(isset($categories)): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li class="dropdown">
                            <a href="<?php echo e($category['href']); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo e($category['name']); ?></a>
                            <?php if($category['children']): ?>
                                <div class="dropdown-menu" style="">
                                    <div class="dropdown-inner">
                                        <?php $__currentLoopData = array_chunk($category['children'], ceil(count($category['children']) / $category['column'])); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <ul class="list-unstyled">
                                                <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e($child['href']); ?>"><?php echo e($child['name']); ?> </a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <a href="<?php echo e($category['href']); ?>" class="see-all">Show All <?php echo e($category['name']); ?></a>
                                </div>
                            <?php endif; ?>
                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/includes/navbar.blade.php ENDPATH**/ ?>