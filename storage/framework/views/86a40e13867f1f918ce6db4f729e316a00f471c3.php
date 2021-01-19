<?php $__env->startSection('content'); ?>
    <?php
    use App\Models\Language;
    $languages=Language::getList()->toarray() ;

    ?>

    <div class="page-header">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?php echo e($action); ?>" method="post" id="form-order" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-order"
                                                  data-toggle="tab">Order Details</a></li>
                            <li><a href="#tab-customer" data-toggle="tab">Customer Details</a></li>
                            <li><a href="#tab-product" data-toggle="tab">Product Details</a></li>
                            <li><a href="#tab-attribute" data-toggle="tab">Order History</a></li>
                            </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-order">
                                <div class="form-group required">
                                    <label for="currency" class="col-sm-2 control-label"><?php echo e(trans('order.currency')); ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control currency " style="width: 100%;" name="currency" >
                                            <option value=""></option>
                                           <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($v->code); ?>" <?php echo e(old('currency' , $v->code)===$order->currency ? 'selected':''); ?>><?php echo e($v->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('currency')): ?>
                                            <span class="text-sm">
                                              <?php echo e($errors->first('currency')); ?>

                                              </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label for="exchange_rate" class="col-sm-2 control-label"><?php echo e(trans('order.exchange_rate')); ?></label>
                                    <div class="col-sm-8">
                                        <input type="number" id="exchange_rate" name="exchange_rate" value="<?php echo old('exchange_rate' , $order->exchange_rate?? ''); ?>" class="form-control exchange_rate" placeholder="Input Exchange rate" />
                                        <input type="hidden" id="id" name="id" value="<?php echo old('id' , $order->id?? ''); ?>" class="form-control"   />

                                    <?php if($errors->has('exchange_rate')): ?>
                                            <span class="text-sm">
                                               <?php echo e($errors->first('exchange_rate')); ?>

                                          </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment" class="col-sm-2 control-label"><?php echo e(trans('order.note')); ?></label>
                                    <div class="col-sm-8">
                                        <textarea name="comment" class="form-control comment" rows="5" placeholder=""><?php echo old('comment' , $order->comment?? ''); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label for="payment_method" class="col-sm-2 control-label"><?php echo e(trans('order.payment_method')); ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control payment_method " style="width: 100%;" name="payment_method">
                                            <?php $__currentLoopData = $paymentMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e(old('payment_method' , $order->payment_method) ==$k ? 'selected':''); ?>><?php echo e($v); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('payment_method')): ?>
                                            <span class="text-sm">
                                               <?php echo e($errors->first('payment_method')); ?>

                                             </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label for="shipping_method" class="col-sm-2 control-label"><?php echo e(trans('order.shipping_method')); ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control shipping_method " style="width: 100%;" name="shipping_method">
                                           <?php $__currentLoopData = $shippingMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e((old('shipping_method' , $order->shipping_method) ==$k) ? 'selected':''); ?>><?php echo e($v); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('shipping_method')): ?>
                                            <span class="text-sm">
                                              <?php echo e($errors->first('shipping_method')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label for="status" class="col-sm-2 control-label"><?php echo e(trans('order.status')); ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control status " style="width: 100%;" name="status">
                                            <?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e((old('status' , $order->status) ==$k) ? 'selected':''); ?>><?php echo e($v); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('status')): ?>
                                            <span class="text-sm">
                                              <?php echo e($errors->first('status')); ?>

                                                      </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-customer">
                                <div class="form-group">
                                    <label for="customerId" class="col-sm-2  control-label"><?php echo e(trans('order.select_customer')); ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control customerId" style="width: 100%;" name="customerId" >
                                            <option value=""></option>
                                             <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($k); ?>" <?php echo e((old('customerId' , $order->customer_id) ==$k) ? 'selected':''); ?>><?php echo e($v->name.'  <'.$v->email.'>'); ?></option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('customerId')): ?>
                                            <span class="text-sm">
                                             <?php echo e($errors->first('customerId')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <input type="hidden" name="email" value="<?php echo e(old('email',isset($order->email) ? $order->email : '')); ?>">
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="first_name"><?php echo e(trans('customer.first_name')); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="first_name" value="<?php echo e(old('first_name' , $order->first_name?? '')); ?>" placeholder="<?php echo e(trans('customer.first_name')); ?>" id="first_name" class="form-control">
                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="last_name"><?php echo e(trans('customer.last_name')); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="last_name" value="<?php echo e(old('last_name' ,$order->last_name ??  '')); ?>" placeholder="<?php echo e(trans('customer.last_name')); ?>" id="last_name" class="form-control">
                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="address1"><?php echo e(trans('customer.address1')); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="address1" value="<?php echo e(old('address1' ,$order->address1 ??  '')); ?>" placeholder="<?php echo e(trans('customer.address1')); ?>" id="address1" class="form-control">
                                        <?php $__errorArgs = ['address1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="address2"><?php echo e(trans('customer.address2')); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="address2" value="<?php echo e(old('address2' ,$order->address2 ?? '')); ?>" placeholder="<?php echo e(trans('customer.address2')); ?>" id="address2" class="form-control">
                                        <?php $__errorArgs = ['address2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="country">
                                        <?php echo e(trans('customer.country')); ?>

                                    </label>
                                    <div class="col-sm-8">
                                        <select name="country" id="country"
                                                class="form-control">
                                             <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($key); ?>" <?php echo e(old('country' ,$order->country ?? 'YE')==$key ? 'selected' : ''); ?>> <?php echo e($country['name']); ?></option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="phone"><?php echo e(trans('customer.phone')); ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone" value="<?php echo e(old('phone' ,$order->phone ?? '')); ?>" placeholder="0........" id="phone" class="form-control">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <br>
                                <br>

                            </div>

                            <div class="tab-pane" id="tab-product">
                                <div class="table-responsive">
                                    <table id="discount" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left"><?php echo e(trans('product.entry_name')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_model')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_price')); ?></td>
                                            <td class="text-left"><?php echo e(trans('product.entry_quantity')); ?></td>
                                            <td class="text-left">Total</td>
                                            <td class="text-left">Tax</td>
                                            <td  class="text-left">Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $product_row = 0 ;?>
                                        <?php if(isset($order_details)): ?>
                                            <?php $__currentLoopData = $order_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="product-row<?php echo e($product_row); ?>">
                                                    <td class="text-left">
                                                        <select onchange="selectProduct($(this));" style="  min-width:   90px;"
                                                            name="products[<?php echo $product_row; ?>][product_id]"
                                                            class="form-control">
                                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($product->product_id); ?>" <?php echo e(old('products'.$product_row.'product_id' ,$order_detail['product_id'] ??'')==$product->product_id ? 'selected' : ''); ?>> <?php echo e($product->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="text" readonly style="  min-width:   90px;"
                                                                                  name="products[<?php echo $product_row; ?>][model]"
                                                                                  value="<?php echo e($order_detail->sku); ?>"
                                                                                  placeholder="Sku"
                                                                                  class="add_sku form-control"/>
                                                        <input type="hidden"
                                                               name="products[<?php echo $product_row; ?>][id]"
                                                               value="<?php echo e($order_detail->id); ?>" />
                                                        <input type="hidden"
                                                               name="products[<?php echo $product_row; ?>][name]"
                                                               value="<?php echo e($order_detail->name); ?>"/>
                                                    </td>
                                                    <td class="text-right"><input type="number" onchange="update_total($(this));" style="  min-width:   90px;"
                                                                                  name="products[<?php echo $product_row; ?>][price]"
                                                                                  value="<?php echo e($order_detail->price); ?>"
                                                                                  placeholder="<?php echo e(trans('product.entry_price')); ?>"
                                                                                  class="add_price   form-control"/></td>
                                                    <td class="text-right"><input type="number" onchange="update_total($(this));" style="  min-width:   90px;"
                                                                                  name="products[<?php echo $product_row; ?>][quantity]"
                                                                                  value="<?php echo e($order_detail->quantity); ?>"
                                                                                  placeholder="<?php echo 'quantity'; ?>"
                                                                                  class="add_qty   form-control"/>
                                                     </td>

                                                    <td class="text-left" >
                                                            <input type="text" readonly style="  min-width:   90px;"
                                                                   name="products[<?php echo $product_row; ?>][total]"
                                                                   value="<?php echo e($order_detail->total_price); ?>"
                                                                   placeholder="<?php echo e(trans('product.entry_date_start')); ?>"
                                                                    class="add_total form-control"/>
                                                    </td>
                                                    <td class="text-left">
                                                            <input readonly type="number" onchange="update_total($(this));" style="  min-width:   90px;"
                                                                   name="products[<?php echo $product_row; ?>][tax]"
                                                                   value="<?php echo e(old('products.'.$product_row.'.tax',$order_detail->tax )); ?>"
                                                                   placeholder="Tax"
                                                                    class="add_tax   form-control"/>
                                                        <input disabled   style=" min-width:   90px;" type="hidden"  min="0" name="hidden_tax[]" value="<?php echo e(get_tax( $order_detail->total_price , $order_detail->tax)); ?>" placeholder="Tax"  class="hidden_tax form-control" />
                                                    </td>
                                                    <td class="text-left">
                                                        <button type="button"
                                                                onclick="remove(<?php echo $product_row; ?>);"
                                                                data-toggle="tooltip" id="button_remove" title="<?php echo 'button_remove'; ?>"
                                                                class="btn btn-danger"><i class="fa fa-minus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php $product_row++ ; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="text-left">
                                            </td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <label for="subtotal" class="col-sm-4 control-label">Subtotal:</label>
                                                    <div class="col-sm-8">
                                                        <input value="0" style="background-color: white;min-width:60px ; padding: 0px; border: none;" disabled type="number" name="subtotal" value="" class="form-control"  />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <div class="form-group">
                                                    <label for="tax" class="col-sm-4 control-label">Tax:</label>
                                                    <div class="col-sm-8">
                                                        <input  disabled value="0" style="background-color: white;min-width:60px ; padding: 0px; border: none;"  type="number" name="tax_total" value="" class="form-control"  />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                <button type="button" onclick="addProduct();" data-toggle="tooltip"
                                                        title="<?php echo e(trans('product.button_discount_add')); ?>"
                                                        class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card collapsed-card">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td class="td-title-normal">Subtotal:</td>
                                                    <td style="text-align:right" class="data-subtotal">
                                                        <input value="0" style="text-align:right ; background-color: white;min-width:60px ; padding: 0px; border: none;" readonly type="number" name="subtotal" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-normal">Tax:</td>
                                                    <td style="text-align:right" class="data-tax">
                                                        <input  value="<?php echo e($order->tax); ?>"  readonly onChange="update_total($(this));" style="text-align:right ; background-color: white;min-width:60px ; padding: 0px; border: none;"  type="number" name="tax_subtotal" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-normal">Tax2:</td>
                                                    <td style="text-align:right" class="data-tax">
                                                        <input readonly value="0" onChange="update_total($(this));" style="text-align:right ; background-color: white;min-width:60px ; padding: 0px;  "  type="number" name="tax2" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping:</td>
                                                    <td style="text-align:right">
                                                        <input   value="<?php echo e($order->shipping); ?>" onChange="update_total($(this));"  style="text-align:right ; background-color: white;min-width:60px ; "  type="number" name="shipping" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discount:</td>
                                                    <td style="text-align:right">
                                                        <input  value="<?php echo e($order->discount); ?>" onChange="update_total($(this));" style="text-align:right ; background-color: white;min-width:60px ; "  type="number" name="discount" class="  form-control">
                                                    </td>
                                                </tr>
                                                <tr style="background:#f5f3f3;font-weight: bold;">
                                                    <td>Total:</td>
                                                    <td style="text-align:right" class="data-total">
                                                        <input readonly value="<?php echo e($order->total); ?>"  style="text-align:right ; background-color: #f5f3f3;min-width:60px ; padding: 0px; border: none;"   type="number" name="total" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Received:</td>
                                                    <td style="text-align:right">
                                                        <input   value="<?php echo e($order->received); ?>" onChange="update_total($(this));"  style="text-align:right ; background-color: white;min-width:60px ; "  type="number" name="received" class="  form-control">
                                                    </td>
                                                </tr>
                                                <tr style="font-weight:bold;" class="data-balance">
                                                    <td>Balance:</td>
                                                    <td align="right">
                                                        <input readonly value="<?php echo e($order->balance); ?>"  style="text-align:right ; background-color: #f5f3f3;min-width:60px ; padding: 0px; border: none;"   type="number" name="balance" class="form-control">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="card">
                                            <table class="table table-bordered">
                                                <tbody><tr>
                                                    <td class="td-title">Order note:</td>
                                                    <td>
                                                        <a href="#" class="updateInfo editable editable-click" data-name="comment" data-type="text" data-pk="3" data-url="http://localhost/demo_admin/order/update" data-title="">
                                                            sssssssssss
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

 <?php $__env->stopSection(); ?>


 <?php $__env->startPush('scripts'); ?>
            <script type="text/javascript">

                $('[name="customerId"]').change(function(){
                    addInfoCustomer();
                });
                $('[name="currency"]').change(function(){
                    addExchangeRate();
                });

                function addExchangeRate(){
                    var currency = $('[name="currency"]').val();
                    var jsonCurrency = <?php echo $currenciesRate  ?? ''; ?>;
                    $('[name="exchange_rate"]').val(jsonCurrency[currency]);
                }

                function addInfoCustomer(){
                    id = $('[name="customerId"]').val();
                    if(id){
                        $.ajax({
                            url : '<?php echo e(route('admin.orders.customer_info')); ?>',
                            type : "get",
                            dateType:"application/json; charset=utf-8",
                            data : {
                                id : id
                            },
                            beforeSend: function(){
                                $('#loading').show();
                            },
                            success: function(result){
                                var returnedData = JSON.parse(result);
                                $('[name="first_name"]').val(returnedData.first_name);
                                $('[name="last_name"]').val(returnedData.last_name);
                                $('[name="address1"]').val(returnedData.address_1);
                                $('[name="address2"]').val(returnedData.address_2);
                                $('[name="email"]').val(returnedData.email);
                                $('[name="phone"]').val(returnedData.phone);
                                $('[name="country"]').val(returnedData.country).change();
                                $('#loading').hide();
                            }
                        });
                    }else{
                        $('#form-main').reset();
                    }

                }

            </script>


            <script type="text/javascript">

                $(document).ready(function() {
                    subtotal();
                });

                function subtotal()
                {
                    var total= 0;
                    var tax= 0;
                    $('.add_total').each(function(){
                        total+=Number($(this).val());
                    });
                    $('.add_tax').each(function(){
                        tax+=Number($(this).val());
                    });
                    $('input[name=\'subtotal\']').val(total);
                    $('input[name=\'tax_total\']').val(tax);
                    $('input[name=\'tax_subtotal\']').val(tax);
                    var tax2=Number($('input[name=\'tax2\']').val());
                    var discount=Number($('input[name=\'discount\']').val());
                    var shipping=Number($('input[name=\'shipping\']').val());
                    $('input[name=\'total\']').val(tax+tax2+total+shipping-discount);
                    var received=Number($('input[name=\'received\']').val());
                    $('input[name=\'balance\']').val(tax+tax2+total+shipping-discount-received);

                }

                function update_total(e){
                    node = e.closest('tr');
                    var qty = node.find('.add_qty').eq(0).val();
                    var price = node.find('.add_price').eq(0).val();
                    var tax = node.find('.hidden_tax').eq(0).val();
                    node.find('.add_total').eq(0).val(qty*price);
                    node.find('.add_tax').eq(0).val(qty*price*tax/100);
                    subtotal();

                }

                var product_row = <?php echo $product_row; ?>;

                function addProduct() {
                    html  = '<tr id="product-row' + product_row + '">';
                    html += '  <td class="text-left"><select   style=" min-width:   90px;" onChange="selectProduct($(this));" name="products[' + product_row + '][product_id]" class="form-control"><option  value="0">Select product</option>';
                    <?php  foreach($products as $product) { ?>
                        html += '  <option value="<?php echo e($product->product_id); ?>" <?php echo e(old('products'.$product_row.'product_id')==$product->product_id ? 'selected' : ''); ?>> <?php echo e($product['name']); ?></option>';
                    <?php   } ?>
                        html += '  </select></td>';
                    html += '  <td class="text-right"><input   style="  min-width:   90px;" readonly type="text" placeholder="sku" class="add_sku form-control" name="products[' + product_row + '][model]" />' +
                        '<input   style="  min-width:   90px;"  type="hidden" placeholder="name" class="add_name form-control" name="products[' + product_row + '][name]" /></td>';
                    html += '  <td class="text-right"><input    style="  min-width:   90px;" onChange="update_total($(this));" type="number" min="0"   value="0" placeholder="price" class="add_price   form-control" name="products[' + product_row + '][price]" /></td>';
                    html += '  <td class="text-right"><input   style="  min-width:   90px;"   onChange="update_total($(this));" type="number" min="0"  value="0" placeholder="quantity" class="add_qty   form-control" name="products[' + product_row + '][quantity]" />    ';
                    html += '  <td class="text-left"><input   style="  min-width:   90px;" type="number" readonly name="products[' + product_row + '][total]" value="0" placeholder="Total"  class="add_total   form-control" /></td>';
                    html += '  <td class="text-left"> <input   style=" min-width:   90px;" readonly onchange="update_total($(this));" type="number"  min="0" name="products[' + product_row + '][tax]" value="0" placeholder="Tax"  class="add_tax   form-control" /><input disabled   style=" min-width:   90px;" type="hidden"  min="0" name="hidden_tax[]" value="0" placeholder="Tax"  class="hidden_tax form-control" /></td>';
                    html += '  <td class="text-left"><button type="button" onclick="remove(' + product_row +');" data-toggle="tooltip" id="button_remove" title="<?php echo 'button_remove'; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                    html += '</tr>';

                    $('#discount tbody').append(html);
                    product_row++;
                }

                function remove(product_row)
                {
                    $('#product-row'+product_row).remove();
                    subtotal();
                }

                function selectProduct(element){
                    node = element.closest('tr');
                    var id = parseInt(node.find('option:selected').eq(0).val());
                    if(id == 0){
                        node.find('.add_sku').val('');
                        node.find('.add_name').val('');
                        node.find('.add_qty').eq(0).val('');
                        node.find('.add_price').eq(0).val('');
                        node.find('.add_tax').eq(0).val('');
                        node.find('.hidden_tax').eq(0).val('');
                    }else{
                        $.ajax({
                            url : '<?php echo e(route('admin.orders.product_info')); ?>',
                            type : "get",
                            dateType:"application/json; charset=utf-8",
                            data : {
                                id : id,
                                order_id : <?php echo e($order->id); ?>,
                            },
                            beforeSend: function(){
                                $('#loading').show();
                            },
                            success: function(returnedData){
                                node.find('.add_sku').val(returnedData.sku);
                                node.find('.add_name').val(returnedData.name);
                                node.find('.add_qty').eq(0).val(1);
                                node.find('.add_price').eq(0).val(returnedData.price_final * <?php echo ($order->exchange_rate)??1; ?>);
                                node.find('.add_total').eq(0).val(returnedData.price_final * <?php echo ($order->exchange_rate)??1; ?>);
                                node.find('.add_tax').eq(0).val(returnedData.tax);
                                node.find('.hidden_tax').eq(0).val(returnedData.tax);
                                $('#loading').hide();
                                update_total(element);

                            }
                        });
                    }
                }

            /*    function order_print()
                {
                    var restorepage=document.body.innerHTML;
                    var printcontent=document.getElementById('pjax-container').innerHTML;
                    document.body.innerHTML=printcontent ;
                    window.print();
                    document.body.innerHTML=restorepage ;

                }*/

            </script>
 <?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/order_detail_form.blade.php ENDPATH**/ ?>