<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo e(route('super.admin.dashboard')); ?>" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">Admin</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item <?php echo e(request()->is('admin/dashboard') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('admin.dashboard')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>
		
		<?php $__currentLoopData = [
			['route' => 'admin.subscription', 'text' => 'Subscription'],
			['route' => 'admin.departments.index', 'text' => 'Departments'],
			['route' => 'admin.user.index', 'text' => 'User Management'],
			['route' => 'admin.sop.index', 'text' => 'SOP Management'],
			['route' => 'admin.checklist.index', 'text' => 'Checklist Management'],
			['route' => 'admin.video.index', 'text' => 'Video Management'],
		]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mastermenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="menu-item <?php echo e(request()->routeIs($mastermenu['route']) ? 'active' : ''); ?>">
				<a href="<?php echo e(route($mastermenu['route'])); ?>" class="menu-link">
					<i class="menu-icon tf-icons bx bx-home-circle"></i>
					<div data-i18n="<?php echo e($mastermenu['text']); ?>"><?php echo e($mastermenu['text']); ?></div>
				</a>
			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</aside><?php /**PATH C:\xampp\htdocs\laravel\skillmatrixl10\resources\views/admin/layouts/elements/left_sidebar.blade.php ENDPATH**/ ?>