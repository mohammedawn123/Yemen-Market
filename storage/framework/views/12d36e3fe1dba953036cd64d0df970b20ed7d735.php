<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('shop.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="product-product" class="container">

        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="row"> <div class="col-sm-8"> <ul class="thumbnails">
                            <li>
                                <a class="thumbnail" href="<?php echo e(asset( '/view/image/'.$image)); ?>" title="<?php echo e($name); ?>">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;" alt="<?php echo e($name); ?>">
                                </a></li>
                            <li class="image-additional">
                                <a class="thumbnail" href="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;" alt="Apple Cinema 30&quot;">
                                </a></li>
                            <li class="image-additional">
                                <a class="thumbnail" href="<?php echo e(asset( '/view/image/'.$image)); ?>" title="<?php echo e($name); ?>">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" title="<?php echo e($name); ?>" alt="<?php echo e($name); ?>"></a></li>
                            <li class="image-additional">
                                <a class="thumbnail" href="<?php echo e(asset( '/view/image/'.$image)); ?>" title="<?php echo e($name); ?>">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;" alt="Apple Cinema 30&quot;"></a></li>
                            <li class="image-additional">
                                <a class="thumbnail" href="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;" alt="Apple Cinema 30&quot;"></a></li>
                            <li class="image-additional">
                                <a class="thumbnail" href="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" title="Apple Cinema 30&quot;" alt="Apple Cinema 30&quot;"></a></li>
                        </ul>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab" aria-expanded="true">Description</a></li>
                            <li class=""><a href="#tab-specification" data-toggle="tab" aria-expanded="false">Specification</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-description">
                                <?php echo $description; ?>

                            </div>
                             <div class="tab-pane" id="tab-specification">
                                 <table class="table table-bordered">
                               <?php if($product_attributes): ?>
                                 <?php $__currentLoopData = $product_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <thead>
                                    <tr>
                                        <td colspan="2"><strong><?php echo e($attribute['group_name']); ?></strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo e($attribute['name']); ?></td>
                                        <td><?php echo e($attribute['product_attribute_description'][1]['text']); ?></td>
                                    </tr>
                                    </tbody>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                </table>
                            </div>

                        </div>
                    </div>



                    <div class="col-sm-4">
                        <div class="btn-group">
                            <button type="button" data-toggle="tooltip" class="btn btn-default" title="" onclick="addToCart('<?php echo e($product_id); ?>','wishlist')" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                            <button type="button" data-toggle="tooltip" class="btn btn-default" title="" onclick="compare.add('42');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
                        </div>
                        <h1>  <?php echo e($name); ?></h1>
                        <ul class="list-unstyled">
                            <li>Brand: <a href="#"><?php echo e($manufacturer); ?></a></li>
                            <li>Product Code: <?php echo e($model); ?></li>
                            <li>Reward Points: <?php echo e($points); ?></li>
                            <li>Availability: In Stock</li>
                        </ul>
                        <ul class="list-unstyled">
                            <?php if(isset($special)): ?>
                            <li><span style="text-decoration: line-through;"><?php echo e(currency_symbol($price  )); ?></span></li>
                           <?php endif; ?>
                            <li>
                                <h2> <?php echo e(currency_symbol($special ?? $price  )); ?></h2>
                            </li>
                            <li>Ex Tax: <?php echo e(currency_symbol($tax)); ?></li>

                            <li>
                                <hr>
                            </li>
                                <?php if($product_discounts): ?>
                                <?php $__currentLoopData = $product_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <li><?php echo e($discount['quantity']); ?> or more <?php echo e(currency_symbol($discount['price'] + $tax )); ?></li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                        </ul>
                        <div id="product"> <hr>

                            <div class="form-group">
                                <label class="control-label" for="input-quantity">Qty</label>
                                <input type="text" name="quantity" value="<?php echo e($minimum); ?>" size="2" id="input-quantity" class="form-control">
                                <input type="hidden" name="product_id" value="<?php echo e($product_id); ?>">
                                <br>
                                <button onclick="addToCart('<?php echo e($product_id); ?>' ,'default')"  type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block addToCart">Add to Cart</button>
                            </div>
                            <div class="alert alert-info"><i class="fa fa-info-circle"></i> This product has a minimum quantity of <?php echo e($minimum); ?></div>
                        </div>

                    </div>
                </div>
                <h3>Related Products</h3>
                <div class="row"> <div class="col-xs-6 col-sm-3">
                        <div class="product-thumb transition">
                            <div class="image"><a href="<?php echo e(asset( '/view/image/'.$image)); ?>">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" alt="iPhone" title="iPhone" class="img-responsive"></a></div>
                            <div class="caption">
                                <h4><a href="<?php echo e(asset( '/view/image/'.$image)); ?>">iPhone</a></h4>
                                <p>iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a name o..</p>
                                <p class="price"> $123.20
                                    <span class="price-tax">Ex Tax: $101.00</span> </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add('40', '1');"><span class="hidden-xs hidden-sm hidden-md">Add to Cart</span> <i class="fa fa-shopping-cart"></i></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="addToCart('<?php echo e($product_id); ?>' ,'wishlist')"  data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('40');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="product-thumb transition">
                            <div class="image"><a href="<?php echo e(asset( '/view/image/'.$image)); ?>">
                                    <img src="<?php echo e(asset( '/view/image/'.$image)); ?>" alt="iMac" title="iMac" class="img-responsive"></a></div>
                            <div class="caption">
                                <h4><a href="<?php echo e(asset( '/view/image/'.$image)); ?>">iMac</a></h4>
                                <p>Just when you thought iMac had everything, now there´s even more. More powerful Intel Core 2 Duo pro..</p>
                                <p class="price"> $122.00
                                    <span class="price-tax">Ex Tax: $100.00</span> </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add('41', '1');"><span class="hidden-xs hidden-sm hidden-md">Add to Cart</span> <i class="fa fa-shopping-cart"></i></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('41');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('41');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/product.blade.php ENDPATH**/ ?>