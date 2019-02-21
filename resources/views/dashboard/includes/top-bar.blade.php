<div class="header ">
	<!-- START MOBILE CONTROLS -->
	<div class="container-fluid relative">
		<!-- LEFT SIDE -->
		<div class="pull-left full-height visible-sm visible-xs">
			<!-- START ACTION BAR -->
			<div class="header-inner">
				<a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
					<span class="icon-set menu-hambuger"></span>
				</a>
			</div>
			<!-- END ACTION BAR -->
		</div>
		<div class="pull-center hidden-md hidden-lg">
			<div class="header-inner">
				<div class="brand inline">
					<img src="{{URL::to('/')}}/dashboard/assets/img/logo.png" alt="logo" data-src="{{URL::to('/')}}/dashboard/assets/img/logo.png" data-src-retina="{{URL::to('/')}}/dashboard/assets/img/logo_2x.png" width="78" height="22">

				</div>
			</div>
		</div>
		<!-- RIGHT SIDE -->
		<div class="pull-right full-height visible-sm visible-xs">
			<!-- START ACTION BAR -->
			<!--<div class="header-inner">
<a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
<span class="icon-set menu-hambuger-plus"></span>
</a>
</div>-->
			<!-- END ACTION BAR -->
		</div>
	</div>

	<!-- END MOBILE CONTROLS -->
	<div class=" pull-left sm-table hidden-xs hidden-sm">
		<div class="header-inner">
			<div class="brand inline">

				<img src="{{URL::to('/')}}/dashboard/assets/img/logo.png" alt="logo" data-src="{{URL::to('/')}}/dashboard/assets/img/logo.png" data-src-retina="{{URL::to('/')}}/dashboard/assets/img/logo_2x.png" width="100">

			</div>
			<a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span class="bold">search for an invoice</span>...</a> </div>
	</div>
	<div class=" pull-right">
		<!-- START User Info-->
		<div class="visible-lg visible-md ">

			<div class="dropdown pull-right">
				<button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="" style="margin-top:20px; font-weight: 600; font-size: 13px; height: 30px; text-transform: uppercase; ">
						{{ Session::get('company') }}  &nbsp;&nbsp;<i class="fal fa-chevron-down"></i>

					</div>
				</button>
				<ul class="dropdown-menu profile-dropdown" role="menu">

					<li>
						<a href="{{URL::to('/')}}/dashboard/account/account"><i class="pg-settings_small"></i> Settings</a>
					</li>
					<li>
						<a href="javascript:void(0);" onclick="olark('api.box.expand')"><i class="pg-signals"></i> Help</a>
					</li>
					<li class="bg-master-lighter">
						<a href="{{URL::to('/')}}/dashboard/logout" class="clearfix">
							<span class="pull-left">Logout</span>
							<span class="pull-right"><i class="pg-power"></i></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- END User Info-->

	</div>
	<?php
	$user_ids=Session::get('user_id');
	$user_cus=DB::table('users')->where('id', '=', $user_ids)->first();
	$cur_date=date("Y-m-d");
	$date1=date_create($cur_date);
	$date2=date_create($user_cus->exp_date);
	$diff=date_diff($date1,$date2);
	$date= $diff->format("%R%a");
	$date2=str_replace("+","",$date);
	if($user_cus->subscription_id==''){?>
	<div class="clearfix"></div>
	<div class="container">
		<div class="pgn-wrapper" data-position="bottom">
			<div class="pgn push-on-sidebar-open pgn-bar">
				<div class="alert alert-danger">
					<div class="container text-center">
						<?php if($date2>0){ ?>
						<div class="removered">
							<span><strong><?php echo $date2; ?> Days Remaining</strong> on your unlimited FREE trial. You can subscribe at any time before your trial ends - <a class="hidemessage" href="<?=url('')?>/dashboard/account/billing/<?php echo base64_encode ($user_ids); ?>"> <strong>SUBSCRIBE TODAY!</strong> </a></span>
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						</div>
						<?php } else {?>
						<span><strong>Please subscribe to continue using Invoyce.</strong> <a href="<?=url('')?>/dashboard/account/billing/<?php echo base64_encode ($user_ids); ?>"> <strong>SUBSCRIBE TODAY!</strong> </a></span>
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>


						<?php }?>


					</div>
				</div>
			</div>
		</div>

	</div>
	<?php } ?>
</div>