<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{route('super.admin.dashboard')}}" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize">Skill Matrix</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item {{ request()->is('super.admin/dashboard') ? 'active' : ''}}">
			<a href="{{route('super.admin.dashboard')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>
		
		@foreach([
			['route' => 'super.admin.company.index', 'text' => 'Party Management'],
			['route' => 'super.admin.user.index', 'text' => 'User Management'],
			['route' => 'super.admin.sop.index', 'text' => 'SOP Management'],
			['route' => 'super.admin.checklist.index', 'text' => 'Checklist Management'],
			['route' => 'super.admin.video.index', 'text' => 'Video Management'],
			['route' => 'super.admin.payment.index', 'text' => 'Payment Management'],
			['route' => 'super.admin.subscriptionPlan.index', 'text' => 'Subscription Management'],
			['route' => 'super.admin.cms.index', 'text' => 'CMS Management'],
		] as $mastermenu)
			<li class="menu-item {{ request()->routeIs($mastermenu['route']) ? 'active' : '' }}">
				<a href="{{ route($mastermenu['route']) }}" class="menu-link">
					<i class="menu-icon tf-icons bx bx-home-circle"></i>
					<div data-i18n="{{ $mastermenu['text'] }}">{{ $mastermenu['text'] }}</div>
				</a>
			</li>
		@endforeach
	</ul>
</aside>