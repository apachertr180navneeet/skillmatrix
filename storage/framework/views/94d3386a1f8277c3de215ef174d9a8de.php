<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo e(route('admin.dashboard')); ?>" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">Admin</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">

		
		<li class="menu-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('admin.dashboard')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		
		<li class="menu-item <?php echo e(request()->routeIs('admin.subscription') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('admin.subscription')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-credit-card"></i>
				<div>Subscription</div>
			</a>
		</li>

		
		<?php if($hasActiveSubscription): ?>

			<?php $__currentLoopData = [
				['route' => 'admin.departments.index', 'text' => 'Departments'],
				['route' => 'admin.user.index', 'text' => 'User Management'],
				['route' => 'admin.sop.index', 'text' => 'SOP Management'],
				['route' => 'admin.checklist.index', 'text' => 'Checklist Management'],
				['route' => 'admin.video.index', 'text' => 'Video Management'],
				['route' => 'admin.sop.result.index', 'text' => 'SOP Results'],
				['route' => 'admin.video.result.index', 'text' => 'Video Results'],
			]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<li class="menu-item <?php echo e(request()->routeIs($menu['route']) ? 'active' : ''); ?>">
					<a href="<?php echo e(route($menu['route'])); ?>" class="menu-link">
						<i class="menu-icon tf-icons bx bx-layer"></i>
						<div><?php echo e($menu['text']); ?></div>
					</a>
				</li>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php endif; ?>

	</ul>
</aside>
<?php /**PATH C:\xampp\htdocs\laravel_project\precureskill\resources\views/admin/layouts/elements/left_sidebar.blade.php ENDPATH**/ ?>