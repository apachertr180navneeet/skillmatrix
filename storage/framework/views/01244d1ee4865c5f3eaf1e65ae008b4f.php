

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="text-center">View SOP</h5>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form>

                <div class="row mb-3">
                    <!-- Date -->
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($sop->created_at->format('d-m-Y')); ?>"
                               readonly>
                    </div>

                    <!-- SOP Title -->
                    <div class="col-md-3">
                        <label class="form-label">SOP Title</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($sop->title); ?>"
                               readonly>
                    </div>

                    <!-- Department -->
                    <div class="col-md-3">
                        <label class="form-label">Department</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($sop->department->department_name ?? '-'); ?>"
                               readonly>
                    </div>

                    <!-- Party / Company -->
                    <div class="col-md-3">
                        <label class="form-label">Party Name</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($sop->company->name ?? '-'); ?>"
                               readonly>
                    </div>
                </div>

                <!-- SOP Upload -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">SOP Upload</label>

                        <?php if($sop->sop_upload): ?>
                            <div class="border p-2 rounded bg-light">
                                <div class="mt-1">
                                    <a href="<?php echo e($sop->sop_upload); ?>"
                                    target="_blank"
                                    class="text-primary">
                                        Uploaded sop - view
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No SOP uploaded</p>
                        <?php endif; ?>
                    </div>

                    <!-- Button -->
                    <div class="col-md-6 d-flex align-items-end justify-content-end">
                        <a href="<?php echo e(route('super.admin.sop.index')); ?>"
                           class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/sop/show.blade.php ENDPATH**/ ?>