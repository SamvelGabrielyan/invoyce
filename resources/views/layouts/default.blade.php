<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- COMMON TAGS -->
		<title>{{$title or ''}}Invoyce</title>
		<meta name="description" content="Invoicing cannot be simpler with the solution provided by Invoyce. Focus on what you do best and let our proven system handle your online billing. Try it today for FREE!"/>
		<!-- Search Engine -->

		<meta name="image" content="{{url('/assets/images/Cover.png')}}">
		<!-- Schema.org for Google -->
		<meta itemprop="name" content="Invoicing Simplified | Invoyce">
		<meta itemprop="description" content="Invoicing cannot be simpler with the solution provided by Invoyce. Focus on what you do best and let our proven system handle your online billing. Try it today for FREE!">
		<meta itemprop="image" content="{{url('/assets/images/Cover.png')}}">
		<!-- Twitter -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="Invoicing Simplified | Invoyce">
		<meta name="twitter:description" content="Invoicing cannot be simpler with the solution provided by Invoyce. Focus on what you do best and let our proven system handle your online billing. Try it today for FREE!">
		<meta name="twitter:site" content="invoyceme">
		<meta name="twitter:creator" content="invoyceme">
		<meta name="twitter:image:src" content="{{url('/assets/images/Cover.png')}}">
		<!-- Open Graph general (Facebook, Pinterest & Google+) -->
		<meta property="og:type" content="website">
		<meta property="og:title" content="Invoicing Simplified | Invoyce">
		<meta property="og:description" content="Invoicing cannot be simpler with the solution provided by Invoyce. Focus on what you do best and let our proven system handle your online billing. Try it today for FREE!">
		<meta property="og:url" content="{{url('')}}">
		<meta property="og:image" content="{{url('/assets/images/Cover.png')}}">


		@include('includes.head')

		@yield('page_level_style')
		<!--[if lte IE 9]>
<link href="assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
	</head>
	<body class="pace-white">
		<!-- BEGIN HEADER -->
		<nav class="header bg-header transparent-light " data-pages="header" data-pages-header="autoresize" data-pages-resize-class="dark">
			@include('includes.nav')
		</nav>
		<!-- END HEADER -->
		@yield('content')
		@include('includes.footer')
	</body>
</html>
