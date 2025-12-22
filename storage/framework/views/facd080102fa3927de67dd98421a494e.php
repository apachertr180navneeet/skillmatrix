<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <title><?php echo e(config('app.name')); ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/web/img/favicon.png')); ?>">
        <link href="<?php echo e(asset('assets/web/css/styles.css?v=1.1')); ?>" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <?php echo $__env->yieldContent('style'); ?>
    </head>

    <body>
        <div class="preloader"></div>
        <div id="main-wrapper">
            <?php echo $__env->make('web.layouts.elements.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('web.layouts.elements.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <script src="<?php echo e(asset('assets/web/js/jquery.min.js')); ?>"></script> 
        <script src="<?php echo e(asset('assets/web/js/bootstrap.min.js')); ?>"></script> 
        <?php echo $__env->yieldContent('script'); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel\skillmatrixl10\resources\views/web/layouts/app.blade.php ENDPATH**/ ?>