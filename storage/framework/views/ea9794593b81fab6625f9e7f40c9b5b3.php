

<?php $__env->startSection('style'); ?>
<style>
    .overview-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: #1e78d6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-content h6 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .stat-content p {
        margin: 0;
        font-size: 13px;
        color: #555;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid flex-grow-1 container-p-y">
    <h5 class="fw-bold mb-4">Subscription Plan</h5>
    <div class="row g-4">

        <!-- BASIC PLAN -->
        <?php $__currentLoopData = $subcriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="plan-card text-center">
                    <h4 class="plan-title"><?php echo e($subscription->plan_name); ?></h4>
                    <p class="text-muted mb-1">Start at</p>
                    <h2 class="plan-price">Rs.<?php echo e($subscription->amount); ?></h2>
                    <p class="text-muted">/ Month</p>
                <button class="btn btn-dark w-100 mb-3">Buy Now</button>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/subscription/index.blade.php ENDPATH**/ ?>