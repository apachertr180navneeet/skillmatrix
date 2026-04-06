<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo e(route('super.admin.dashboard')); ?>" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">User Panel</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item <?php echo e(request()->is('user/dashboard') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('user.dashboard')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>
		
		<?php $__currentLoopData = [
			['route' => 'user.sop', 'text' => 'SOP', 'icon' => 'bx-file'],
			['route' => 'user.checklist', 'text' => 'Checklist', 'icon' => 'bx-list-check'],
			['route' => 'user.video', 'text' => 'Video', 'icon' => 'bx-video'],
			['route' => 'user.sop.results', 'text' => 'SOP Results', 'icon' => 'bx-bar-chart-square'],
			['route' => 'user.video.results', 'text' => 'Video Results', 'icon' => 'bx-bar-chart-alt-2'],
			['route' => 'user.checklist.results', 'text' => 'Checklist Results', 'icon' => 'bx-task'],
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
<?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/userlayouts/elements/left_sidebar.blade.php ENDPATH**/ ?>