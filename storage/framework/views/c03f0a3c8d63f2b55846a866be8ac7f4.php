 
<?php $__env->startSection('content'); ?> 

<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                        <span class="app-brand-text demo text-body fw-bolder text-capitalize">Skill Matrix</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Welcome to Skill Matrix! 👋</h4>
                <p class="mb-4">Please sign-in to your admin account</p>
                <form action="<?php echo e(route('super.admin.login.post')); ?>" id="" class="mb-3" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email or Username</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email or username" required />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <a href="<?php echo e(route('super.admin.forget.password.get')); ?>"><small>Forgot Password?</small></a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <!-- <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" />
                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                        </div>
                    </div> -->
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.login_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/auth/login.blade.php ENDPATH**/ ?>