<?php $__env->startSection('content'); ?>

    <?php $__env->startPush('title'); ?>
        <title><?php echo e($title); ?></title>
    <?php $__env->stopPush(); ?>


    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="badge1 badge-primary" >
                <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number"><?php echo e(number_format($orders->count())); ?></span>
                    <span class="info-box-text">ORDER TOTAL</span>
                </div>
                &nbsp;
                <a  href="<?php echo e(route('admin.orders.list')); ?>" class="small-box-footer">
                    More&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="badge1 badge-success">
                <span class="info-box-icon"><i class="fa fa-tags"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number"><?php echo e(number_format($products->count())); ?></span>
                    <span class="info-box-text">PRODUCT TOTAL</span>
                </div>
                &nbsp;
                <a  href="<?php echo e(route('admin.products.list')); ?>" class="small-box-footer">
                    More&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>


        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="badge1 badge-warning" >
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number"><?php echo e(number_format($users->count())); ?></span>
                    <span class="info-box-text">CUSTOMER TOTAL</span>
                </div>
                &nbsp;
                <a  href="<?php echo e(route('admin.customers.list')); ?>" class="small-box-footer">
                    More&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->



        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="badge1 badge-danger">
                <span class="info-box-icon"><i class="fa fa-eye"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number"><?php echo e(count(onlineUsers())); ?></span>
                    <span class="info-box-text">WHO IS LINE</span>
                </div>
                &nbsp;
                <a href="<?php echo e('route(admin_news.index)'); ?>" class="small-box-footer">
                    More&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


    </div>


    
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary" style="border-top-color: #6f7373;">
                <div class="box-header with-border">
                    <h3 class="box-title">In 30 days</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding box-primary">
                    <div class="row">

                        <div id="chart-days" style="width:100%; height:auto; overflow: hidden;"></div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-12">
            <div class="box box-primary" style="border-top-color: #6f7373;">
                <div class="box-header with-border">
                    <h3 class="box-title">In 12 months</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding box-primary">
                    <div class="box">
                        
                        <div class="col-md-4" >
                            <div id="chart-pie" style="width:100%; height:auto;  "></div>
                        </div>
                        <div class="col-md-8"  >
                            <div id="chart-month" style="width:100%; height:auto;   "></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <div class="row">

        
        <?php
            $topOrder = $orders->with('orderStatus')->orderBy('id','desc')->limit(10)->get();
          //   $topOrder = $orders->orderBy('id','desc')->limit(10)->get();
        ?>

        <div class="col-md-6">

            <div class="box box-primary" style="border-top-color: #6f7373; height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Top new order</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding box-primary"  style=" height: 250px;">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('order.id')); ?></th>
                                    <th><?php echo e(trans('order.email')); ?></th>
                                    <th><?php echo e(trans('order.status')); ?></th>
                                    <th><?php echo e(trans('order.created_at')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($topOrder)): ?>
                                    <?php $__currentLoopData = $topOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a href="<?php echo e('route(admin_order.detail,[id=>$order->id])'); ?>"><?php echo e($order->id); ?></a></td>
                                            <td><?php echo e($order->email); ?></td>
                                            <td><span class="label label-<?php echo e($mapStyleStatus[$order->status]??''); ?>"><?php echo e($order->orderStatus->name); ?></span></td>
                                            <td><?php echo e($order->created_at); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        
        <?php
            $topCustomer = $users->orderBy('customer_id','desc')->limit(10)->get();
        ?>
        <div class="col-md-6">
            <div class="box box-primary" style="border-top-color: #6f7373; height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Top new customer</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding box-primary"  style=" height: 250px;">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th><?php echo e(trans('customer.name')); ?></th>
                                    <th><?php echo e(trans('customer.email')); ?></th>
                                    <th><?php echo e(trans('customer.sex')); ?></th>
                                    <th><?php echo e(trans('customer.status')); ?></th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($topCustomer)): ?>
                                    <?php $__currentLoopData = $topCustomer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($customer->name); ?></td>
                                            <td><?php echo e($customer->email); ?></td>
                                            <td><?php echo $customer->sex===0 ? ' Women' : 'Men'; ?></td>
                                            <td><?php echo $customer->status===1 ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>'; ?></td>
                                            <td> <a href="<?php echo e(route('customers.edit' , ['id'=>$customer->customer_id])); ?>">
                             <span data-toggle="tooltip"  data-original-title=" <?php echo e(trans('customer.tooltip_edit')); ?>" type="button" class="btn btn-default btn-primary">
                                  <i class="fa fa-pencil"></i>
                             </span>
                                                </a>&nbsp;
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        

        <div class="col-md-6">

            <div class="box box-primary" style="border-top-color: #6f7373; height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Active Users</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding box-primary" style=" height: 250px;">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Active_at</th>
                                    <th style="text-align: center;">OnLine/Offline</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(onlineUsers()): ?>
                                    <?php $__currentLoopData = onlineUsers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user['id']); ?></td>
                                            <td><?php echo e($user['name']); ?></td>
                                            <td><?php echo e($user['last_activity_at']); ?></td>
                                            <td style="text-align: center;">
                                                <?php if($user['online']): ?>
                                                    <h3   data-toggle="tooltip" data-original-title="OnLine"><i style="color: #ffc107" class="fa fa-circle text-success"></i> </h3>
                                                <?php else: ?>
                                                    <h3  data-toggle="tooltip" data-original-title="Offline"><i  style="color:#7f887f" class="fa fa-circle text-success"></i> </h3>
                                                <?php endif; ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        

        <div class="col-md-6">

            <div class="box box-primary" style="border-top-color: #6f7373; height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Active Customers</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding box-primary">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Active_at</th>
                                    <th style="text-align: center;">OnLine/Offline</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(url('/')); ?>/view/javascript/chartjs/AdminLTE.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('home_scripts'); ?>
    <script src="<?php echo e(url('/')); ?>/view/javascript/chartjs/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/view/javascript/chartjs/highcharts-3d.js" type="text/javascript"></script>
   <!-- <script src="<?php echo e(url('/')); ?>/view/javascript/chartjs/adminlte.min.js" type="text/javascript"></script>-->

    <script type="text/javascript">


        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('chart-days', {
                credits: {
                    enabled: false
                },
                title: {
                    text: '<?php echo e(trans('chart.static_30_day')); ?>'
                },
                xAxis: {
                    categories: <?php echo json_encode(array_keys($orderInMonth)); ?>,
                    crosshair: false

                },

                yAxis: [{
                    min: 0,
                    title: {
                        text: '<?php echo e(trans('chart.order')); ?>'
                    },
                }, {
                    title: {
                        text: '<?php echo e(trans('chart.amount')); ?>'
                    },
                    opposite: true
                },
                ],

                legend: {
                    align: 'left',
                    verticalAlign: 'top',
                    borderWidth: 0
                },

                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                },

                series: [
                    {
                        type: 'column',
                        name: '<?php echo e(trans('chart.order')); ?>',
                        data: <?php echo json_encode(array_values($orderInMonth)); ?>,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    },
                    {
                        type: 'spline',
                        name: '<?php echo e(trans('chart.amount')); ?>',
                        color: '#32ca0c',
                        yAxis: 1,
                        data: <?php echo json_encode(array_values($amountInMonth)); ?>,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            borderRadius: 3,
                            backgroundColor: 'rgba(252, 255, 197, 0.7)',
                            borderWidth: 0.5,
                            borderColor: '#AAA',
                            y: -6
                        }
                    },
                ]
            });
        });



        // Set up the chart
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chart-month',
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 0,
                    beta: 10,
                    depth: 50,
                    viewDistance: 25
                }
            },
            title: {
                text: '<?php echo e(trans('chart.static_month')); ?>'
            },
            subtitle: {
                text: '<?php echo e(trans('chart.static_month_help')); ?>'
            },
            legend: {
                enabled: false,
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: <?php echo json_encode(array_keys($dataInYear)); ?>,
                crosshair: false,
            },
            yAxis: [
                {
                    min: 0,
                    title: {
                        text: '<?php echo e(trans('chart.amount')); ?>'
                    },
                }
            ],
            plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: {
                        enabled: true,
                        borderRadius: 3,
                        backgroundColor: 'rgba(252, 255, 197, 0.7)',
                        borderWidth: 0.5,
                        borderColor: '#AAA',
                        y: -6
                    }
                }
            },
            series: [
                {
                    name : '<?php echo e(trans('chart.amount')); ?>',
                    data: <?php echo json_encode(array_values($dataInYear)); ?>,
                },
                {
                    type : 'spline',
                    color: '#d05135',
                    name : '<?php echo e(trans('chart.amount')); ?>',
                    data: <?php echo json_encode(array_values($dataInYear)); ?>

                }
            ]
        });

        function showValues() {
            $('#alpha-value').html(chart.options.chart.options3d.alpha);
            $('#beta-value').html(chart.options.chart.options3d.beta);
            $('#depth-value').html(chart.options.chart.options3d.depth);
        }

        // Activate the sliders
        $('#sliders input').on('input change', function () {
            chart.options.chart.options3d[this.id] = parseFloat(this.value);
            showValues();
            chart.redraw(false);
        });

        showValues();
    </script>

    <script>
        Highcharts.chart('chart-pie', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            credits: {
                enabled: false
            },
            title: {
                text: '<?php echo e(trans('chart.static_country')); ?>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}:{point.y}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: '<?php echo e(trans('chart.country')); ?>',
                data: <?php echo $dataPie; ?>,
            }]
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\yamenmarket\resources\views/admin/home.blade.php ENDPATH**/ ?>