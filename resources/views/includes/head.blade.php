<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

<link rel="apple-touch-icon" sizes="180x180" href="{{url('/images/favicons/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url('/images/favicons/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url('/images/favicons/favicon-16x16.png')}}">
<link rel="manifest" href="{{url('/images/favicons/manifest.json')}}">
<link rel="mask-icon" href="{{url('/images/favicons/safari-pinned-tab.svg')}}" color="#28a956">
<link rel="shortcut icon" href="{{url('/images/favicons/favicon.ico')}}">
<meta name="msapplication-config" content="{{url('/images/favicons/browserconfig.xml')}}">
<meta name="theme-color" content="#ffffff">

<!-- BEGIN PLUGINS -->
{{ Html::style('/assets/plugins/bootstrap/css/bootstrap.min.css')}}
<!-- END PLUGINS -->
<!-- BEGIN PAGES CSS -->
{{ Html::style('/pages/css/pages.css')}}
{{ Html::style('/pages/css/custom.css')}}
{{ Html::style('/pages/css/custom.css')}}
{{ Html::style('/css/sweetalert.css')}}
{{ Html::style('dashboard/assets/plugins/font-awesome/css/font-awesome.css')}}
<!-- BEGIN PAGES CSS -->

<!--[if lte IE 9]>
<link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript">
window.onload = function()
{
	// fix for windows 8
	if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
		document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112733761-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-112733761-1');
</script>

<!-- JON TEST AGAIN -->