<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('shop.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <?php $cart= Cart::getListCart('default');  ?>
       <?php if($cart['items']): ?>
        <div   class="col-md-12">
            <h2 >My Shopping Cart</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                         <th class="text-center">ID</th>
                        <th class="text-center">Image</th>
                        <th class="text-left">Product Name</th>
                        <th class="text-left">Quantity</th>
                        <th class="text-left">Price</th>
                        <th class="text-left">Total</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $cart['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr >
                            <td class="text-center">
                                <?php echo e($list['id']); ?>

                            </td>
                            <td class="text-center">
                                <?php echo $list['image']; ?>


                            </td>
                            <td class="text-left">
                                <?php echo e($list['name']); ?>

                            </td>
                            <td  class="text-left">
                                <div class="input-group btn-block" style="max-width: 250px;">
                                    <input type="text" name="quantity" value="<?php echo e($list['qty']); ?>" size="1" class="form-control qty" data-id="<?php echo e($list['id']); ?>">
                                    <span class="input-group-btn">
                                    <button type="button" id="button" data-id="<?php echo e($list['id']); ?>" data-instance="default" onclick="update($(this));" data-toggle="tooltip" title="" class="btn btn-primary addToCart" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                    <a href="<?php echo e(route('item.remove' , ['id'=> $list['id'] , 'instance'=>'default'])); ?>" data-toggle="tooltip" title="" class="btn btn-danger"   data-original-title="Remove"><i class="fa fa-times-circle"></i></a>
                               </span>
                                </div>
                            </td>
                            <td class="text-left">  <?php echo e(currency_symbol($list['price'])); ?></td>
                            <td class="text-left" >   <?php echo e(currency_symbol($list['price'] * $list['qty'])); ?></td>



                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-12">
            <form class="sc-shipping-address" id="form-process" role="form" method="get" action="<?php echo e(route('cart.list')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                            <table class="table table-borderless table-responsive">
                            <tbody><tr width="100%">
                                <td class="form-group">
                                    <label for="phone" class="control-label"><i class="fa fa-user"></i>
                                        First name:</label>
                                    <input class="form-control" name="first_name" type="text" placeholder="First name" value="">
                                </td>
                                <td class="form-group">
                                    <label for="phone" class="control-label"><i class="fa fa-user"></i>
                                        Last name:</label>
                                    <input class="form-control" name="last_name" type="text" placeholder="Last name" value="">
                                </td>

                            </tr>


                            <tr>
                                <td class="form-group">
                                    <label for="email" class="control-label"><i class="fa fa-envelope"></i>
                                        Email:</label>
                                    <input class="form-control" name="email" type="text" placeholder="Email" value="">
                                </td>
                                <td class="form-group">
                                    <label for="phone" class="control-label"><i class="fa fa-phone" aria-hidden="true"></i> Phone:</label>
                                    <input class="form-control" name="phone" type="text" placeholder="Phone" value="">
                                </td>

                            </tr>


                            <tr>
                                <td colspan="2" class="form-group">
                                    <label for="country" class="control-label"><i class="fas fa-globe"></i>
                                        Country:</label>
                                    <select class="form-control country" style="width: 100%;" name="country">
                                        <option value="">__Country__</option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"> <?php echo e($country['name']); ?></option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                            </tr>


                            <tr>

                            </tr>

                            <tr>
                                <td class="form-group ">
                                    <label for="address1" class="control-label"><i class="fa fa-list-ul"></i>
                                        Address 1:</label>
                                    <input class="form-control" name="address1" type="text" placeholder="Address 1" value="">
                                </td>
                                <td class="form-group ">
                                    <label for="address2" class="control-label"><i class="fa fa-list-ul"></i>
                                        Address 2</label>
                                    <input class="form-control" name="address2" type="text" placeholder="Address 2" value="">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <label class="control-label"><i class="fa fa-calendar-o"></i>
                                        Note:</label>
                                    <textarea class="form-control" rows="5" name="comment" placeholder="Note...."></textarea>
                                </td>
                            </tr>


                            </tbody></table>

                    </div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table box table-bordered" id="showTotal">
                                    <tbody><tr class="showTotal">
                                        <th>Sub Total</th>
                                        <td style="text-align: right" id="subtotal">
                                            <?php echo e($cart['subtotal']); ?>

                                        </td>
                                    </tr>
                                    <tr class="showTotal">
                                        <th>Tax</th>
                                        <td style="text-align: right" id="tax">
                                            $3,000
                                        </td>
                                    </tr>
                                    <tr class="showTotal" style="background: #fbf0f0; font-weight: bold;">
                                        <th>Total</th>
                                        <td style="text-align: right" id="total">
                                            <?php echo e($cart['total']); ?>

                                        </td>
                                    </tr>
                                    </tbody></table>




<!--
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <h3 class="control-label"><i class="fa fa-truck" aria-hidden="true"></i>
                                                Shipping method:<br></h3>
                                        </div>

                                        <div class="form-group">
                                            <div>
                                                <label class="radio-inline">
                                                    <input type="radio" name="shippingMethod" value="ShippingStandard" style="position: relative;" class="radio-custom"><span class="radio-custom-dummy"></span>
                                                    Shipping Standard
                                                    ($0)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->




<!--                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <h3 class="control-label"><i class="fa fa-credit-card-alt"></i>
                                                Payment method:<br></h3>
                                        </div>
                                        <div class="form-group cart-payment-method">
                                            <div>
                                                <label class="radio-inline">
                                                    <input type="radio" name="paymentMethod" value="Cash" style="position: relative;" class="radio-custom"><span class="radio-custom-dummy"></span>
                                                    <label class="radio-inline" for="payment-Cash">
                                                        <img title="Cash on delivery" alt="Cash on delivery" src="http://localhost/Plugins/Payment/Cash/images/logo.png">
                                                    </label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                            </div>
                        </div>

                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-center">
                                <div class="pull-right">

                                    <button class="btn btn-primary" type="submit" id="button-form-process" href="cart-page.html">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php else: ?>
            <div class="col-md-12 text-center">
            <h3>    Your shopping cart is empty! </h3>
            </div>
         <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <?php $__env->stopPush(); ?>
<?php $__env->startPush('javaScripts'); ?>
    <script type="text/javascript">
   function update(element){
       node = element.closest('td');
       var id=node.find("#button").data("id");
      var instance=node.find("#button").data("instance");
        var qty = parseInt(node.find('.qty').eq(0).val());
       if(qty){
           $.ajax({
               url : '<?php echo e(route('item.update')); ?>',
               type : "get",
               dateType:"application/json; charset=utf-8",
               data : {
                   qty : qty ,
                   id : id ,
                   instance : instance
               },

               success: function(data){
                   error = parseInt(data.error);
                   if(error ==0)
                   {
                       alertJs('success', data.msg);
                   }
               }
           });
       }
    }
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.shop.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/shop/cart.blade.php ENDPATH**/ ?>