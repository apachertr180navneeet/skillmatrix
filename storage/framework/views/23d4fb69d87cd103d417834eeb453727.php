

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

    <!-- Welcome -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Welcome <?php echo e(Auth::user()->full_name); ?>!</h5>

        <div class="d-flex gap-2">
            <input type="text" class="form-control" placeholder="Search here...">
            <button class="btn btn-primary px-4">Search</button>
        </div>
    </div>

    <div class="overview-title">Overview</div>

    <div class="row g-4">

        <!-- User -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bx bx-user"></i></div>
                <div class="stat-content">
                    <h6>Total Exam Applied</h6>
                    <p>18</p>
                </div>
            </div>
        </div>

        <!-- Department -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bx bx-buildings"></i></div>
                <div class="stat-content">
                    <h6>Total SOP Check</h6>
                    <p>18</p>
                </div>
            </div>
        </div>

        <!-- Department -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bx bx-buildings"></i></div>
                <div class="stat-content">
                    <h6>Total Checklist</h6>
                    <p>18</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bx bx-buildings"></i></div>
                <div class="stat-content">
                    <h6>Total Video Check</h6>
                    <p>18</p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/web/dashboard/index.blade.php ENDPATH**/ ?>