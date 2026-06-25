

<?php $__env->startSection('style'); ?>
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .sop-card {
        background: #fff;
        border-radius: 14px;
        padding: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        height: 100%;
    }

    .sop-preview {
        height: 130px;
        background: #2578c9;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .sop-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sop-title {
        font-size: 13px;
        font-weight: 600;
        margin: 0;
    }

    .qa-btn {
        background: #ff0000;
        color: #fff;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 6px;
        border: none;
    }

    .qa-btn:hover {
        background: #d90000;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="page-header">
        <h5>SOP</h5>
        <div>
            <button class="btn btn-primary me-2">Sort</button>
            <button class="btn btn-primary">View</button>
        </div>
    </div>

    <!-- SOP LIST -->
    <div class="row g-4">

        <?php $__empty_1 = true; $__currentLoopData = $sops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <a href="<?php echo e(route('user.sop.view', Crypt::encryptString($sop->id))); ?>" target="_blank" class="text-decoration-none text-dark">
                    <div class="sop-card">

                        <!-- Preview -->
                        <div class="sop-preview"></div>

                        <!-- Footer -->
                        <div class="sop-footer">
                            <p class="sop-title">
                                <?php echo e($sop->title ?? 'SOP'); ?>

                            </p>

                            <a href="<?php echo e(route('user.sop.qa', $sop->id)); ?>"
                            class="qa-btn text-decoration-none">
                                Q&amp;A
                            </a>
                        </div>

                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No SOPs found for your department.
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/sop/index.blade.php ENDPATH**/ ?>