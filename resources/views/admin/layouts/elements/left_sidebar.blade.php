<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{ route('admin.dashboard') }}" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">Admin</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">

		{{-- DASHBOARD (Always visible) --}}
		<li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		{{-- SUBSCRIPTION (Always visible) --}}
		<li class="menu-item {{ request()->routeIs('admin.subscription') ? 'active' : '' }}">
			<a href="{{ route('admin.subscription') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-credit-card"></i>
				<div>Subscription</div>
			</a>
		</li>

		{{-- SHOW ONLY AFTER SUBSCRIPTION --}}
		@if($hasActiveSubscription)

			@foreach([
				['route' => 'admin.departments.index', 'text' => 'Departments', 'icon' => 'bx-sitemap'],
				['route' => 'admin.user.index', 'text' => 'User Management', 'icon' => 'bx-user'],
				['route' => 'admin.sop.index', 'text' => 'SOP Management', 'icon' => 'bx-file'],
				['route' => 'admin.checklist.index', 'text' => 'Checklist Management', 'icon' => 'bx-list-check'],
				['route' => 'admin.video.index', 'text' => 'Video Management', 'icon' => 'bx-video'],
				['route' => 'admin.sop.result.index', 'text' => 'SOP Results', 'icon' => 'bx-bar-chart-square'],
				['route' => 'admin.video.result.index', 'text' => 'Video Results', 'icon' => 'bx-bar-chart-alt-2'],
				['route' => 'admin.checklist.result.index', 'text' => 'Checklist Results', 'icon' => 'bx-task'],
			] as $menu)

				<li class="menu-item {{ request()->routeIs($menu['route']) ? 'active' : '' }}">
					<a href="{{ route($menu['route']) }}" class="menu-link">
						<i class="menu-icon tf-icons bx {{ $menu['icon'] }}"></i>
						<div>{{ $menu['text'] }}</div>
					</a>
				</li>

			@endforeach

		@endif

	</ul>
</aside>
