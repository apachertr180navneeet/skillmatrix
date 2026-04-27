

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Payments</span> Settings
            </h5>
        </div>
    </div>

    <!-- Settings Form -->
    <div class="card">
        <div class="card-body">

            <form action="<?php echo e(route('super.admin.setting.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <!-- Admin Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Admin Email <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               name="admin_email"
                               class="form-control"
                               placeholder="Enter admin email"
                               value="<?php echo e(old('admin_email', $setting->admin_email ?? '')); ?>"
                               required>
                        <?php $__errorArgs = ['admin_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Payment Gateway Key -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Payment Gateway Key <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="payment_gatway_key"
                               class="form-control"
                               placeholder="Enter payment gateway key"
                               value="<?php echo e(old('payment_gatway_key', $setting->payment_gatway_key ?? '')); ?>"
                               required>
                        <?php $__errorArgs = ['payment_gatway_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        Save Settings
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/setting/index.blade.php ENDPATH**/ ?>