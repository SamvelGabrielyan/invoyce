		<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
				<meta charset="utf-8" />
				<title>Payment Settings | Invoyce</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
				<meta content="" name="description" />

				@include('includes.dashboard.head')
			</head>
			<body class="fixed-header menu-pin">
				<!-- BEGIN SIDEBPANEL-->
				@include('includes.dashboard.nav')
				<!-- END SIDEBPANEL-->
				<!-- START PAGE-CONTAINER -->
				<div class="page-container ">
					<!-- START HEADER -->
					@include('includes.dashboard.top-bar')
					<!-- END HEADER -->
					<!-- START PAGE CONTENT WRAPPER -->
					<div class="page-content-wrapper ">
						<!-- START PAGE CONTENT -->
						<div class="content ">
							<!-- START JUMBOTRON -->
							<div class="jumbotron" data-pages="parallax">
								<div class="container-fluid container-fixed-lg">
									<div class="inner">
										<!-- START BREADCRUMB -->
										<ul class="breadcrumb">
											<li>
												<a href="#" >Account</a>
											</li>
											<li>
												<a href="#" class="active">Update Your Stripe setting </a>
											</li>
										</ul>
										<!-- END BREADCRUMB -->
										<div class="container-md-height m-b-20">
											<div class="row row-md-height">

												<div class="col-lg-4 col-md-height col-md-6 col-top">
													<!-- START PANEL -->
													<div class="panel panel-transparent">
														<div class="panel-heading">
															<div class="panel-title">Updating Your Stripe Setting
															</div>
														</div>
														<div class="panel-body">
															<h3>How it Works</h3>
															<p>Views are pre-made view ports which comes in handy for HTML5 mobile hybrid apps, These elements help in the navigation of your app with a touch of some cool pre-built animations, see the demo below
															</p>
															<br>

														</div>
													</div>
													<!-- END PANEL -->
												</div>
												<div class="col-lg-8 col-md-6 col-md-height col-middle ">
													<!-- START PANEL -->
													<div class="full-height">
														<!-- START PANEL -->
														<div class="panel panel-default">
															<div class="panel-heading">
																<div class="panel-title">
																	Payment
																</div>
															</div>
															<div class="panel-body">
																<h5>
																	Update your stripe info below
																</h5>
																<form method="POST" role="form" id="form-profile" enctype="multipart/form-data" action="updatePayment">
																	<input type="hidden" name="_token" value="{{ csrf_token() }}">
																	<div class="row">
																		<div class="col-sm-6">
																			<div class="form-group form-group-default required">
																				<label>YOUR API LOGIN ID</label>
																				<input type="text" class="form-control" name="api_login_id"  value="{{$api_login_id}}" required>
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group form-group-default required">
																				<label>YOUR TRANSACTION KEY</label>
																				<input type="text" class="form-control" name="trans_key" value="{{$trans_key}}" required>
																			</div>
																		</div>
																	</div>


																	<br>
																	<button type="submit" class="btn btn-success btn-cons pull-right" ><span>Update</span></button>

																</form>
															</div>
														</div>
														<!-- END PANEL -->
													</div>
													<!-- END PANEL -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END JUMBOTRON -->

							<!-- NOTIFICATIONS -->
							@if (Session::has('success'))
							<div class="pgn-wrapper" data-position="top-right" id="bouncyFlip">
								<div class="pgn push-on-sidebar-open pgn-flip">
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
										<span>Your stripe info has been updated.</span>
									</div>
								</div>
							</div>
							@endif 
						</div>
						<!-- END PAGE CONTENT -->
						<!-- START COPYRIGHT -->
						@include('includes.dashboard.copy')
						<!-- END COPYRIGHT -->
					</div>
					<!-- END PAGE CONTENT WRAPPER -->
				</div>
				<!-- END PAGE CONTAINER -->

				<!-- END QUICKVIEW-->
				<!-- START OVERLAY -->
				@include('includes.dashboard.search')
				<!-- END Overlay Search Results !-->
				</div>
			<!-- END Overlay Content !-->
			</div>
		<!-- END OVERLAY -->
		<!-- BEGIN VENDOR JS -->
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
		<!--<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script> -->
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
		<script type="text/javascript" src="{{URL::to('/')}}/dashboard/assets/plugins/select2/js/select2.full.min.js"></script>
		<script type="text/javascript" src="{{URL::to('/')}}/dashboard/assets/plugins/classie/classie.js"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
		<!-- END VENDOR JS -->
		<!-- BEGIN CORE TEMPLATE JS -->
		<script src="{{URL::to('/')}}/dashboard/pages/js/pages.min.js"></script>
		<!-- END CORE TEMPLATE JS -->

		<!-- BEGIN PAGE LEVEL JS -->
		<script src="{{URL::to('/')}}/dashboard/assets/js/notifications.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/dashboard/assets/js/jquery.fitvids.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL JS -->
		</body>
		</html>