<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('img/logo-uns.png')}}" />

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- App css -->
    <link href={{ asset('assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('assets/css/icons.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('assets/css/theme.min.css') }} rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <link href={{ asset('../plugins/datatables/dataTables.bootstrap4.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('../plugins/datatables/responsive.bootstrap4.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('../plugins/datatables/buttons.bootstrap4.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('../plugins/datatables/select.bootstrap4.css') }} rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @hasanyrole('user|ormawa|pembina')
    <link rel="stylesheet" href="{{ asset('assets/css/custom-sidebar.css') }}">
    @endhasanyrole

    @yield('head')

</head>



<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            @include('component.header')
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        @hasanyrole('user|ormawa|pembina')
        <div class="vertical-menu" style="background-color: #fff;">
        @endhasanyrole
        @hasanyrole('admin|super-admin|stakeholder')
        <div class="vertical-menu" >
        @endhasanyrole
            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="javascript:void(0);" class="logo">
                        @hasanyrole('admin|super-admin|stakeholder')
                        <span>
                            DIRMAWA UNS
                        </span>
                        @endhasanyrole
                        @hasanyrole('user|ormawa|pembina')
                        <span style="color: #000">
                            ORMAWA UNS
                        </span>
                        @endhasanyrole
                    </a>
                </div>

                <!--- Sidemenu -->
                @include('component.sidebar')
                <!-- Sidebar -->
            </div>
        </div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    @yield('content')

                    @include('sweetalert::alert')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('component.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src={{ asset('assets/js/jquery.min.js') }}></script>
    <script src={{ asset('assets/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('assets/js/metismenu.min.js') }}></script>
    <script src={{ asset('assets/js/waves.js') }}></script>
    <script src={{ asset('assets/js/simplebar.min.js') }}></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Morris Js-->
    <script src={{ asset('../plugins/morris-js/morris.min.js') }}></script>
    <!-- Raphael Js-->
    <script src={{ asset('../plugins/raphael/raphael.min.js') }}></script>
    <script src={{ asset('../plugins/chart-js/chart.min.js') }}></script>

    <!-- Morris Custom Js-->
    <script src={{ asset('assets/pages/dashboard-demo.js') }}></script>

    <!-- App js -->
    <script src={{ asset('assets/js/theme.js') }}></script>

    <script src={{ asset('../plugins/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/dataTables.bootstrap4.js') }}></script>
    <script src={{ asset('../plugins/datatables/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/responsive.bootstrap4.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/dataTables.buttons.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/buttons.bootstrap4.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/buttons.html5.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/buttons.flash.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/buttons.print.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/dataTables.keyTable.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/dataTables.select.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/pdfmake.min.js') }}></script>
    <script src={{ asset('../plugins/datatables/vfs_fonts.js') }}></script>

    @yield('scripts')

</body>

</html>