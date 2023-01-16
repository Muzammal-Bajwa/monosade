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

   <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        @yield('content')
    </div>
   @include('partials.footer')
   
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
   </div>

<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
            </div>
                <div class="body">
                </div>
            
        </div>
    </div>
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



        <script src="{{ asset('assets/custom/js/custom.js') }}"></script> 
       <script src="{{ asset('assets/js/dash.js')}}"></script>



           <script type="text/javascript">
             $(document).on("click", ".view_all_notification", function () {
                $('.notification_menu_all').css('display','block');
                 //$(".notification_menu_all").addClass("show");
                $(".limited").hide();
                  $(".all_notification").show();
                  $(".view_less").show();
                   $(".view_all_notification").hide(); 
            });


             $(document).on("click", ".view_less", function () {
                 $('.notification_menu_all').css('display','block');
                $(".all_notification").hide();
                  $(".limited").show();
                  $(".view_all_notification").show();
                   $(".view_less").hide();
                  
            });

            </script>

            
<script>
        $(document).on("click", ".clear_all_notifications", function () {
          
            var chbox = $(this);
            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');


                        $('.noti-body').hide();
                        $('.dots').hide();

                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response, 'error');
                    }
                }
            })
        });

</script>

@if(env('CHAT_MODULE') == 'yes' && isset($currentWorkspace) && $currentWorkspace)
    @auth('web')
        {{-- Pusher JS--}}
        <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
        <script>
            $(document).ready(function () {
                pushNotification('{{ Auth::id() }}');
            });

            function pushNotification(id) {

                // ajax setup form csrf token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = false;

                var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                    cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                    forceTLS: true
                });

                var channel = pusher.subscribe('{{$currentWorkspace->slug}}');
                channel.bind('notification', function (data) {

                    if (id == data.user_id) {
                        $(".notification-toggle").addClass('beep');
                        $(".notification-dropdown .dropdown-list-icons").prepend(data.html);
                    }
                });
                channel.bind('chat', function (data) {
                    if (id == data.to) {
                        getChat();
                    }
                });
            }

            function getChat() {
                $.ajax({
                    url: '{{route('message.data')}}',
                    cache: false,
                    dataType: 'html',
                    success: function (data) {
                        if (data.length) {
                            $(".message-toggle").addClass('beep');
                            $(".dropdown-list-message").html(data);
                            LetterAvatar.transform();
                        }
                    }
                })
            }

            getChat();

            $(document).on("click", ".mark_all_as_read", function () {
                $.ajax({
                    url: '{{route('notification.seen',$currentWorkspace->slug)}}',
                    type: "get",
                    cache: false,
                    success: function (data) {
                        $('.notification-dropdown .dropdown-list-icons').html('');
                        $(".notification-toggle").removeClass('beep');
                    }
                })
            });
            $(document).on("click", ".mark_all_as_read_message", function () {
                $.ajax({
                    url: '{{route('message.seen',$currentWorkspace->slug)}}',
                    type: "get",
                    cache: false,
                    success: function (data) {
                        $('.dropdown-list-message').html('');
                        $(".message-toggle").removeClass('beep');
                    }
                })
            });
        </script>
        {{-- End  Pusher JS--}}
    @endauth
@endif
<script>
//   feather.replace();
//   var pctoggle = document.querySelector("#pct-toggler");
//   if (pctoggle) {
//     pctoggle.addEventListener("click", function () {
//       if (
//         !document.querySelector(".pct-customizer").classList.contains("active")
//       ) {
//         document.querySelector(".pct-customizer").classList.add("active");
//       } else {
//         document.querySelector(".pct-customizer").classList.remove("active");
//       }
//     });
//   }

  var themescolors = document.querySelectorAll(".themes-color > a");
  for (var h = 0; h < themescolors.length; h++) {
    var c = themescolors[h];

    c.addEventListener("click", function (event) {
      var targetElement = event.target;
      if (targetElement.tagName == "SPAN") {
        targetElement = targetElement.parentNode;
      }
      var temp = targetElement.getAttribute("data-value");
      removeClassByPrefix(document.querySelector("body"), "theme-");
      document.querySelector("body").classList.add(temp);
    });
  }

//   var custthemebg = document.querySelector("#cust-theme-bg");
//   custthemebg.addEventListener("click", function () {
//     if (custthemebg.checked) {
//       document.querySelector(".dash-sidebar").classList.add("transprent-bg");
//       document
//         .querySelector(".dash-header:not(.dash-mob-header)")
//         .classList.add("transprent-bg");
//     } else {
//       document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
//       document
//         .querySelector(".dash-header:not(.dash-mob-header)")
//         .classList.remove("transprent-bg");
//     }
//   });

//   var custdarklayout = document.querySelector("#cust-darklayout");
//   custdarklayout.addEventListener("click", function () {
//     if (custdarklayout.checked) {
     
