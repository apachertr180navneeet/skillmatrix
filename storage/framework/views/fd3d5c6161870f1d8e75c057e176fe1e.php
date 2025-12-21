

<?php $__env->startSection('style'); ?>
<style>
    .dashboard-card {
        border: 2px solid #333;
        border-radius: 14px;
        padding: 22px 15px;
        text-align: center;
        height: 100%;
        background: #fff;
    }

    .dashboard-card h6 {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .dashboard-card p {
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }

    .dashboard-card .status {
        font-size: 13px;
        margin-top: 4px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row g-4">

        <!-- Row 1 -->
        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Admin Management</h6>
                <p>Total: 50</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total User Management</h6>
                <p>Total: 10</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Department Management</h6>
                <p class="status">Active: 60</p>
                <p class="status">In-Active: 40</p>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total SOP’s Management</h6>
                <p>Total: 50</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Check List Management</h6>
                <p>Total: 50</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Videos Management</h6>
                <p>Total: 50</p>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Q&A Management</h6>
                <p>Total: 50</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Result Management</h6>
                <p>Total: 50</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <h6>Total Subscription Plans</h6>
                <p>Total: 50</p>
            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/dashboard/index.blade.php ENDPATH**/ ?>