<style>
	span.app-brand-text.demo.menu-text.fw-bold.ms-2.text-capitalize {
		font-size: 20px;
	}
</style>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{ route('company.dashboard') }}" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">
				{{ auth()->user()->company->copmany_name ?? 'Admin' }}
			</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">

		{{-- DASHBOARD (Always visible) --}}
		<li class="menu-item {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
			<a href="{{ route('company.dashboard') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		@foreach([
			['route' => 'company.departments.index', 'text' => 'Departments', 'icon' => 'bx-sitemap'],
				['route' => 'company.user.index', 'text' => 'User Management', 'icon' => 'bx-user'],
				['route' => 'company.sop.index', 'text' => 'SOP Management', 'icon' => 'bx-file'],
				['route' => 'company.checklist.index', 'text' => 'Checklist Management', 'icon' => 'bx-list-check'],
				['route' => 'company.video.index', 'text' => 'Video Management', 'icon' => 'bx-video'],
				['route' => 'company.sop.result.index', 'text' => 'SOP Results', 'icon' => 'bx-bar-chart-square'],
				['route' => 'company.video.result.index', 'text' => 'Video Results', 'icon' => 'bx-bar-chart-alt-2'],
				['route' => 'company.checklist.result.index', 'text' => 'Checklist Results', 'icon' => 'bx-task'],
			] as $menu)

				<li class="menu-item {{ request()->routeIs($menu['route']) ? 'active' : '' }}">
					<a href="{{ route($menu['route']) }}" class="menu-link">
						<i class="menu-icon tf-icons bx {{ $menu['icon'] }}"></i>
						<div>{{ $menu['text'] }}</div>
					</a>
				</li>

			@endforeach

	</ul>
</aside>
