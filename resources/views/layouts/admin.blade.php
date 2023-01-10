<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{asset('public/new_assets/assets/img/favicon/favicon.ico')}}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/fonts/boxicons.css')}}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/css/icon_style.css')}}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

        <link rel="stylesheet" href="{{asset('public/new_assets/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="{{asset('public/new_assets/assets/vendor/js/helpers.js')}}"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{asset('public/new_assets/assets/js/config.js')}}"></script>
    </head>

    <body>
    <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
    @include('partials.sidebar')

   @include('partials.topnav')

   @yield('content')
                      
   @include('partials.footer')
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
   </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- <div class="buy-now">
            <div class="plan_card">
                <img src="{{asset('public/new_assets/assets/img/Question.png')}}" alt="" />
                <h2>Upgrade Now</h2>
                <p>You have just 5 projects left in your free plan. You need to upgrade your plan.</p>
                <a href="#" target="_blank">Upgrade Plan</a>
            </div> -->
            <!-- <a
        href="#"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      > -->
        </div>
   <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{asset('public/new_assets/assets/vendor/libs/jquery/jquery.js')}}"></script>
        <script src="{{asset('public/new_assets/assets/vendor/libs/popper/popper.js')}}"></script>
        <script src="{{asset('public/new_assets/assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{asset('public/new_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

        <script src="{{asset('public/new_assets/assets/vendor/js/menu.js')}}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{asset('public/new_assets/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

        <!-- Main JS -->
        <script src="{{asset('public/new_assets/assets/js/main.js')}}"></script>

        <!-- Page JS -->
        <script src="{{asset('public/new_assets/assets/js/dashboards-analytics.js')}}"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>
