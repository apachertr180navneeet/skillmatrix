<!-- Preloader -->
        <div class="preloader style3" style="opacity: 0; display: none">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- /End Preloader -->

        <!-- Start Header Area -->
        <header class="header style3">
            <div class="navbar-area sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand logo" href="<?php echo e(route('home')); ?>">
    
                                    <!-- White Logo (default) -->
                                    <img class="primary-logo"
                                        src="<?php echo e(asset('assets/web/assets/images/logo/precure-skill3-white.png')); ?>"
                                        alt="Logo">

                                    <!-- Dark Logo (scroll ke baad) -->
                                    <img class="alt-logo"
                                        src="<?php echo e(asset('assets/web/assets/images/logo/precure-skill3.png')); ?>"
                                        alt="Logo">

                                </a>
                                <button
                                    class="navbar-toggler"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent"
                                    aria-controls="navbarSupportedContent"
                                    aria-expanded="false"
                                    aria-label="Toggle navigation"
                                >
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul id="nav" class="navbar-nav me-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="<?php echo e(route('home')); ?>">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('about.us')); ?>">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('service')); ?>">Services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('plan')); ?>">Plans</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- navbar collapse -->
                                <div class="button">
                                    <a href="<?php echo e(route('user.login')); ?>" class="btn">Get Started</a>
                                </div>
                            </nav>
                            <!-- navbar -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- navbar area -->
        </header>
        <!-- End Header Area --><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/layouts/elements/header.blade.php ENDPATH**/ ?>