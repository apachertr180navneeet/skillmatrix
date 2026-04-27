<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <title><?php echo e(config('app.name')); ?></title>

        <!-- Web Font -->
        <link href="<?php echo e(asset('assets/web/assets/css/css2')); ?>" rel="stylesheet" />
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/web/assets/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/web/assets/css/LineIcons.2.0.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/web/assets/css/animate.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/web/assets/css/tiny-slider.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/web/assets/css/glightbox.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/web/assets/css/main.css')); ?>">
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
        <?php echo $__env->yieldContent('style'); ?>
    </head>

    <body>
        <div class="preloader"></div>
        <div id="main-wrapper">
            <?php echo $__env->make('web.layouts.elements.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('web.layouts.elements.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <script src="<?php echo e(asset('assets/web/assets/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/count-up.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/wow.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/tiny-slider.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/glightbox.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/imagesloaded.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/isotope.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/web/assets/js/main.js')); ?>"></script>
        <script type="text/javascript">
            //========= glightbox
            GLightbox({
                href: "https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM",
                type: "video",
                source: "youtube", //vimeo, youtube or local
                width: 900,
                autoplayVideos: true,
            });

            //======== Testimonial Slider
            var slider = new tns({
                container: ".testimonial-slider",
                slideBy: "page",
                autoplay: false,
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
        </script>
        <?php echo $__env->yieldContent('script'); ?>
    </body>
</html>
<?php /**PATH /opt/bitnami/apache/htdocs/resources/views/web/layouts/app.blade.php ENDPATH**/ ?>