//       document
//         .querySelector("#main-style-link")
//         .setAttribute("href", "{{ asset('assets/css/style-dark.css')}}");
//         document
//         .querySelector(".m-header > .b-brand > .logo-lg")
//         .setAttribute("src", "{{asset('assets/images/logo.svg')}}");
//     } else {
     
//       document
//         .querySelector("#main-style-link")
//         .setAttribute("href", "{{ asset('assets/css/style.css')}}");
//         document
//         .querySelector(".m-header > .b-brand > .logo-lg")
//         .setAttribute("src", "{{ asset('assets/images/logo-dark.svg')}}");
//     }
//   });
  function removeClassByPrefix(node, prefix) {
    for (let i = 0; i < node.classList.length; i++) {
      let value = node.classList[i];
      if (value.startsWith(prefix)) {
        node.classList.remove(value);
      }
    }
  }
</script>
<!-- Site JS -->

<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('assets/custom/js/ac-alert.js')}}"></script>
 <script src="{{ asset('assets/custom/js/letter.avatar.js') }}"></script>
<script src="{{ asset('assets/custom/js/fire.modal.js') }}"></script>

<script src="{{asset('assets/js/plugins/simple-datatables.js')}}"></script>
<script>
    const dataTable = new simpleDatatables.DataTable("#selection-datatable");
</script>

<!-- Demo JS - remove it when starting your project -->
{{--<script src="{{ asset('assets/js/demo.js') }}"></script>--}}

<script>
    var date_picker_locale = {
        format: 'YYYY-MM-DD',
        daysOfWeek: [
            "{{__('Sun')}}",
            "{{__('Mon')}}",
            "{{__('Tue')}}",
            "{{__('Wed')}}",
            "{{__('Thu')}}",
            "{{__('Fri')}}",
            "{{__('Sat')}}"
        ],
        monthNames: [
            "{{__('January')}}",
            "{{__('February')}}",
            "{{__('March')}}",
            "{{__('April')}}",
            "{{__('May')}}",
            "{{__('June')}}",
            "{{__('July')}}",
            "{{__('August')}}",
            "{{__('September')}}",
            "{{__('October')}}",
            "{{__('November')}}",
            "{{__('December')}}"
        ],
    };
    var calender_header = {
        today: "{{__('today')}}",
        month: '{{__('month')}}',
        week: '{{__('week')}}',
        day: '{{__('day')}}',
        list: '{{__('list')}}'
    };
</script>

 @if(env('gdpr_cookie')=='on')

<script type="text/javascript">
    
    var defaults = {
    'messageLocales': {
        /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
        'en': '{{env('cookie_text')}}'

    },
    'buttonLocales': {
        'en': 'Ok'
    },
    'cookieNoticePosition': 'bottom',
    'learnMoreLinkEnabled': false,
    'learnMoreLinkHref': '/cookie-banner-information.html',
    'learnMoreLinkText': {
      'it': 'Saperne di più',
      'en': 'Learn more',
      'de': 'Mehr erfahren',
      'fr': 'En savoir plus'
    },
    'buttonLocales': {
      'en': 'Ok'
    },
    'expiresIn': 30,
    'buttonBgColor': '#d35400',
    'buttonTextColor': '#fff',
    'noticeBgColor': '#000000',
    'noticeTextColor': '#fff',
    'linkColor': '#009fdd'
};
</script>
<script src="{{ asset('assets/custom/js/cookie.notice.js')}}"></script>
@endif

@if(isset($currentWorkspace) && $currentWorkspace)
    <script src="{{ asset('assets/custom/js/jquery.easy-autocomplete.min.js') }}"></script>
    <script>
        var options = {
            url: function (phrase) {
                return "@auth('web'){{route('search.json',$currentWorkspace->slug)}}@elseauth{{route('client.search.json',$currentWorkspace->slug)}}@endauth/" + phrase;
            },
            categories: [
                {
                    listLocation: "Projects",
                    header: "{{ __('Projects') }}"
                },
                {
                    listLocation: "Tasks",
                    header: "{{ __('Tasks') }}"
                }
            ],
            getValue: "text",
            template: {
                type: "links",
                fields: {
                    link: "link"
                }
            }
        };
        $(".search-element input").easyAutocomplete(options);
    </script>
@endif

<!--  for setting scroling Active -->

  <!-- <script>
        (function() {
            var switch_event = document.querySelector("#switch_event");

            switch_event.addEventListener('change', function() {
                if (switch_event.checked) {
                    document.querySelector("#console_event").innerHTML = "Switch Button Checked";
                } else {
                    document.querySelector("#console_event").innerHTML = "Switch Button Unchecked";
                }
            });
        })();
    </script> -->
@stack('scripts')
@if(Session::has('success'))
    <script>
        show_toastr('{{__('Success')}}', '{!! session('success') !!}', 'success');
    </script>
@endif
@if(Session::has('error'))
    <script>
        show_toastr('{{__('Error')}}', '{!! session('error') !!}', 'error');
    </script>
@endif
<script>
     
    </script>
    </body>
</html>
