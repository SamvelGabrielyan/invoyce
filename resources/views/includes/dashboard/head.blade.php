<link rel="apple-touch-icon" sizes="180x180" href="{{URL::to('/')}}/dashboard/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{URL::to('/')}}/dashboard/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('/')}}/dashboard/favicons/favicon-16x16.png">
<link rel="manifest" href="{{URL::to('/')}}/dashboard/favicons/manifest.json">
<link rel="mask-icon" href="{{URL::to('/')}}/dashboard/favicons/safari-pinned-tab.svg" color="#28a956">
<link rel="shortcut icon" href="{{URL::to('/')}}/dashboard/favicons/favicon.ico">
<meta name="msapplication-config" content="{{URL::to('/')}}/dashboard/favicons/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<link href="{{URL::to('/')}}/dashboard/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=url('')?>/dashboard/assets/plugins/font-awesome/css/font-awesome.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=url('')?>/dashboard/pages/css/pages-icons.css?5" rel="stylesheet" type="text/css">

<link href="{{URL::to('/')}}/dashboard/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
<link href="{{URL::to('/')}}/dashboard/assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" media="screen" />
<link href="{{URL::to('/')}}/dashboard/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
<link class="main-stylesheet" href="{{URL::to('/')}}/dashboard/pages/css/pages.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/dashboard/assets/css/custom.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/dashboard/assets/css/animate.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="<?=url('')?>/dashboard/assets/plugins/font-awesome/css/font-awesome.css?5" rel="stylesheet" type="text/css" />
<!-- FONT AWESOME 5 -->
<script type="text/javascript" src="{{URL::to('/')}}/assets/js/fontawesome-all.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/v4-shims.js"></script>
<script>var site_url = '{!!url('')!!}';</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112733761-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-112733761-1');
</script>

<!--[if lte IE 9]>
<link href="{{URL::to('/')}}/dashboard/assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->

<script>
jQuery(function(){
	var get_html=jQuery(".pgn.push-on-sidebar-open.pgn-bar").html();
	
	if(get_html==null){		
		jQuery("body.fixed-header .header").addClass("mtop");
	} 
	jQuery(document).on("click","button.close.hidemessage", function(){	
		jQuery("body.fixed-header .header").addClass("mtop");
	});
});
</script>

<style>

	.error_strick{
		color: red;
	}


	h5.text-success {
		color: #000 !important;
	}
	img.invoice-logo{
		max-height: 140px !important;
		border: 1px solid #f4f4f4 !important;
	}

	.copyright p{ margin-left: 3px !important;}
	.sidebar-visible .menu-pin .copyright p{ margin-left: 210px !important;}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: #444;
		line-height: 38px !important;
	}
	.mb___10{
		margin-bottom: 15px !important;
	}
	.menu-pin .copyright { margin-left: 0px !important;}
	.pad_mobile_left_div{
		padding:0px;
	}


	@media only screen and (max-width: 767px){
		.menu-pin .copyright { margin-left: 0px !important;}
		.pad_mobile_left{
			padding-left: 20px !important;
		}

		.pad_mobile_left_div{
			padding-left: 16px !important;
		}

	}


	@media screen and (max-width: 600px) {
		.btn {
			font-size: 13px !important;
			line-height: 16px !important;
			padding-left: 10px !important;
			padding-right:10px !important;
			margin-bottom:5px !important;
		}
		.pad_left_15{ padding-left:15px !important;}
	}

	.page-sidebar .sidebar-menu .menu-items > li ul.sub-menu > li.active2 > .icon-thumbnail {
		color: #fff !important;
	}
	.page-sidebar .sidebar-menu .menu-items > li ul.sub-menu > li.active2> a {
		color: #fff !important;
	}


</style>
