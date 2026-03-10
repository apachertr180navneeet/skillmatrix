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
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>
		
		<?php $__currentLoopData = [
			['route' => 'super.admin.company.index', 'text' => 'Party Management'],
			['route' => 'super.admin.user.index', 'text' => 'User Management'],
			['route' => 'super.admin.departments.index', 'text' => 'Department Management'],
			['route' => 'super.admin.sop.index', 'text' => 'SOP Management'],
			['route' => 'super.admin.checklist.index', 'text' => 'Checklist Management'],
			['route' => 'super.admin.video.index', 'text' => 'Video Management'],
			['route' => 'super.admin.payment.index', 'text' => 'Payment Management'],
			['route' => 'super.admin.subscriptionPlan.index', 'text' => 'Subscription Management'],
			['route' => 'super.admin.cms.index', 'text' => 'CMS Management'],
			['route' => 'super.admin.setting.index', 'text' => 'Settings'],
		]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mastermenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="menu-item <?php echo e(request()->routeIs($mastermenu['route']) ? 'active' : ''); ?>">
				<a href="<?php echo e(route($mastermenu['route'])); ?>" class="menu-link">
					<i class="menu-icon tf-icons bx bx-home-circle"></i>
					<div data-i18n="<?php echo e($mastermenu['text']); ?>"><?php echo e($mastermenu['text']); ?></div>
				</a>
			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</aside><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/layouts/elements/left_sidebar.blade.php ENDPATH**/ ?>