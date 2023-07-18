<!doctype html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo-sm.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link href="{{ URL::asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    {{-- <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />


    <!-- jquery.vectormap css -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <link href="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet">
</head>

<body data-topbar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ url('/') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm"
                                    height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light"
                                    height="20">
                            </span>
                        </a>
                        <a href="{{ url('/') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light"
                                    height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light"
                                    height="40">
                                &nbsp;
                                <img src="{{ asset('backend/assets/images/image.png') }}" alt="logo-light"
                                    height="40">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="ri-search-line"></span>
                        </div>
                    </form>
                </div>
                <div class="d-flex">
                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="mb-3 m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <div style="color:white;top:25px;position:relative"><span id="datetime"></span></div>
                    </div>
                    <script>
                        function updateDateTime() {
                            const now = new Date();
                            const formattedDate = now.toLocaleDateString();
                            const formattedTime = now.toLocaleTimeString([], {
                                hour12: false
                            });
                            document.getElementById("datetime").innerHTML = `${formattedDate} ${formattedTime}`;
                        }

                        // Update the datetime every second
                        setInterval(updateDateTime, 1000);
                    </script>
                    <style>
                        .noti-dot {
                            position: relative;
                        }

                        .noti-count {
                            position: absolute;
                            top: -6px;
                            right: -4px;
                            padding: 2px 4px;
                            border-radius: 50%;
                            background-color: #ff0000;
                            color: #ffffff;
                            font-size: 9px;
                            line-height: 1;
                        }
                    </style>
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-toggle="fullscreen">
                            <i class="ri-fullscreen-line"></i>
                        </button>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            <span class="noti-dot">
                                <span class="noti-count">{{ $notifications->total() }}</span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">Notifications</h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('notifications') }}" class="small">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                @foreach ($notifications as $notification)
                                    <a href="#" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-notification-3-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">{{ $notification->data['title'] }}</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">{{ $notification->data['message'] }}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                        {{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="p-2 border-top">
                                <div class="d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center"
                                        href="{{ route('notifications') }}">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .btnNotif {
                            display: flex;
                            align-items: center;
                        }

                        .avatar-with-initial {
                            width: 30px;
                            height: 30px;
                            border-radius: 50%;
                            background-color: #cccccc;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-right: 10px;
                        }

                        .avatar-initial {
                            font-size: 18px;
                            font-weight: bold;
                            color: #ffffff;
                        }

                        .user-details {
                            display: flex;
                            flex-direction: column;
                        }

                        .user-name {
                            margin-top: 3px;
                        }
                    </style>
                    <?php
                    $userName = Auth::user()->name;
                    $avatarUrl = 'assets/images/users/avatar-1.jpg';
                    $firstLetter = strtoupper(substr($userName, 0, 1));
                    ?>

                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect btnNotif"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar-with-initial">
                                <div class="avatar-initial">
                                    <?php echo $firstLetter; ?>
                                </div>
                            </div>
                            <span class="user-name d-none d-xl-inline-block me-2">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i>
                                Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i
                                    class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>




                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ url('/home') }}" class="waves-effect">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- Publisher Navbar --}}
                        @if (Auth::user()->hasRole('publisher'))
                            <li>
                            <li><a href="{{ route('PublisherCafe') }}"><i class="fas fa-coffee">
                                    </i><span>Cafes</span></a></li>
                            <li><a href="{{ route('PublisherAds') }}"><i class="fas fa-list"> </i>Ads List</a></li>
                            <a class="btn btn-primary ms-5" style="color: white" href="{{ route('NewAd') }}">Create
                                new ad <span> <i class="fas fa-plus" style="color: white;"></i></span></a></li>

                            <li>


                            </li>
                            <li><a href="#"><i class="fas fa-money-bill-alt"></i>Transactions</a></li>
                            </li>
                            </li>
                            <li><a href="{{ route('notifications') }}"><i class="fas fa-bell"></i>Notifications</a>
                            </li>
                            </li>
                        @endif

                        {{-- Admin Navbar --}}
                        @if (Auth::user()->hasRole('admin'))
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-user-alt"></i>
                                    <span>Users Managment</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('publisher') }}">Publishers</a></li>
                                    <li><a href="{{ route('subscriber') }}">Subscribers</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-tasks"></i>
                                    <span>Roles & Permissions</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li> <a href="{{ route('admin.roles.index') }}">Roles</a>
                                    </li>
                                    <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-ad"></i>
                                    <span>Publicities</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('pendingAd') }}">Pending</a></li>
                                    <li><a href="{{ route('approvedAd') }}">Approved</a></li>
                                    <li><a href="{{ route('History') }}">Rejected</a></li>

                                </ul>
                            </li>
                            <li><a href="{{ route('admin.categories') }}"><i
                                        class="fas fa-list"></i><span>Categoriers</span></a></li>
                            </li>
                            <li><a href="{{ route('notifications') }}"><i
                                        class="fas fa-bell"></i><span>Notifications</span></a></li>
                            </li>

                            <li><a href="#"><i class="fas fa-money-bill-alt"></i><span>Payment Track</span></a>
                            </li>
                            </li>
                        @endif
                        {{-- subscriber Navbar --}}
                        @if (Auth::user()->hasRole('subscriber'))
                            <li>

                            <li> <a href="{{ route('subscriber.ads') }}" class="waves-effect"> <i
                                        class="fas fa-tasks"></i><span>Ads
                                        List</span></a>
                            </li>

                            </li>

                            <li>

                            <li><a href="{{ route('notifications') }}"><i
                                        class="fas fa-bell"></i><span>Notifications</span></a></li>
                            </li>

                            </li>
                            <li>
                                <a href="{{ route('ashtrays.show') }}"> <i class="fas fa-question-circle"></i>
                                    <span>Support</span></a>
                                </a>

                            </li>
                            <li>
                            <li><a href="#"><i class="fas fa-money-bill-alt"></i><span>Payment
                                        tracking</span></a></li>
                            </li>
                        @endif


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('admin')
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © CODACT.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-sm-light"
                                    height="30">

                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>


    <!-- apexcharts -->
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>

    <script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/assets/js/pages/form-advanced.init.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>

</body>

</html>
