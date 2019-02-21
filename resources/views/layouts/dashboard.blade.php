<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- COMMON TAGS -->
		<title>{{isset($title) ? $title : ' | Invoyce'}}</title>
		<!-- Search Engine -->
        @include('includes.dashboard.head')
	 	@yield('page_level_style')
		<!--[if lte IE 9]>
{{ Html::style('assets/plugins/codrops-dialogFx/dialog.ie.css')}}
<![endif]-->
	</head>
    <body class="fixed-header menu-pin">
    	<!-- BEGIN SIDEBPANEL-->
		@include('includes.dashboard.nav')
		<!-- END SIDEBPANEL-->
		<!-- START PAGE-CONTAINER -->
        <div class="page-container">
    	@include('includes.dashboard.top-bar')
	    @yield('content')
        </div>
        @include('includes.dashboard.search')
    </body>
    {{ Html::script('/dashboard/assets/plugins/pace/pace.min.js')}}
    <!--<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script> -->
    {{ Html::script('/dashboard/assets/plugins/modernizr.custom.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery-ui/jquery-ui.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/bootstrapv3/js/bootstrap.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery/jquery-easy.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery-unveil/jquery.unveil.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery-bez/jquery.bez.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery-ios-list/jquery.ioslist.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery-actual/jquery.actual.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/select2/js/select2.full.min.js')}}
    {{ Html::script('/dashboard/assets/plugins/classie/classie.js')}}
    {{ Html::script('/dashboard/assets/plugins/switchery/js/switchery.min.js')}}
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    {{ Html::script('/dashboard/pages/js/pages.min.js')}}
    <!-- END CORE TEMPLATE JS -->

    <!-- BEGIN PAGE LEVEL JS -->
    {{ Html::script('/dashboard/assets/js/notifications.js')}}
    <!--<script src="{{URL::to('/')}}/dashboard/assets/js/form_elements.js" type="text/javascript"></script> -->
    {{ Html::script('/dashboard/assets/js/scripts.js')}}
    {{ Html::script('/dashboard/assets/js/jquery.fitvids.js')}}
    {{ Html::script('/dashboard/js/custom.js')}}
    @yield('page_level_script')
 
</html>
