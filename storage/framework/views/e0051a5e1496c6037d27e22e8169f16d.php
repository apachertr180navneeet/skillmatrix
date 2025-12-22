

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="text-center">View Checklist</h5>
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
                               value="<?php echo e(\Carbon\Carbon::parse($checklist->created_at)->format('d-m-Y')); ?>"
                               readonly>
                    </div>

                    <!-- Checklist Title -->
                    <div class="col-md-3">
                        <label class="form-label">Checklist Title</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($checklist->title); ?>"
                               readonly>
                    </div>

                    <!-- Department -->
                    <div class="col-md-3">
                        <label class="form-label">Department</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($checklist->department->department_name ?? '-'); ?>"
                               readonly>
                    </div>

                    <!-- Company -->
                    <div class="col-md-3">
                        <label class="form-label">Company</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($checklist->company->name ?? '-'); ?>"
                               readonly>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" readonly><?php echo e($checklist->description ?? '-'); ?></textarea>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Uploaded File</label>

                        <?php if($checklist->file): ?>
                            <div class="border p-2 rounded bg-light">
                                <a href="<?php echo e($checklist->file); ?>"
                                   target="_blank"
                                   class="text-primary">
                                    View Uploaded File
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No file uploaded</p>
                        <?php endif; ?>
                    </div>

                    <!-- Back Button -->
                    <div class="col-md-6 d-flex align-items-end justify-content-end">
                        <a href="<?php echo e(route('super.admin.checklist.index')); ?>"
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

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/checklist/show.blade.php ENDPATH**/ ?>