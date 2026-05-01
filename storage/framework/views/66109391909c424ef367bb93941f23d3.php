 
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
                <h4 class="mb-2">Forgot Password? 🔒</h4>
                <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
                <?php endif; ?>
                <form action="<?php echo e(route('company.forget.password.post')); ?>" method="POST" class="mb-3">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">E-Mail Address</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email" value="<?php echo e(old('email')); ?>" autofocus required="">
                        <?php if($errors->has('email')): ?>
                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary d-grid w-100">Send Password Reset Link</button>
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
<?php echo $__env->make('super_admin.layouts.login_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/auth/forgot-password.blade.php ENDPATH**/ ?>