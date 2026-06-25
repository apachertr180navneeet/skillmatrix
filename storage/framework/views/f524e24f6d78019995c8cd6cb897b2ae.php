

<?php $__env->startSection('content'); ?>

<!-- Start Hero Area -->
<section id="hero-area" class="hero-area style3">
    <div class="hero-inner hero-inner2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 co-12">
                    <div class="home-slider">
                        <div class="hero-text hero-text2">
                            <h1 class="wow fadeInUp" data-wow-delay=".5s">
                                Our Plans
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Hero Area -->

<!-- Start Pricing Table Area -->
<section class="pricing-table style3 section">
    <div class="container">

        <!-- Section Title -->
        <div class="row">
            <div class="col-12">
                <div class="section-title style3">
                    <span class="wow fadeInDown" data-wow-delay=".2s">
                        Pricing Plan
                    </span>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">
                        Choose Your Plan
                    </h2>
                    <p class="mb-1" style="color: red; font-weight: bold;">After Login you can buy subscription</p>
                    <p class="wow fadeInUp" data-wow-delay=".6s">
                        Select the training solution that best fits your organization's needs and start building a
                        skilled, efficient workforce.
                    </p>
                </div>
            </div>
        </div>

        <!-- Plans -->
        <div class="row g-4"> 
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-12">
                    
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp h-100" data-wow-delay=".2s">

                        <!-- Table Head -->
                        <div class="table-head text-center">
                            <div class="price">
                                <p class="amount">₹<?php echo e(number_format($plan->amount, 2)); ?></p>
                            </div>
                            <div class="title">
                                <h4><?php echo e($plan->plan_name); ?></h4>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-center">
                            <?php echo e($plan->description ?? '-'); ?>

                        </p>

                        <!-- Duration -->
                        <div class="duration text-center mt-2">
                            <small><?php echo e($plan->duration); ?> Days</small>
                        </div>

                        <!-- Button -->
                        <div class="button text-center mt-3">
                            <a class="btn" href="<?php echo e(auth()->check() ? route('company.subscription') : route('company.login')); ?>">
                                Choose Plan <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                    <!-- End Single Table-->

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>
<!--/ End Pricing Table Area -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/web/home/plan.blade.php ENDPATH**/ ?>