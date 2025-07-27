<!DOCTYPE html>
<html lang="fr">

<head>
    <title>@yield('title') - P-livraison</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="/v1/web/assets/images/plivraison.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/v1/web/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/animate.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/v1/web/assets/css/slick.css">
    <link rel="stylesheet" href="/v1/web/assets/css/chosen.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/v1/web/assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/lightbox.min.css">
    <link rel="stylesheet" href="/v1/web/assets/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="/v1/web/assets/css/jquery.scrollbar.min.css">
    <link rel="stylesheet" href="/v1/web/assets/css/mobile-menu.css">
    <link rel="stylesheet" href="/v1/web/assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="/v1/web/assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        .loader {
            /* border: 16px solid #f3f3f3; */
            /* border-radius: 50%; */
            /* border-top: 16px solid #3498db; */
            /* width: 120px; */
            /* height: 120px; */
            -webkit-animation: growShrink 1s linear ease-in-out;
            animation: growShrink 1s infinite ease-in-out;
            /* Apply the animation */
        }

        @-webkit-keyframes growShrink {
            0% {
                transform: scale(1);
                /* Initial size */
            }

            50% {
                transform: scale(1.5);
                /* Grow */
            }

            100% {
                transform: scale(1);
                /* Shrink back to original size */
            }
        }

        @keyframes growShrink {
            0% {
                transform: scale(1);
                /* Initial size */
            }

            50% {
                transform: scale(1.5);
                /* Grow */
            }

            100% {
                transform: scale(1);
                /* Shrink back to original size */
            }
        }
    </style>

    @yield('style')
    @yield('seo')

</head>

<body class="home">


    @include('v1.web.layouts.header._index')

    @yield('content')

    @include('v1.web.layouts.footer._index')

    <a href="#" class="backtotop">
        <i class="fa fa-angle-double-up"></i>
    </a>
    <script src="/v1/web/assets/js/jquery-1.12.4.min.js"></script>
    <script src="/v1/web/assets/js/jquery.plugin-countdown.min.js"></script>
    <script src="/v1/web/assets/js/jquery-countdown.min.js"></script>
    <script src="/v1/web/assets/js/bootstrap.min.js"></script>
    <script src="/v1/web/assets/js/owl.carousel.min.js"></script>
    <script src="/v1/web/assets/js/magnific-popup.min.js"></script>
    <script src="/v1/web/assets/js/isotope.min.js"></script>
    <script src="/v1/web/assets/js/jquery.scrollbar.min.js"></script>
    <script src="/v1/web/assets/js/jquery-ui.min.js"></script>
    <script src="/v1/web/assets/js/mobile-menu.js"></script>
    <script src="/v1/web/assets/js/chosen.min.js"></script>
    <script src="/v1/web/assets/js/slick.js"></script>
    <script src="/v1/web/assets/js/jquery.elevateZoom.min.js"></script>
    <script src="/v1/web/assets/js/jquery.actual.min.js"></script>
    <script src="/v1/web/assets/js/fancybox/source/jquery.fancybox.js"></script>
    <script src="/v1/web/assets/js/lightbox.min.js"></script>
    <script src="/v1/web/assets/js/owl.thumbs.min.js"></script>
    <script src="/v1/web/assets/js/jquery.scrollbar.min.js"></script>
    <script src="/v1/web/assets/js/frontend-plugin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://malsup.github.io/jquery.blockUI.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ '/appV2.js?v=' . time() }}"></script>

    @yield('script')

</body>

<!-- Mirrored from dreamingtheme.kiendaotac.com/html/gnash/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Jul 2025 14:20:22 GMT -->

</html>
