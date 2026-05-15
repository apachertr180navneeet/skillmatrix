<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name') }}</title>

        <!-- Web Font -->
        <link href="{{ asset('assets/web/assets/css/css2') }}" rel="stylesheet" />
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('assets/web/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/web/assets/css/LineIcons.2.0.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/web/assets/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/web/assets/css/tiny-slider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/web/assets/css/glightbox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/web/assets/css/main.css') }}">
        <style>
            /* Default: white logo show */
            .primary-logo {
                display: block;
            }

            .alt-logo {
                display: none;
            }

            /* Scroll ke baad (sticky header) */
            .sticky .primary-logo {
                display: none;
            }

            .sticky .alt-logo {
                display: block;
            }

            .navbar-brand img {
                height: 40px;
                width: auto;
            }

            .navbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .navbar-nav {
                margin-left: auto;
                align-items: center;
                gap: 25px;
            }
        </style>
        @yield('style')
    </head>

    <body>
        <div class="preloader"></div>
        <div id="main-wrapper">
            @include('web.layouts.elements.header')
            @yield('content')
            @include('web.layouts.elements.footer')
        </div>

        <script src="{{ asset('assets/web/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/count-up.min.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/tiny-slider.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/imagesloaded.min.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/isotope.min.js') }}"></script>
        <script src="{{ asset('assets/web/assets/js/main.js') }}"></script>
        <script type="text/javascript">
            try {
                //========= glightbox
                GLightbox({
                    href: "https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM",
                    type: "video",
                    source: "youtube", //vimeo, youtube or local
                    width: 900,
                    autoplayVideos: true,
                });
            } catch (error) {
                console.error("GLightbox initialization failed:", error);
            }

            try {
                //======== Testimonial Slider
                if (document.querySelector(".testimonial-slider")) {
                    var slider = tns({
                        container: ".testimonial-slider",
                        slideBy: "page",
                        autoplay: true,
                        autoplayButtonOutput: false,
                        mouseDrag: true,
                        gutter: 0,
                        items: 1,
                        nav: true,
                        controls: false,
                        controlsText: ['<i class="lni lni-arrow-left prev"></i>', '<i class="lni lni-arrow-right next"></i>'],
                        responsive: {
                            1200: {
                                items: 1,
                            },
                            992: {
                                items: 1,
                            },
                            0: {
                                items: 1,
                            },
                        },
                    });
                }
            } catch (error) {
                console.error("Testimonial Slider initialization failed:", error);
            }
        </script>
        @yield('script')
    </body>
</html>
