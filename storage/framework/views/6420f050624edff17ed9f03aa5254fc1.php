
<?php $__env->startSection('content'); ?>
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            
                        </span>
                        <span class="app-brand-text demo text-body fw-bold"><?php echo e(config('app.name')); ?></span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Reset Password 🔒</h4>
                <p class="mb-4">Please Enter New Password</p>
                <form method="POST" action="<?php echo e(route('company.reset.password.post')); ?>" class="mb-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="token" value="<?php echo e($token); ?>">
                    <input type="hidden" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e($email); ?>">
                    <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback"><strong><?php echo e($errors->first('email')); ?></strong></span>
                    <?php endif; ?>
                    <div class="form-group position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                        <span class="position-absolute" style="top: 38px; right: 15px; cursor: pointer; z-index: 2;" onclick="togglePassword('password', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback"><strong><?php echo e($errors->first('password')); ?></strong></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-3 position-relative">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?>" name="password_confirmation" required>
                        <span class="position-absolute" style="top: 38px; right: 15px; cursor: pointer; z-index: 2;" onclick="togglePassword('password-confirm', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        <?php if($errors->has('password_confirmation')): ?>
                        <span class="invalid-feedback"><strong><?php echo e($errors->first('password_confirmation')); ?></strong></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary d-grid w-100"><?php echo e(__('Reset Password')); ?></button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="<?php echo e(route('company.login')); ?>" class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
        <!-- /Forgot Password -->
    </div>
</div> 
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
<script>
window.togglePassword = function(fieldId, el) {
    var input = document.getElementById(fieldId);
    var icon = el.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bx-hide');
        icon.classList.add('bx-show');
    } else {
        input.type = 'password';
        icon.classList.remove('bx-show');
        icon.classList.add('bx-hide');
    }
}
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.login_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/auth/reset-password.blade.php ENDPATH**/ ?>