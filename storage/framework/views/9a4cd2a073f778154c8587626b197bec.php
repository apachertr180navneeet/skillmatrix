<style>
	span.app-brand-text.demo.menu-text.fw-bold.ms-2.text-capitalize {
		font-size: 20px;
	}
</style>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo e(route('company.dashboard')); ?>" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">
				<?php echo e(auth()->user()->company->copmany_name ?? 'Admin'); ?>

			</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">

		
		<li class="menu-item <?php echo e(request()->routeIs('company.dashboard') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('company.dashboard')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		
		<li class="menu-item <?php echo e(request()->routeIs('company.subscription') ? 'active' : ''); ?>">
			<a href="<?php echo e(route('company.subscription')); ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-credit-card"></i>
				<div>Subscription</div>
			</a>
		</li>

		
		<?php if($hasActiveSubscription): ?>

			<?php $__currentLoopData = [
				['route' => 'company.departments.index', 'text' => 'Departments', 'icon' => 'bx-sitemap'],
				['route' => 'company.user.index', 'text' => 'User Management', 'icon' => 'bx-user'],
				['route' => 'company.sop.index', 'text' => 'SOP Management', 'icon' => 'bx-file'],
				['route' => 'company.checklist.index', 'text' => 'Checklist Management', 'icon' => 'bx-list-check'],
				['route' => 'company.video.index', 'text' => 'Video Management', 'icon' => 'bx-video'],
				['route' => 'company.sop.result.index', 'text' => 'SOP Results', 'icon' => 'bx-bar-chart-square'],
				['route' => 'company.video.result.index', 'text' => 'Video Results', 'icon' => 'bx-bar-chart-alt-2'],
				['route' => 'company.checklist.result.index', 'text' => 'Checklist Results', 'icon' => 'bx-task'],
			]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<li class="menu-item <?php echo e(request()->routeIs($menu['route']) ? 'active' : ''); ?>">
					<a href="<?php echo e(route($menu['route'])); ?>" class="menu-link">
						<i class="menu-icon tf-icons bx <?php echo e($menu['icon']); ?>"></i>
						<div><?php echo e($menu['text']); ?></div>
					</a>
				</li>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php endif; ?>

	</ul>
</aside>
<?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/layouts/elements/left_sidebar.blade.php ENDPATH**/ ?>