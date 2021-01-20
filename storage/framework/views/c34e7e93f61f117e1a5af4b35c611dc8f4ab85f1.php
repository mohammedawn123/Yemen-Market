<!-- Sidebar Menu -->

<column id="column-left"  class="pull-right not-print"  style="<?php echo e(trans('product.style')); ?>">
    <div id="profile">
        <div class="pull-left image" >
            <a class="dropdown-toggle" data-toggle="dropdown">
                <img style="width: 25px;
height: 25px; " src="<?php echo e(isset(Auth::user()->photo ) ?  asset( '/view/image/'.Auth::user()->photo )  :   asset('/view/image/user_photo4.png')); ?>" class="img-circle" alt="User Image">

            </a>
        </div>
        <div>
            <?php if(auth()->guard()->check()): ?> <h4 style="color: #f9a123"> <?php echo e(Auth::user()->name); ?></h4><?php endif; ?>
            <span>  <h5 style="color: #1fc8e3"><i class="fa fa-circle text-success"></i> Online</h5></span>
        </div>
    </div>
    <div class="sidebar" style="height: 460px;">
        <ul id="menu">
            <li id="dashboard"  ><a href="<?php echo e(route('admin.home2')); ?>"><i class="fa fa-home"></i>
                    <span><?php echo e(trans('admin_menu.text_dashboard')); ?></span></a></li>
            <li id="catalog"  ><a class="parent"><i class="fa fa-tags fa-fw"></i> <span><?php echo e(trans('admin_menu.text_catalog')); ?></span></a>
                <ul class="collapse">
                    <li ><a href="<?php echo e(route('admin.categories.list')); ?>">
                            <?php echo e(trans('admin_menu.text_category')); ?>

                            <?php if(!Auth::user()->can('categories.show')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                        </a></li>
                    <li><a href="<?php echo e(route('admin.products.list')); ?>">
                            <?php echo e(trans('admin_menu.text_product')); ?>

                            <?php if(!Auth::user()->can('products.show')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>

                        </a></li>

                    <li><a class="parent">    <?php echo e(trans('admin_menu.text_attribute')); ?></a>
                        <ul class="collapse">
                            <li><a href="<?php echo e(route('admin.attributes.list')); ?>">  <?php echo e(trans('admin_menu.text_attribute')); ?>

                                    <?php if(!Auth::user()->can('attributes.show')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                                </a></li>
                            <li><a href="<?php echo e(route('admin.attribute_group.list')); ?>">  <?php echo e(trans('admin_menu.text_attribute_group')); ?>

                                    <?php if(!Auth::user()->can('language_groups.show')): ?> <i class="fa fa-lock"></i>  <?php endif; ?>
                                </a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo e(route('admin.manufacturers.list')); ?>">
                    <?php echo e(trans('admin_menu.text_manufacturer')); ?>

                       <?php if(!Auth::user()->can('manufacturers.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                     </a></li>

                    <li><a href="">
                    <?php echo e(trans('admin_menu.text_download')); ?>

                       <?php if(!Auth::user()->can('downloads.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                    </a></li>

                    <li><a href="">
                    <?php echo e(trans('admin_menu.text_information')); ?>

                      <?php if(!Auth::user()->can('information.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                    </a></li>
                </ul>
            </li>
            <li id="extension">
                <a class="parent">
                    <i class="fa fa-puzzle-piece fa-fw"></i>
                    <span><?php echo e(trans('admin_menu.text_extension')); ?></span>
                </a>
                <ul class="collapse">
                    <li><a href="#">Extension Installer</a></li>
                    <li><a href="#">Modifications</a></li>
                    <li><a href="#">Modules</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Payments</a></li>
                    <li><a href="#">Order Totals</a></li>
                    <li><a href="#">Feeds</a></li>
                </ul>
            </li>
            <li id="sale">
                <a class="parent">
                    <i class="fa fa-shopping-cart fa-fw"></i>
                    <span><?php echo e(trans('admin_menu.text_sale')); ?></span>
                </a>
                <ul class="collapse">
                    <li><a href="<?php echo e(route('admin.orders.list')); ?>">
                      Orders
                      <?php if(!Auth::user()->can('orders.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                     </a></li>
                    <li><a href="">Recurring Orders</a></li>
                    <li><a href="">Returns</a></li>
                    <li><a class="parent">Customers</a>
                        <ul class="collapse">
                            <li><a href="<?php echo e(route('admin.customers.list')); ?>">
                               Customers
                              <?php if(!Auth::user()->can('customers.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                            </a></li>
                            <li><a href="<?php echo e(route('admin.customer_group.list')); ?>">
                              Customer Groups
                              <?php if(!Auth::user()->can('customer_group.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                             </a></li>
                            
                        </ul>
                    </li>
                    
                    <li><a class="parent">PayPal</a>
                        <ul class="collapse">
                            <li><a href="#">Search</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a class="parent">
                    <i class="fa fa-share-alt fa-fw"></i>
                    <span><?php echo e(trans('admin_menu.text_marketing')); ?></span>
                </a>
                <ul class="collapse">
                    <li><a href="# ">Marketing</a></li>
                    <li><a href="#">Affiliates</a></li>
                    <li><a href="#">Coupons</a></li>
                    <li><a href="#">Mail</a></li>
                </ul>
            </li>
            <li id="system">
                <a class="parent">
                    <i class="fa fa-cog fa-fw"></i>
                    <span><?php echo e(trans('admin_menu.text_system')); ?></span>
                </a>
                <ul class="collapse">
                    <li><a href="#"><?php echo e(trans('admin_menu.text_setting')); ?></a></li>
                    <li><a class="parent"><?php echo e(trans('admin_menu.text_design')); ?></a>
                        <ul class="collapse">
                            <li><a href="#">Layouts</a></li>
                            <li><a href="#">Banners</a></li>
                        </ul>
                    </li>
                    <li id="filemanager">
                        <a class="parent">

                            <span>Files Manager</span>
                        </a>
                        <ul class="collapse">

                            <?php if(Auth::user()->can('filemanager.show') || Auth::user()->isAdministrator()): ?>   <li><a href="<?php echo e(route('admin.fm_button')); ?>">Files Manager</a></li> <?php endif; ?>

                        </ul>
                    </li>
                    <li><a class="parent">
                            <?php echo e(trans('admin_menu.text_users')); ?>

                        </a>
                        <ul class="collapse">
                            <li><a href="<?php echo e(route('admin.users')); ?>"><?php echo e(trans('admin_menu.text_users')); ?>

                                    <?php if(!Auth::user()->can('users.show')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?> </a></li>
                            <li><a href="<?php echo e(route('admin.roles.list')); ?>"><?php echo e(trans('admin_menu.text_user_group')); ?>

                                    <?php if(!Auth::user()->can('roles.full')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?> </a></li>
                            <li><a href="<?php echo e(route('admin.permission.list')); ?>"><?php echo e(trans('admin_menu.text_user_permission')); ?>  <?php if(!Auth::user()->can('permissions.full')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?> </a></li>
                            <li><a href="#">Operation log</a></li>
                        </ul>
                    </li>
                    <li><a class="parent"><?php echo e(trans('admin_menu.text_localisation')); ?> </a>
                        <ul class="collapse">
                            
                            <li><a href="<?php echo e(route('admin.languages')); ?>">Languages
                                    <?php if(!Auth::user()->can('languages.show')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                                </a></li>
                            <li><a href="<?php echo e(route('admin.currencies.list')); ?>">
                            Currencies
                              <?php if(!Auth::user()->can('currencies.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                             </a></li>
                            <li><a href="#">Stock Statuses</a></li>
                            <li><a href="<?php echo e(route('admin.orderStatuses.list')); ?>">
                            Order Statuses
                              <?php if(!Auth::user()->can('orderStatuses.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                            </a></li>
                            
                            <li><a href="<?php echo e(route('admin.countries.list')); ?>">
                            Countries
                              <?php if(!Auth::user()->can('countries.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                            </a></li>
                            <li><a href="<?php echo e(route('admin.taxes.list')); ?>">
                            Taxes
                              <?php if(!Auth::user()->can('taxes.list')): ?>  <i class="fa fa-lock"></i>  <?php endif; ?>
                            </a></li>
                            <li><a href="#">Length Classes</a></li>
                            <li><a href="#">Weight Classes</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li id="tools">
                <a class="parent">
                    <i class="fa fa-wrench fa-fw"></i>
                    <span><?php echo e(trans('admin_menu.text_tools')); ?></span>
                </a>
                <ul class="collapse">
                    
                    <li><a href="#">Backup / Restore</a></li>
                    
                </ul>
            </li>
            <li id="reports">
                <a class="parent">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    <span><?php echo e(trans('admin_menu.text_reports')); ?></span>
                </a>
                <ul class="collapse">
                    <li><a class="parent">Sales</a>
                        <ul class="collapse">
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Tax</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="parent">Products</a>
                        <ul class="collapse">
                            <li><a href="#">Viewed</a></li>
                            <li><a href="#">Purchased</a></li>
                        </ul>
                    </li>
                    <li><a class="parent">Customers</a>
                        <ul class="collapse">
                            <li><a href="#">Customers Online</a></li>
                            <li><a href="#">Customer Activity</a></li>
                            <li><a href="#">Orders</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="parent">Marketing</a>
                        <ul class="collapse">
                            
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <div id="stats">
            <ul>
                <li>
                    <div>New Orders <span class="pull-right"><?php echo e(ceil(orders_progress()['new'])); ?>%</span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo e(orders_progress()['new']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(orders_progress()['new']); ?>%">
                            <span class="sr-only">100%</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div>Processing Orders<span class="pull-right"><?php echo e(ceil(orders_progress()['processing'])); ?>%</span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo e(orders_progress()['processing']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(orders_progress()['processing']); ?>%">
                            <span class="sr-only">0%</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div>Other Statuses <span class="pull-right"><?php echo e(ceil(orders_progress()['others'])); ?>%</span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo e(orders_progress()['others']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(orders_progress()['others']); ?>%">
                            <span class="sr-only">100%</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</column>

<?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/includes/SidebarMenu.blade.php ENDPATH**/ ?>