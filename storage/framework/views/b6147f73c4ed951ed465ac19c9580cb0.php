<!DOCTYPE html>
<html lang="en" ng-app="<?php echo e(config('app.name')); ?>" lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <title>Skill Matrix</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="description" content="" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <meta name="ws_url" content="<?php echo e(env('WS_URL')); ?>">
        <meta name="user_id" content="<?php echo e(Auth::id()); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/admin/img/favicon/favicon.ico')); ?>" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/fonts/boxicons.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/css/core.css')); ?>" class="template-customizer-core-css" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/css/theme-default.css')); ?>" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/demo.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrapDataTable.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/libs/apex-charts/apex-charts.css')); ?>" />
        <script src="<?php echo e(asset('assets/admin/vendor/js/helpers.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/config.js')); ?>"></script>
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/sweet-alert.css')); ?>" />
        <?php echo $__env->yieldContent('style'); ?>
        <style>
            
        </style>
        
    </head>
    <body>
       <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php echo $__env->make('admin.layouts.elements.left_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="layout-page">
                    <?php echo $__env->make('admin.layouts.elements.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="content-wrapper">
                        <?php echo $__env->yieldContent('content'); ?>
                        <?php echo $__env->make('admin.layouts.elements.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="content-backdrop fade"></div>
                    </div>
                    <?php echo $__env->make('admin.layouts.elements.right_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
        
                <script src="<?php echo e(asset('assets/admin/vendor/libs/jquery/jquery.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/vendor/libs/popper/popper.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/vendor/js/bootstrap.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/vendor/js/menu.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/js/main.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/js/dataTable.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/js/bootstrapDataTable.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/js/dashboards-analytics.js')); ?>"></script>
                <script src="<?php echo e(asset('assets/admin/js/moment.min.js')); ?>"></script>
                <script async defer src="https://buttons.github.io/buttons.js"></script>
                <?php echo $__env->yieldContent('script'); ?>
                <?php echo $__env->make('admin.layouts.elements.sweet_alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </body>
</html><?php /**PATH C:\xampp\htdocs\laravel_project\precureskill\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>