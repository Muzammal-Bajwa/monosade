<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="section">
        <?php if(Auth::user()->type == 'admin'): ?>
            <div class="row">
                <div class="col-12">
                    <?php if(empty(env('PUSHER_APP_ID')) || empty(env('PUSHER_APP_KEY')) || empty(env('PUSHER_APP_SECRET')) || empty(env('PUSHER_APP_CLUSTER'))): ?>
                        <div class="alert alert-warning"><i class="fas fa-warning"></i>
                            <?php echo e(__('Please Add Pusher Detail in Setting Page ')); ?><u><a
                                    href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('here')); ?></a></u></div>
                    <?php endif; ?>
                    <?php if(empty(env('MAIL_DRIVER')) || empty(env('MAIL_HOST')) || empty(env('MAIL_PORT')) || empty(env('MAIL_USERNAME')) || empty(env('MAIL_PASSWORD')) || empty(env('MAIL_PASSWORD'))): ?>
                        <div class="alert alert-warning"><i class="fas fa-warning"></i>
                            <?php echo e(__('Please Add Mail Details in Setting Page ')); ?> <u><a
                                    href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('here')); ?></a></u></div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="row">

                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">
                                       <?php echo e(__('Paid User')); ?> : <strong><?php echo e($totalPaidUsers); ?></strong></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Users')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalUsers); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-success">
                                        <i class="fas fa-cash-register"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">

                                        <?php echo e(__('Order Amount')); ?> : <strong><?php echo e((env('CURRENCY_SYMBOL') != '' ? env('CURRENCY_SYMBOL') : '$') . $totalOrderAmount); ?></strong></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Orders')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalOrders); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body total_plan">
                                    <div class="theme-avtar bg-danger">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">
                                        <?php echo e(__('Most purchase plan')); ?> : <strong> <?php if($mostPlans): ?>
                                            <?php echo e($mostPlans->name); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?></strong>
                                    </p>
                                    <h6 class="mb-3"><?php echo e(__('Total Plans')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalPlans); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                    <h5><?php echo e(__('Recent Orders')); ?></h5>
                                </div>
                                <div class=" col-2"><small class="text-end"></small></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="task-area-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($currentWorkspace): ?>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="row mt-3">
                        <div class="col-xl-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-primary">
                                        <i class="fas fa-tasks bg-primary text-white"></i>
                                    </div>
                                    <p class="text-muted text-sm"></p>
                                    <h6 class=""><?php echo e(__('Total Project')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalProject); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-tag bg-info text-white"></i>
                                    </div>
                                    <p class="text-muted text-sm "></p>
                                    <h6 class=""><?php echo e(__('Total Task')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalTask); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="fas fa-bug bg-danger text-white"></i>
                                    </div>
                                    <p class="text-muted text-sm"></p>
                                    <h6 class=""><?php echo e(__('Total Bug')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalBugs); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-success">
                                        <i class="fas fa-users bg-success text-white"></i>
                                    </div>
                                    <p class="text-muted text-sm"></p>
                                    <h6 class=""><?php echo e(__('Total User')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($totalMembers); ?> <span
                                            class="text-success text-sm"></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="">
                                        <?php echo e(__('Tasks')); ?>

                                    </h5>
                                </div>
                                <div class="col-auto d-flex justify-content-end">
                                    <div class="">
                                        <small><b><?php echo e($completeTask); ?></b> <?php echo e(__('Tasks completed out of')); ?>

                                            <?php echo e($totalTask); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-centered table-hover mb-0 animated">
                                    <tbody>
                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="font-14 my-1"><a
                                                            href="<?php echo e(route('projects.task.board', [$currentWorkspace->slug, $task->project_id])); ?>"
                                                            class="text-body"><?php echo e($task->title); ?></a></div>

                                                    <?php ($due_date = '<span class="text-' . ($task->due_date < date('Y-m-d') ? 'danger' : 'success') . '">' . date('Y-m-d', strtotime($task->due_date)) . '</span> '); ?>

                                                    <span class="text-muted font-13"><?php echo e(__('Due Date')); ?> :
                                                        <?php echo $due_date; ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13"><?php echo e(__('Status')); ?></span> <br />
                                                    <?php if($task->complete == '1'): ?>
                                                        <span
                                                            class="status_badge_dash badge bg-success p-2 px-3 rounded"><?php echo e(__($task->status)); ?></span>
                                                    <?php else: ?>
                                                        <span
                                                            class="status_badge_dash badge bg-primary p-2 px-3 rounded"><?php echo e(__($task->status)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="text-muted font-13"><?php echo e(__('Project')); ?></span>
                                                    <div class="font-14 mt-1 font-weight-normal">
                                                        <?php echo e($task->project->name); ?></div>
                                                </td>
                                                <?php if($currentWorkspace->permission == 'Owner' || Auth::user()->getGuard() == 'client'): ?>
                                                    <td>
                                                        <span class="text-muted font-13"><?php echo e(__('Assigned to')); ?></span>
                                                        <div class="font-14 mt-1 font-weight-normal">
                                                            <?php $__currentLoopData = $task->users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span
                                                                    class="badge p-2 px-2 rounded bg-secondary"><?php echo e(isset($user->name) ? $user->name : '-'); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Tasks Overview')); ?></h5>
                            <div class="text-end"><small class=""></small></div>
                        </div>
                        <div class="card-body">
                            <div id="task-area-chart"></div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Refferals"><i
                                        class=""></i></a>
                            </div>
                           
                            <h5><?php echo e(__('Project Status')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div id="projects-chart"></div>
                                </div>
                                <div class="col-6 pb-5 px-3">

                                    <div class="col-6">
                                        <span class="d-flex align-items-center mb-2">
                                            <i class="f-10 lh-1 fas fa-circle" style="color:#545454;"></i>
                                            <span class="ms-2 text-sm">On Going</span>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-flex align-items-center mb-2">
                                            <i class="f-10 lh-1 fas fa-circle" style="color: #3cb8d9;"></i>
                                            <span class="ms-2 text-sm">On Hold</span>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-flex align-items-center mb-2">
                                            <i class="f-10 lh-1 fas fa-circle" style="color: #6095c1; "></i>
                                            <span class="ms-2 text-sm">Finished</span>
                                        </span>
                                    </div>

                                </div>

                                <div class="row text-center">
                                    
                                    <?php $__currentLoopData = $arrProcessPer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-4">
                                            <i class="fas fa-chart <?php echo e($arrProcessClass[$index]); ?>  h3"></i>
                                            <h6 class="font-weight-bold">
                                                <span><?php echo e($value); ?>%</span>
                                            </h6>
                                            <p class="text-muted"><?php echo e(__($arrProcessLabel[$index])); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0 mt-3 text-center text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title mb-0">
                                <?php echo e(__('There is no active Workspace. Please create Workspace from right side menu.')); ?>

                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/custom/js/apexcharts.min.js')); ?>"></script>

    <?php if(Auth::user()->type == 'admin'): ?>
    <?php elseif(isset($currentWorkspace) && $currentWorkspace): ?>
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 200,
                        type: 'donut',
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                            }
                        }
                    },
                    series: <?php echo json_encode($arrProcessPer); ?>,

                    colors: <?php echo json_encode($chartData['color']); ?>,
                    labels: <?php echo json_encode($chartData['label']); ?>,
                    grid: {
                        borderColor: '#e7e7e7',
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    markers: {
                        size: 1
                    },
                    legend: {
                        show: false
                    }
                };
                var chart = new ApexCharts(document.querySelector("#projects-chart"), options);
                chart.render();
            })();

            setTimeout(function() {
                var taskAreaChart = new ApexCharts(document.querySelector(""), taskAreaOptions);
                taskAreaChart.render();
            }, 100);

            var projectStatusOptions = {
                series: <?php echo json_encode($arrProcessPer); ?>,

                chart: {
                    height: '350px',
                    width: '450px',
                    type: 'pie',
                },
                colors: ["#00B8D9", "#36B37E", "#2359ee"],
                labels: <?php echo json_encode($arrProcessLabel); ?>,

                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                title: {
                    text: ""
                },
                dataLabels: {},
                legend: {
                    display: false
                },

            };
            var projectStatusChart = new ApexCharts(document.querySelector("#project-status-chart"), projectStatusOptions);
            projectStatusChart.render();
        </script>
    <?php endif; ?>


    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <?php if(Auth::user()->type == 'admin'): ?>
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 150,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: <?php echo json_encode($chartData['data']); ?>,
                    xaxis: {
                        categories: <?php echo json_encode($chartData['label']); ?>,
                    },
                    colors: ['#ffa21d', '#FF3A6E'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    markers: {
                        size: 4,
                        colors: ['#ffa21d', '#FF3A6E'],
                        opacity: 0.9,
                        strokeWidth: 2,
                        hover: {
                            size: 7,
                        }
                    },
                    yaxis: {
                        tickAmount: 3,
                        min: 10,
                        max: 70,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#task-area-chart"), options);
                chart.render();
            })();
        </script>
    <?php elseif(isset($currentWorkspace) && $currentWorkspace): ?>
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 150,
                        type: 'line',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: [
                        <?php $__currentLoopData = $chartData['stages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                                name: "<?php echo e(__($name)); ?>",
                                data: <?php echo json_encode($chartData[$id]); ?>

                            },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    xaxis: {
                        categories: <?php echo json_encode($chartData['label']); ?>,
                        title: {
                            text: '<?php echo e(__('Days')); ?>'
                        }
                    },
                    colors: <?php echo json_encode($chartData['color']); ?>,

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    markers: {
                        size: 4,
                        colors: ['#ffa21d', '#FF3A6E'],
                        opacity: 0.9,
                        strokeWidth: 2,
                        hover: {
                            size: 7,
                        }
                    },
                    yaxis: {
                        tickAmount: 3,
                        min: 10,
                        max: 70,
                    },
                    title: {
                        text: '<?php echo e(__('Tasks')); ?>'
                    },
                };
                var chart = new ApexCharts(document.querySelector("#task-area-chart"), options);
                chart.render();
            })();
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\saas\resources\views/home.blade.php ENDPATH**/ ?>