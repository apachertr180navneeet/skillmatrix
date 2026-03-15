<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{route('super.admin.dashboard')}}" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">User Panel</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item {{ request()->is('user/dashboard') ? 'active' : ''}}">
			<a href="{{route('user.dashboard')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>
		
		@foreach([
			['route' => 'user.sop', 'text' => 'SOP', 'icon' => 'bx-file'],
			['route' => 'user.checklist', 'text' => 'Checklist', 'icon' => 'bx-list-check'],
			['route' => 'user.video', 'text' => 'Video', 'icon' => 'bx-video'],
			['route' => 'user.sop.results', 'text' => 'SOP Results', 'icon' => 'bx-bar-chart-square'],
			['route' => 'user.video.results', 'text' => 'Video Results', 'icon' => 'bx-bar-chart-alt-2'],
			['route' => 'user.checklist.results', 'text' => 'Checklist Results', 'icon' => 'bx-task'],
		] as $mastermenu)
			<li class="menu-item {{ request()->routeIs($mastermenu['route']) ? 'active' : '' }}">
				<a href="{{ route($mastermenu['route']) }}" class="menu-link">
					<i class="menu-icon tf-icons bx {{ $mastermenu['icon'] }}"></i>
					<div data-i18n="{{ $mastermenu['text'] }}">{{ $mastermenu['text'] }}</div>
				</a>
			</li>
		@endforeach
	</ul>
</aside>
