@extends('layouts.admin')

@section('page-title')
    {{ __('Dashboard') }}
@endsection

@section('content')


<!-- Content wrapper -->
<div class="content-wrapper">
                        <!-- Content -->

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 order-0">
                                    <div class="mini_content">
                                        <h1>
                                            Good morning,<br />
                                            <span>Martina M</span>
                                        </h1>
                                        <p>
                                            Here you can track your activity and<br />
                                            projects.
                                        </p>
                                        <a href="#"><i class="bx bx-plus fs-4 lh-0"></i> New Project</a>
                                    </div>
                                </div>
                                <div class="col-lg-8 mb-4 order-1">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-4 mb-4">
                                            <div class="status_card">
                                                <span>Active Projects</span>
                                                <h2>05</h2>
                                                <img src="{{asset('public/new_assets/assets/img/Eye.png')}}" alt="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-4 mb-4">
                                            <div class="status_card">
                                                <span>Completed Projects</span>
                                                <h2>100</h2>
                                                <img src="{{asset('public/new_assets/assets/img/IdentificationBadge.png')}}" alt="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-4 mb-4">
                                            <div class="status_card">
                                                <span>Team members</span>
                                                <h2>3</h2>
                                                <img src="{{asset('public/new_assets/assets/img/UserRectangle.png')}}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card table_card">
                                        <h5 class="card-header">Recent projects <a href="#">View all</a></h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Project</th>
                                                        <th>Client</th>
                                                        <th>Category</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td><img src="{{asset('public/new_assets/assets/img/avatars/5.png')}}" alt="" class="project-circle" /> Real estate Logo Design</td>
                                                        <td>Albert Cook</td>
                                                        <td>
                                                            Logo Design
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1">In-progress</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="{{asset('public/new_assets/assets/img/avatars/5.png')}}" alt="" class="project-circle" /> Real estate Logo Design</td>
                                                        <td>Albert Cook</td>
                                                        <td>
                                                            Logo Design
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1">In-progress</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="{{asset('public/new_assets/assets/img/avatars/5.png')}}" alt="" class="project-circle" /> Real estate Logo Design</td>
                                                        <td>Albert Cook</td>
                                                        <td>
                                                            Logo Design
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1">In-progress</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="{{asset('public/new_assets/assets/img/avatars/5.png')}}" alt="" class="project-circle" /> Real estate Logo Design</td>
                                                        <td>Albert Cook</td>
                                                        <td>
                                                            Logo Design
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1">In-progress</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="{{asset('public/new_assets/assets/img/avatars/5.png')}}" alt="" class="project-circle" /> Real estate Logo Design</td>
                                                        <td>Albert Cook</td>
                                                        <td>
                                                            Logo Design
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1">In-progress</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="{{asset('public/new_assets/assets/img/avatars/5.png')}}" alt="" class="project-circle" /> Real estate Logo Design</td>
                                                        <td>Albert Cook</td>
                                                        <td>
                                                            Logo Design
                                                        </td>
                                                        <td><span class="badge bg-label-primary me-1">In-progress</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="d_inspo">
                                        <h5>Design Inspiration</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12 col-3 mb-3">
                                                <a href="#">
                                                    <div class="card h-100">
                                                        <div class="card-img-top">
                                                            <button><i class="bx bx-heart"></i></button>
                                                            <span><img src="{{asset('public/new_assets/assets/img/d_inspo_1.png')}}" alt="Card image cap" /></span>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">Title of the post</h5>
                                                            <p class="card-text">
                                                                Logo Design
                                                            </p>
                                                            Start new project
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-md-12 col-3 mb-3">
                                                <a href="#">
                                                    <div class="card h-100">
                                                        <div class="card-img-top">
                                                            <button><i class="bx bx-heart"></i></button>
                                                            <span><img src="{{asset('public/new_assets/assets/img/d_inspo_1.png')}}" alt="Card image cap" /></span>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">Title of the post</h5>
                                                            <p class="card-text">
                                                                Logo Design
                                                            </p>
                                                            Start new project
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-md-12 col-3 mb-3">
                                                <a href="#">
                                                    <div class="card h-100">
                                                        <div class="card-img-top">
                                                            <button><i class="bx bx-heart"></i></button>
                                                            <span> <img src="{{asset('public/new_assets/assets/img/d_inspo_1.png')}}" alt="Card image cap" /></span>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">Title of the post</h5>
                                                            <p class="card-text">
                                                                Logo Design
                                                            </p>
                                                            Start new project
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-md-12 col-3 mb-3">
                                                <a href="#">
                                                    <div class="card h-100">
                                                        <div class="card-img-top">
                                                            <button><i class="bx bx-heart"></i></button>
                                                            <span><img src="{{asset('public/new_assets/assets/img/d_inspo_1.png')}}" alt="Card image cap" /></span>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">Title of the post</h5>
                                                            <p class="card-text">
                                                                Logo Design
                                                            </p>
                                                            Start new project
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->

                        

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
@endsection


@push('scripts')
    <script src="{{ asset('assets/custom/js/apexcharts.min.js') }}"></script>

    @if (Auth::user()->type == 'admin')
    @elseif(isset($currentWorkspace) && $currentWorkspace)
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
                    series: {!! json_encode($arrProcessPer) !!},

                    colors: {!! json_encode($chartData['color']) !!},
                    labels: {!! json_encode($chartData['label']) !!},
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
                series: {!! json_encode($arrProcessPer) !!},

                chart: {
                    height: '350px',
                    width: '450px',
                    type: 'pie',
                },
                colors: ["#00B8D9", "#36B37E", "#2359ee"],
                labels: {!! json_encode($arrProcessLabel) !!},

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
    @endif


    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    @if (Auth::user()->type == 'admin')
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
                    series: {!! json_encode($chartData['data']) !!},
                    xaxis: {
                        categories: {!! json_encode($chartData['label']) !!},
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
    @elseif(isset($currentWorkspace) && $currentWorkspace)
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
                        @foreach ($chartData['stages'] as $id => $name)
                            {
                                name: "{{ __($name) }}",
                                data: {!! json_encode($chartData[$id]) !!}
                            },
                        @endforeach
                    ],
                    xaxis: {
                        categories: {!! json_encode($chartData['label']) !!},
                        title: {
                            text: '{{ __('Days') }}'
                        }
                    },
                    colors: {!! json_encode($chartData['color']) !!},

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
                        text: '{{ __('Tasks') }}'
                    },
                };
                var chart = new ApexCharts(document.querySelector("#task-area-chart"), options);
                chart.render();
            })();
        </script>
    @endif
@endpush
