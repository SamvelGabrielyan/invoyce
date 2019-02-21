<nav class="page-sidebar" data-pages="sidebar">
	<!-- BEGIN SIDEBAR MENU HEADER-->
	<div class="sidebar-header">
		<a href="/dashboard/index"><img src="{{url('/assets/images/logo-white.png')}}" alt="logo" class="brand" data-src="{{url('/assets/images/logo-white.png')}}" data-src-retina="{{url('/assets/images/logo-white.png')}}" width="148"></a>
		<div class="sidebar-header-controls">
			<button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fal fa-compress-alt"></i></button>
		</div>
	</div>
	<!-- END SIDEBAR MENU HEADER-->
	<!-- START SIDEBAR MENU -->
	<div class="sidebar-menu">
		<!-- BEGIN SIDEBAR MENU ITEMS-->
		<ul class="menu-items">
			<li class="m-t-30">
				<a href="{{route('dashboard')}}" class="detailed">
					<span class="title">Dashboard</span>
				</a>
				<span class="icon-thumbnail
							 {{ Request::is('dashboard/index') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard') ? 'bg-success' : '' }}
							 {{ Request::is('/') ? 'bg-success' : '' }}
							 "><i class="pg-home"></i></span>
			</li>
			<li class="{{ Request::is('dashboard/invoices/choose') ? 'active2' : '' }}">
				<a href="{{URL::to('/')}}/dashboard/invoices/choose"><span class="title">Create New Invoice</span></a>
				<span class="icon-thumbnail {{ Request::is('dashboard/invoices/choose') ? 'bg-success' : '' }}
							 
							 " ><i class="far fa-plus"></i></span>
			</li>
			<li class="
					   {{ Request::is('dashboard/invoices/recurring-invoices') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/saved-invoices') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/invoices') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/scheduled-invoice') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/subscription-invoice') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/update-scheduled-invoice') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/update-subscription-invoice') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/update-standard-invoice') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/standard-invoices-list') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/scheduled-invoices-list') ? 'open active' : '' }}
					   {{ Request::is('dashboard/invoices/subscription-invoices-list') ? 'open active' : '' }}
					   ">
				<a href="javascript:;">
					<span class="title">Manage Invoices</span>
					<span class=" arrow"></span></a>
				<span class="icon-thumbnail

							 {{ Request::is('dashboard/invoices/recurring-invoices') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/saved-invoices') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/invoices') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/scheduled-invoice') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/subscription-invoice') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/update-scheduled-invoice') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/update-subscription-invoice') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/update-standard-invoice') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/standard-invoices-list') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/scheduled-invoices-list') ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/invoices/subscription-invoices-list') ? 'bg-success' : '' }}


							 "><i class="pg-form"></i></span>
				<ul class="sub-menu">
					<li class="

							   {{ Request::is('dashboard/invoices/standard-invoice') ? 'active2' : '' }}
							   {{ Request::is('dashboard/invoices/scheduled-invoice') ? 'active2' : '' }}
							   {{ Request::is('dashboard/invoices/subscription-invoice') ? 'active2' : '' }}
							   {{ Request::is('dashboard/invoices/update-scheduled-invoice') ? 'active2' : '' }}
							   {{ Request::is('dashboard/invoices/update-subscription-invoice') ? 'active2' : '' }}
							   {{ Request::is('dashboard/invoices/update-standard-invoice') ? 'active2' : '' }}

							   ">

					</li>
					<li class="
							   {{ Request::is('dashboard/invoices/standard-invoices-list') ? 'active2' : '' }}">
						<a href="{{URL::to('/')}}/dashboard/invoices/standard-invoices-list">Manage Standard</a>

						<span class="icon-thumbnail">st</span>
					</li>

					<li class="
							   {{ Request::is('dashboard/invoices/scheduled-invoices-list') ? 'active2' : '' }}">
						<a href="{{URL::to('/')}}/dashboard/invoices/scheduled-invoices-list">Manage Scheduled</a>

						<span class="icon-thumbnail">sc</span>
					</li>

					<li class="
							   {{ Request::is('dashboard/invoices/subscription-invoices-list') ? 'active2' : '' }}">
						<a href="{{URL::to('/')}}/dashboard/invoices/subscription-invoices-list">Manage Subscriptions</a>

						<span class="icon-thumbnail">sb</span>
					</li>

					<li class="{{ Request::is('dashboard/invoices/saved-invoices') ? 'active2' : '' }}">
						<a href="{{URL::to('/')}}/dashboard/invoices/saved-invoices">Saved Invoices</a>
						<span class="icon-thumbnail">sv</span>
					</li>

				</ul>
			</li>
			<li class="{{ Request::is('dashboard/reports/reports') ? 'active2' : '' }}">
				<a href="{{URL::to('/')}}/dashboard/reports/reports"><span class="title">Reports</span></a>
				<span class="icon-thumbnail {{ Request::is('dashboard/reports/reports') ? 'bg-success' : '' }}" ><i class="pg-charts"></i></span>
			</li>
			<li class="
					   {{ Request::is('dashboard/account/account' ) ? 'open active' : '' }}
					   {{ Request::is('dashboard/account/password' ) ? 'open active' : '' }}
					   ">
				<a href="javascript:;">
					<span class="title">Account</span>
					<span class=" arrow"></span></a>
				<span class="icon-thumbnail
							 {{ Request::is('dashboard/account/account' ) ? 'bg-success' : '' }}
							 {{ Request::is('dashboard/account/password' ) ? 'bg-success' : '' }}

							 "><i class="pg-layouts"></i></span>
				<ul class="sub-menu">
					<li class="{{ Request::is('dashboard/account/account') ? 'active2' : '' }}">
						<a href="{{URL::to('/')}}/dashboard/account/account">Account Settings</a>
						<span class="icon-thumbnail">as</span>
					</li>
					<li class="">
						<a href="{{route('billing')}}">Billing</a>
						<span class="icon-thumbnail">bi</span>
					</li>
					<li class="{{ Request::is('dashboard/account/password') ? 'active2' : '' }}">
						<a href="{{URL::to('/')}}/dashboard/account/password">Password</a>
						<span class="icon-thumbnail">pw</span>
					</li>

				</ul>
			</li>
			<li class="">
				<a href="javascript:;">
					<span class="title">Apps</span>
					<span class=" arrow"></span></a>
				<span class="icon-thumbnail"><i class="fas fa-plug"></i></span>
				<ul class="sub-menu">
					<li class="">
						<a href="#">Coming Soon...</a>
						<span class="icon-thumbnail">cs</span>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="javascript:void(0);" onclick="olark('api.box.expand')"><span class="title">Support</span></a>
				<span class="icon-thumbnail"><i class="fa fa-question" aria-hidden="true"></i></span>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<!-- END SIDEBAR MENU -->
</nav>