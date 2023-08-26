<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ config('global.siteURL') }}{{ config('global.iconLogin') }}/favicon.ico?"
        type="image/ico" />

    <title>@yield('page-title') | {{ config('global.siteName') }}</title>

    <!-- Bootstrap -->

    <link href="{{ config('global.vendor') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">
    <!-- Font Awesome -->
    {{--
    <link href="{{ config('global.vendor') }}/font-awesome/css/font-awesome.min.css" rel="stylesheet"> --}}
    <link href="/public/assets/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/45299906ed.js" crossorigin="anonymous"></script>
    <!-- NProgress -->
    <link href="{{ config('global.vendor') }}/nprogress/nprogress.css" rel="stylesheet">
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ config('global.vendor') }}/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ config('global.vendor') }}/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"
        rel="stylesheet">
    <!-- select2 -->
    <link rel="stylesheet" type="text/css"
        href="{{ config('global.siteURL') }}{{ config('global.vendorLogin') }}/select2/select2.min.css">

    <!-- JQVMap -->
    <link href="{{ config('global.vendor') }}/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ config('global.vendor') }}/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="{{ config('global.vendor') }}/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"
        rel="stylesheet">
    <link rel="stylesheet" href="/assets/upload/css/jquery.fileupload.css" />
    <link rel="stylesheet" href="/assets/upload/css/jquery.fileupload-ui.css" />
    <!-- Custom Theme Style -->
    <link href="{{ config('global.build') }}/css/custom.min.css?v={{ rand() }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <link href="/css/for-notification.css" rel="stylesheet">
    <link href="https://kenwheeler.github.io/slick/slick/slick.css" rel="stylesheet">
    <link href="https://kenwheeler.github.io/slick/slick/slick-theme.css" rel="stylesheet">
    <link href="{{ config('global.build') }}/css/calendar.css?v=1.03" rel="stylesheet">

</head>

<body class="nav-md">

    <div class="container body">

        <div class="main_container">

            <div class="col-md-3 left_col">

                <div class="left_col scroll-view">

                    <div class="navbar nav_title border-0 text-center">

                        <a href="/dashboard" class="site_title">
                            {{ config('global.siteName') }}
                            {{-- <img class="h-100" src="{{ config('global.imgLogin') }}/logo.png"> --}}
                        </a>

                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->

                    <div class="profile clearfix">

                        <div class="profile_pic">

                            <img src="/uploads/dummy.png" alt="Profile" class="img-circle profile_img">

                        </div>

                        <div class="profile_info">

                            <span>Welcome,</span>

                            <h2>{{ Auth::user()->name }}</h2>

                        </div>

                    </div>

                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('layouts.sidebar')
                    <!-- /sidebar menu -->

                </div>

            </div>

            <!-- top navigation -->

            <div class="top_nav">

                <div class="nav_menu">

                    <div class="nav toggle">

                        <a id="menu_toggle"><i class="fas fa-bars"></i></a>

                    </div>

                    <nav class="nav navbar-nav">

                        <ul class=" navbar-right">

                            <li class="nav-item dropdown open" style="padding-left: 15px;">

                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">

                                    <img src="/uploads/dummy.png" alt="">{{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="/profile"> Profile</a>

                                    <a class="dropdown-item" href="/change-password">Change Passowrd</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="fas fa-sign-out pull-right"></i> Log Out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>


                            {{-- <li role="presentation" class="nav-item dropdown open">

                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">

                                    <i class="fas fa-bell text-warning"></i>

                                    <span class="badge bg-green">10</span>

                                </a>

                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">

                                    <li class="nav-item">

                                        <form class="d-none" id="notificationRead" action="/notifications/1/read"
                                            method="POST">

                                            <input type="hidden" name="url" value="#">

                                            @csrf

                                        </form>

                                        <a class="dropdown-item" onclick="document.forms['notificationRead'].submit()">

                                            <span class="image"><img
                                                    src="{{ config('global.images') }}/dummy_teacher.jpg"
                                                    alt="Profile Image" /></span>

                                            <span>

                                                <span>Notification Title</span>

                                                <span class="time">{{$notification->created_at->diffForHumans()}}</span>
                                                <span class="time">2 min ago</span>

                                            </span>

                                            <span class="message">Lorem ipsum dolor sit amet consectetur</span>

                                        </a>

                                    </li>
                                </ul>

                            </li> --}}


                        </ul>

                    </nav>

                </div>

            </div>

            <!-- top navigation -->

            @yield('content')
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Powered by <a href="#">Find Tech</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->

    <script src="{{ config('global.vendor') }}/jquery/dist/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <!-- Bootstrap -->
    <script src="{{ config('global.vendor') }}/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- NProgress -->
    <script src="{{ config('global.vendor') }}/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{ config('global.vendor') }}/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ config('global.vendor') }}/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ config('global.vendor') }}/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{ config('global.vendor') }}/iCheck/icheck.min.js"></script>
    <!-- select2 -->
    <script src="{{ config('global.vendorLogin') }}/select2/select2.min.js"></script>
    <!-- Skycons -->
    <script src="{{ config('global.vendor') }}/skycons/skycons.js"></script>
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!-- Flot -->
    <script src="{{ config('global.vendor') }}/Flot/jquery.flot.js"></script>
    <script src="{{ config('global.vendor') }}/Flot/jquery.flot.pie.js"></script>
    <script src="{{ config('global.vendor') }}/Flot/jquery.flot.time.js"></script>
    <script src="{{ config('global.vendor') }}/Flot/jquery.flot.stack.js"></script>
    <script src="{{ config('global.vendor') }}/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="{{ config('global.vendor') }}/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="{{ config('global.vendor') }}/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{ config('global.vendor') }}/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="{{ config('global.vendor') }}/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="{{ config('global.vendor') }}/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{ config('global.vendor') }}/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{ config('global.vendor') }}/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ config('global.vendor') }}/moment/min/moment.min.js"></script>
    <script src="{{ config('global.vendor') }}/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="{{ config('global.vendor') }}/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js">
    </script>
    <!-- Custom Theme Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ config('global.build') }}/js/custom.min.js?"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js'></script>

    <script src="/assets/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/js/table-datatable.js"></script>
    <script src="/js/custom.js?v={{ rand() }}"></script>
    @yield('script')
</body>

</html>
