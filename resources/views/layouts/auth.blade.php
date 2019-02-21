<!DOCTYPE html>
<html lang="{{ config('app.locale') }}"><head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- COMMON TAGS -->
    <title> {!!isset($title) ? $title.' | Invoyce' : 'Invoyce'!!}</title>
    <!-- Search Engine -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('/images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('/images/favicons/manifest.json')}}">
    <link rel="mask-icon" href="{{url('/images/favicons/safari-pinned-tab.svg')}}" color="#28a956">
    <link rel="shortcut icon" href="{{url('/images/favicons/favicon.ico')}}">
    <meta name="msapplication-config" content="{{url('/images/favicons/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    
    {{ Html::style('/dashboard/assets/plugins/bootstrapv3/css/bootstrap.min.css')}}
    {{ Html::style('/dashboard/pages/css/pages.css')}}
    {{ Html::style('/dashboard/assets/css/custom.css')}}
    @yield('page_level_style')
		<!--[if lte IE 9]>
<link href="assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
	</head>
    <body class="fixed-header">
        @yield('content')
    </body>
    {{ Html::script('/assets/plugins/jquery/jquery-1.11.1.min.js')}}
    {{ Html::script('/assets/plugins/bootstrap/js/bootstrap.min.js')}}
    {{ Html::script('/pages/js/pages.frontend.js')}}
    {{ Html::script('/assets/js/custom.js')}}
    {{ Html::script('/js/sweetalert.min.js')}}
    <script type="text/javascript">
        function hideErrorDiv() {
            document.getElementById('errordiv').style.display = "none";
        }
    </script>
    @yield('page_level_script')
</html>