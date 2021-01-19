<?php $__env->startSection('content'); ?>

    <div id="common-home" class="container">
        <div class="row">
            <div id="content" class="col-sm-12"><div class="swiper-viewport">
                    <div id="slideshow0" class="swiper-container swiper-container-horizontal">
                        <div class="swiper-wrapper" style="transform: translate3d(-3486px, 0px, 0px); transition-duration: 0ms;">
                            <div class="swiper-slide text-center swiper-slide-duplicate swiper-slide-next swiper-slide-duplicate-prev" data-swiper-slide-index="1" style="width: 1132px; margin-right: 30px;">
                                <img src="https://demo.opencart.com/image/cache/catalog/demo/banners/MacBookAir-1140x380.jpg" alt="MacBookAir" class="img-responsive">
                            </div> <div class="swiper-slide text-center swiper-slide-duplicate-active" data-swiper-slide-index="0" style="width: 1132px; margin-right: 30px;">
                                <a href="index.php?route=product/product&amp;path=57&amp;product_id=49">
                                    <img src="https://demo.opencart.com/image/cache/catalog/demo/banners/iPhone6-1140x380.jpg" alt="iPhone 6" class="img-responsive">
                                </a>
                            </div>
                            <div class="swiper-slide text-center swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="1" style="width: 1132px; margin-right: 30px;">
                                <img src="https://demo.opencart.com/image/cache/catalog/demo/banners/MacBookAir-1140x380.jpg" alt="MacBookAir" class="img-responsive">
                            </div>
                            <div class="swiper-slide text-center swiper-slide-duplicate swiper-slide-active" data-swiper-slide-index="0" style="width: 1132px; margin-right: 30px;">
                                <a href="index.php?route=product/product&amp;path=57&amp;product_id=49">
                                    <img src="https://demo.opencart.com/image/cache/catalog/demo/banners/iPhone6-1140x380.jpg" alt="iPhone 6" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-pagination slideshow0 swiper-pagination-clickable swiper-pagination-bullets">
                        <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                        <span class="swiper-pagination-bullet"></span>
                    </div>
                    <div class="swiper-pager">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <h3>Latest Products</h3>
                <div class="row">
                    <?php $__currentLoopData = $LatestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="product-thumb transition">
                            <div class="image">
                                <a href="#">
                                    <img src="<?php echo e(asset( '/view/image/'.$product->image)); ?>" alt="MacBook" title="MacBook" class="img-responsive">
                                </a>
                            </div>
                            <div class="caption">
                                <h4><a href="#"><?php echo e($product->name); ?></a></h4>
                                <p>
                                   <?php echo e(substr(strip_tags($product->description), 0, 108)); ?>....
                                </p>
                                <p class="price">
                                   <?php
                                       $price='';
                                           if($product->productSpecial() != -1)
               {
                  $price=' <span style="text-decoration: line-through;">'. currency_symbol($product->price, null).'</span>
                      &nbsp   <span class="text-danger">  '.  currency_symbol($product->productSpecial() , null) .'</span>';
                } else
                    {
                        $price = currency_symbol($product->price , null);
                    }
                                           echo $price ;
                                   ?>
                                    <span class="price-tax">Tax: <?php echo e($product->getTaxRate()); ?> %</span>
                                </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add('43');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('43');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('43');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-viewport">
                    <div id="carousel0" class="swiper-container swiper-container-horizontal">
                        <div class="swiper-wrapper" style="transform: translate3d(-2943.2px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="6" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/harley-130x100.png" alt="Harley Davidson" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="7" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/dell-130x100.png" alt="Dell" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="8" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/disney-130x100.png" alt="Disney" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="9" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/starbucks-130x100.png" alt="Starbucks" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="10" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/nintendo-130x100.png" alt="Nintendo" class="img-responsive"></div> <div class="swiper-slide text-center" data-swiper-slide-index="0" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/nfl-130x100.png" alt="NFL" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="1" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/redbull-130x100.png" alt="RedBull" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="2" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/sony-130x100.png" alt="Sony" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="3" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/cocacola-130x100.png" alt="Coca Cola" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="4" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/burgerking-130x100.png" alt="Burger King" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="5" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/canon-130x100.png" alt="Canon" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="6" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/harley-130x100.png" alt="Harley Davidson" class="img-responsive"></div>
                            <div class="swiper-slide text-center swiper-slide-prev" data-swiper-slide-index="7" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/dell-130x100.png" alt="Dell" class="img-responsive"></div>
                            <div class="swiper-slide text-center swiper-slide-active" data-swiper-slide-index="8" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/disney-130x100.png" alt="Disney" class="img-responsive"></div>
                            <div class="swiper-slide text-center swiper-slide-next" data-swiper-slide-index="9" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/starbucks-130x100.png" alt="Starbucks" class="img-responsive"></div>
                            <div class="swiper-slide text-center" data-swiper-slide-index="10" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/nintendo-130x100.png" alt="Nintendo" class="img-responsive"></div>
                            <div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/nfl-130x100.png" alt="NFL" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/redbull-130x100.png" alt="RedBull" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="2" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/sony-130x100.png" alt="Sony" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/cocacola-130x100.png" alt="Coca Cola" class="img-responsive"></div><div class="swiper-slide text-center swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 226.4px;"><img src="https://demo.opencart.com/image/cache/catalog/demo/manufacturer/burgerking-130x100.png" alt="Burger King" class="img-responsive"></div></div>
                    </div>
                    <div class="swiper-pagination carousel0 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
                    <div class="swiper-pager">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/home.blade.php ENDPATH**/ ?>