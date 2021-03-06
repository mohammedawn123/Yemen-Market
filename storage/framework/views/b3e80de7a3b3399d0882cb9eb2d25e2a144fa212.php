<?php $__env->startSection('content'); ?>

    <div id="common-home" class="container">
        <div class="row">
            <div id="content" class="col-sm-12"><div class="swiper-viewport">
                    <div id="slideshow0" class="swiper-container swiper-container-horizontal">
                        <div class="swiper-wrapper" style="transform: translate3d(-3486px, 0px, 0px); transition-duration: 0ms;">
                            <div class="swiper-slide text-center">
                                <a href="#">
                                    <img src="https://i.pinimg.com/originals/49/77/70/4977702d28a92b750c9c784bb2e6c1a4.jpg" alt="MacBookAir" class="img-responsive">
                                    sssssssssss
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#">
                                    <img src="https://i.pinimg.com/originals/af/53/b8/af53b8e0449b58e967f42bc0902b7269.jpg" alt="iPhone 6" class="img-responsive">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#">
                                    <img src="https://i.pinimg.com/originals/95/0a/26/950a266324f1887448bda91c7af54d9d.jpg" alt="MacBookAir2" class="img-responsive">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#">
                                    <img src="https://demo.opencart.com/image/cache/catalog/demo/banners/iPhone6-1140x380.jpg" alt="iPhone 62" class="img-responsive"></a>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-pagination slideshow0">

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
                                    <img  style="width: 240px; height: 180px;" src="<?php echo e(asset( '/view/image/'.$product->image)); ?>" alt="MacBook" title="MacBook" class="img-responsive">
                                </a>
                            </div>
                            <div class="caption">
                                <h4><a href="<?php echo e(route('product.detail' ,['id'=>$product->product_id])); ?>"><?php echo e($product->name); ?></a></h4>
                                <p>
                                   <?php echo e(substr(strip_tags($product->description), 0, 108)); ?>....
                                </p>
                                <p class="price">
                                   <?php
                                       $price='';
                                           if($product->productSpecial() != -1)
               {
                  $price=' <span style="text-decoration: line-through;">'. currency_symbol( tax_price( $product->price , $product->getTaxRate()), null).'</span>
                      &nbsp   <span class="text-danger">  '.  currency_symbol(tax_price( $product->productSpecial() , $product->getTaxRate()) , null) .'</span>';
                $tax =tax_price($product->productSpecial(),$product->getTaxRate()) - $product->productSpecial();
                } else
                    {
                        $price = currency_symbol(  tax_price( $product->price , $product->getTaxRate()) , null);
                         $tax=tax_price( $product->price,$product->getTaxRate())- $product->price;
                    }
                                   ?>
                                    <?php echo $price; ?>

                                    <span class="price-tax">Tax: <?php echo e(currency_symbol($tax)); ?>  </span>
                                </p>
                            </div>
                            <div class="button-group">
                                <button class="addToCart" type="button" onclick="addToCart('<?php echo e($product->product_id); ?>' ,'default')" data-toggle="tooltip" data-original-title="Add to Cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                </button>
                                <button type="button" data-toggle="tooltip" title="" onclick="addToCart('<?php echo e($product->product_id); ?>','wishlist')" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('43');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-viewport">
                    <div id="carousel0" class="swiper-container">
                        <div class="swiper-wrapper" >
                            <?php $__currentLoopData = $Manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide text-center" >
                                <img src="<?php echo e(asset( '/view/image/'.$Manufacturer->image)); ?>"  style="width:130px; height:100px;" alt="Harley Davidson" class="img-responsive">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>

                    <div class="swiper-pager">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                    <div class="swiper-pagination carousel0">
                    </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javaScripts'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/home.blade.php ENDPATH**/ ?>