<div class="container relative">
	<!-- BEGIN LEFT CONTENT -->
	<div class="pull-left">
		<!-- .header-inner Allows to vertically Align elements to the Center-->
		<div class="header-inner">
			<!-- BEGIN LOGO -->
			<a href="{{url('/')}}">
				<img src="{{url('/assets/images/logo-white.png')}}" width="200" data-src-retina="{{url('/assets/images/logo-white.png')}}" alt="Invoyce">
			</a>
		</div>
	</div>
	<!-- BEGIN HEADER TOGGLE FOR MOBILE & TABLET -->
	<div class="pull-right">
		<div class="header-inner">
			<div class="visible-sm-inline visible-xs-inline menu-toggler pull-right p-l-10" data-pages="header-toggle" data-pages-element="#header">
				<div class="one"></div>
				<div class="two"></div>
				<div class="three"></div>
			</div>
		</div>
	</div>
	<!-- END HEADER TOGGLE FOR MOBILE & TABLET -->
	<!-- BEGIN RIGHT CONTENT -->
	<div class="pull-right menu-content clearfix" data-pages="menu-content" data-pages-direction="slideRight" id="header">
		<!-- BEGIN HEADER CLOSE TOGGLE FOR MOBILE -->
		<div class="pull-right">
			<a href="#" class="text-black link padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10" data-pages="header-toggle" data-pages-element="#header">
				<i class=" pg-close_line"></i>
			</a>
		</div>
		<!-- END HEADER CLOSE TOGGLE FOR MOBILE -->
		<!-- BEGIN MENU ITEMS -->
		<div class="header-inner">
			<ul class="menu">
				<li>
					<a href="{{url('/')}}" data-text="Home" class="active">Home </a>
				</li>

				<li>
					<a href="{{url('#about')}}" data-text="About" class="active">About </a>
				</li>
				<li>
					<a href="{{url('#features')}}" data-text="Features" class="active">Features </a>
				</li>
				<li>
					<a href="{{url('#testimonials')}}" data-text="Testimonials" class="active">Testimonials </a>
				</li>
				<li>
					<a href="{{url('#pricing')}}" data-text="Pricing" class="active">Pricing </a>
				</li>
				<li>
					<a href="{{url('#contact')}}" data-text="Contact" class="active">Contact </a>
				</li>
                @if(Auth::check())
                	<li>
                        <a class="btn btn-bordered fs-12 btn-white hidden-sm hidden-xs" href="{{route('dashboard')}}" >Dashboard</a>
                        <a class="btn btn-bordered fs-12 btn-black  font-montserrat fs-12 all-caps pull-bottom visible-sm visible-xs buy-now sm-static sm-m-l-20 sm-m-r-20" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                	<li>
                        <a class="btn btn-bordered fs-12 btn-white hidden-sm hidden-xs" href="{{route('logout')}}" >Logout</a>
                        <a class="btn btn-bordered fs-12 btn-black  font-montserrat fs-12 all-caps pull-bottom visible-sm visible-xs buy-now sm-static sm-m-l-20 sm-m-r-20" href="{{route('logout')}}">Logout</a>
                    </li>
                @else
                    <li>
                        <a href="{{route('login')}}" data-text="Contact" class="active">Login </a>
                    </li>
                    <li>
                        <a class="btn btn-bordered fs-12 btn-white hidden-sm hidden-xs" href="{{route('register')}}" data-text="Buy now">Join Free</a>
                        <a class="btn btn-bordered fs-12 btn-black  font-montserrat fs-12 all-caps pull-bottom visible-sm visible-xs buy-now sm-static sm-m-l-20 sm-m-r-20" href="{{route('register')}}">Join Free</a>
                    </li>
                @endif
				
			</ul>
		</div>
		<!-- END MENU ITEMS -->
	</div>
</div>