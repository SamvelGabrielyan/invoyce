	<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
			<meta charset="utf-8" />
			<title>Change Your Password | Invoyce</title>
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
											<a href="#" class="active">Change Your Password</a>
										</li>
									</ul>
									<!-- END BREADCRUMB -->
									<div class="container-md-height m-b-20">
										<div class="row row-md-height">

											<div class="col-lg-4 col-md-height col-md-6 col-top">
												<!-- START PANEL -->
												<div class="panel panel-transparent">
													<div class="panel-heading">
														<div class="panel-title">Changing Your Password
														</div>
													</div>
													<div class="panel-body">
														<h3>How it Works</h3>
														<p>This one is pretty straightforward. Simply enter in your current password and then your new desired password.
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
																Password
															</div>
														</div>
														<div class="panel-body">
															<h5>
																Change your password below
															</h5>
															<form class="" role="form"id="form-register" class="p-t-15" action="{{ action('AccountController@updatePassword') }}" onSubmit="return validatePassFrm();" accept-charset="UTF-8" method="POST">
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
																<div class="form-group form-group-default required">
																	<label>Current Password</label>
																	<input type="password" name="old_password" id="old_password" class="form-control" >
																</div>
																<span id="old_password_error" style="color: red; display: none;"></span>
																<hr>
																<div class="form-group form-group-default required">
																	<label>New Password</label>
																	<input type="password" name="new_password" id="new_password"  class="form-control" >
																</div>
																<span id="new_password_error" style="color: red; display: none;"></span>
																<div class="form-group form-group-default required">
																	<label>Confirm Password</label>
																	<input type="password" name="con_password" id="con_password" class="form-control" >
																</div>
																<span id="con_password_error" style="color: red; display: none;"></span>
																<br>
																<button type="submit" class="btn btn-success btn-cons pull-right"><span>Update Password</span></button>
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
                        <div class="padding-20 bg-white">
                            <ul class="pager wizard">
                                <li class="next"  style="display: {{ Session::get('success') }};" id="errordiv">
                                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success') }};">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content-wrapper">
                                                <div class="modal-content">
                                                    <button type="button" class="close" onclick="hideErrorDiv();"><i class="pg-close fs-14"></i>
                                                    </button>
                                                    <div class="container-xs-height full-height">
                                                        <div class="row-xs-height">
                                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                                <h5 class="text-success "><span class="semi-bold">Success!</span> Your password has been updated.</h5>
                                                                <br>
                                                                <button type="button" class="btn btn-default btn-block"  onclick="hideErrorDiv();">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade in"></div>
                                </li>
                            </ul>
                        </div>
                        @endif
                        @if (Session::has('error'))
                        <div class="padding-20 bg-white">
                            <ul class="pager wizard">
                                <li class="next"  style="display: {{ Session::get('error') }};" id="errordiv">
                                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('error') }};">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content-wrapper">
                                                <div class="modal-content">
                                                    <button type="button" class="close" onclick="hideErrorDiv();"><i class="pg-close fs-14"></i>
                                                    </button>
                                                    <div class="container-xs-height full-height">
                                                        <div class="row-xs-height">
                                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                                <h5 class="text-success "><span class="semi-bold">Failed!</span> Your current password doesn't match. Please try again.</h5>
                                                                <br>
                                                                <button type="button" class="btn btn-default btn-block"  onclick="hideErrorDiv();">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade in"></div>
                                </li>
                            </ul>
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
	<!-- FOOTER -->
	<!-- BEGIN VENDOR JS -->
	<script type="text/javascript">
		function hideErrorDiv() 
   		{
       		document.getElementById('errordiv').style.display = "none";
   		}
	</script>
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
	<!--<script src="{{URL::to('/')}}/dashboard/assets/js/form_elements.js" type="text/javascript"></script> -->
	<script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/dashboard/assets/js/jquery.fitvids.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/js/extra/common.js"></script>
	<script src="{{URL::to('/')}}/js/extra/password_val.js"></script>
	<!-- END FOOTER -->
	@include('includes.dashboard.scripts')
	</body>
	</html>