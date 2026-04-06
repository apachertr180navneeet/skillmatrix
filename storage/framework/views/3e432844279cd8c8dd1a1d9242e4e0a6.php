<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo e(route('super.admin.dashboard')); ?>" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">Super Admin</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item <?php echo e(request()->is('super.admin/dashboard') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('super.admin.dashboard')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-alt"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>
		
		<?php $__currentLoopData = [
			['route' => 'super.admin.company.index', 'text' => 'Party Management', 'icon' => 'bx-buildings'],
			['route' => 'super.admin.user.index', 'text' => 'User Management', 'icon' => 'bx-user'],
			['route' => 'super.admin.departments.index', 'text' => 'Department Management', 'icon' => 'bx-sitemap'],
			['route' => 'super.admin.sop.index', 'text' => 'SOP Management', 'icon' => 'bx-file'],
			['route' => 'super.admin.checklist.index', 'text' => 'Checklist Management', 'icon' => 'bx-list-check'],
			['route' => 'super.admin.video.index', 'text' => 'Video Management', 'icon' => 'bx-video'],
			['route' => 'super.admin.payment.index', 'text' => 'Payment Management', 'icon' => 'bx-credit-card'],
			['route' => 'super.admin.subscriptionPlan.index', 'text' => 'Subscription Management', 'icon' => 'bx-package'],
			['route' => 'super.admin.cms.index', 'text' => 'CMS Management', 'icon' => 'bx-book-content'],
			['route' => 'super.admin.setting.index', 'text' => 'Settings', 'icon' => 'bx-cog'],
		]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mastermenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="menu-item <?php echo e(request()->routeIs($mastermenu['route']) ? 'active' : ''); ?>">
				<a href="<?php echo e(route($mastermenu['route'])); ?>" class="menu-link">
					<i class="menu-icon tf-icons bx <?php echo e($mastermenu['icon']); ?>"></i>
					<div data-i18n="<?php echo e($mastermenu['text']); ?>"><?php echo e($mastermenu['text']); ?></div>
				</a>
			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</aside>
<?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/layouts/elements/left_sidebar.blade.php ENDPATH**/ ?>