<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/ekopz-icon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pickadate/themes/default.date.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo"><a href="index.html"><b><img src="{{asset('assets/images/ekopz-admin.png')}}" alt="" style="width: 100px; margin-top: 10px;"> </b></a>
            </div>
            <div class="nav-control">
                <div class="hamburger"><span class="line"></span>  <span class="line"></span>  <span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            @include('templates.header')
        </div>
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            @include('templates.sidebar')
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    @yield('content-title')
                </div>
                @yield('content')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            @include('templates.footer')
        </div>
        <!--**********************************
            Footer end
        ***********************************-->


        <!--**********************************
            Right sidebar start
        ***********************************-->
        {{-- <div class="sidebar-right">
            <a class="sidebar-right-trigger" href="javascript:void(0)">
                <span><i class="mdi mdi-tune"></i></span>
            </a>
            @include('templates.right_sidebar')
        </div> --}}
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        js assets start
    ***********************************-->
    
    @include('templates.js')

    <!--**********************************
        js assets End 
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }} "></script>
    <script src="{{ asset('assets/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>

    <script src="{{ asset('assets/plugins/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/plugins/pickadate/picker.time.js')}}"></script>
    <script src="{{ asset('assets/plugins/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/editor-ck-init.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.js-example-placeholder-multiple').select2({
            placeholder: "Select a state"
        });
    </script>



</body>

</html>
