<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/larkon/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jul 2025 16:44:58 GMT -->

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>P-Livraison | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"> --}}

    <!-- App favicon -->
    <link rel="shortcut icon" href="/v1/dash/assets/images/favicon.ico">

    <!-- Vendor css (Require in all Page) -->
    <link href="/v1/dash/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="/v1/dash/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="/v1/dash/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="/v1/dash/assets/js/config.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    {{-- @yield('seo') --}}
    @yield('style')
</head>

<body>

    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        @include('v1.dashboard.layouts.header.nav-bar')
        <!-- ========== Topbar End ========== -->

        <!-- ========== App Menu Start ========== -->
        @include('v1.dashboard.layouts.header.aside')
        <!-- ========== App Menu End ========== -->

        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div class="page-content">

            <!-- Start Container Fluid -->
            @yield('content')
            <!-- End Container Fluid -->

            <!-- ========== Footer Start ========== -->
            @include('v1.dashboard.layouts.footer._index')
            <!-- ========== Footer End ========== -->

        </div>
        <!-- ==================================================== -->
        <!-- End Page Content -->
        <!-- ==================================================== -->

    </div>
    <!-- END Wrapper -->

    {{-- Modals Layout --}}
    @include('v1.dashboard.layouts.modals._default')


    <!-- Vendor Javascript (Require in all Page) -->
    <script src="/v1/dash/assets/js/vendor.js"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="/v1/dash/assets/js/app.js"></script>

    <!-- Vector Map Js -->
    <script src="/v1/dash/assets/vendor/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="/v1/dash/assets/vendor/jsvectormap/maps/world-merc.js"></script>
    <script src="/v1/dash/assets/vendor/jsvectormap/maps/world.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://malsup.github.io/jquery.blockUI.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ '/appV2.js?v=' . time() }}"></script>


    @yield('script')


</body>


<!-- Mirrored from techzaa.in/larkon/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jul 2025 16:45:00 GMT -->

</html>
