<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<title>Scheduled Invoice</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
		<meta content="" name="description" />

		<?php include_once('../includes/head.php'); ?>

	</head>
	<body class="fixed-header ">
		<!-- BEGIN SIDEBPANEL-->
		<?php include_once('../includes/nav.php'); ?>
		<!-- END SIDEBPANEL-->
		<!-- START PAGE-CONTAINER -->
		<div class="page-container ">
			<!-- START HEADER -->
			<?php include_once('../includes/top-bar.php'); ?>
			<!-- END HEADER -->
			<!-- START PAGE CONTENT WRAPPER -->
			<div class="page-content-wrapper ">
				<!-- START PAGE CONTENT -->
				<div class="content ">

					<div class="container-fluid container-fixed-lg">
						<ul class="breadcrumb">
							<li>
								<a href="/invoices/choose.php">Invoices</a>
							</li>
							<li><a href="#" class="active">Scheduled Invoice</a>
							</li>
						</ul>

						<h3 class="page-title">Scheduled Invoice </h3>
						<div class="padding-0 bg-transparent pull-right"> 
							<ul> 
								<li style="display: inline;"> 
									<button class="btn btn-danger btn-cons pull-right" type="button"> <span><i class="fa fa-ban" aria-hidden="true"></i> Cancel</span> </button> </li>

								<li style="display: inline;"> 
									<button class="btn btn-warning btn-cons pull-right" type="button"> <span><i class="fa fa-floppy-o" aria-hidden="true"></i> Save As Draft</span> </button> </li>
								<li style="display: inline;"> 
									<a href="/invoices/preview.php" class="btn btn-info btn-cons pull-right" type="button"> <span><i class="fa fa-search" aria-hidden="true"></i> Preview</span> </a> 
								</li> 
							</ul> 
						</div>
					</div>
					<!-- START CONTAINER FLUID -->
					<div class="container-fluid container-fixed-lg">
						<div id="rootwizard" class="m-t-50">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm">
								<li class="active">
									<a data-toggle="tab" href="#tab1"> <span><i class="fa fa-calendar" aria-hidden="true"></i> Step 1 - Schedule</span></a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab2"> <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> Step 2 - Client Information</span></a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab3"> <span><i class="fa fa-id-card-o" aria-hidden="true"></i> Step 3 - Invoice Details</span></a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab4"> <span><i class="fa fa-list" aria-hidden="true"></i> Step 4 - Invoice Items</span></a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab5"> <span><i class="fa fa-file-text-o" aria-hidden="true"></i> Step 5 - Message & Terms</span></a>
								</li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane padding-20 active slide-left" id="tab1">
									<div class="row row-same-height">
										<div class="col-md-5 b-r b-dashed b-grey sm-b-b">
											<div class="padding-30 m-t-50">
												<h2>Schedule or Recurring Invoices</h2>
												<p>Discover goods you'll love from brands that inspire. The easiest way to open your own online store. Discover amazing stuff or open your own store for free!</p>
												<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
											</div>
										</div>
										<div class="col-md-7">
											<div class="padding-30">
												<div class="panel panel-transparent ">
													<!-- Nav tabs -->
													<ul class="nav nav-tabs nav-tabs-fillup" data-init-reponsive-tabs="dropdownfx">
														<li class="active">
															<a data-toggle="tab" href="#tab-fillup1"><span>Schedule Single Invoice</span></a>
														</li>
														<li>
															<a data-toggle="tab" href="#tab-fillup2"><span>Recurring Invoice</span></a>
														</li>

													</ul>
													<!-- Tab panes -->
													<div class="tab-content">
														<div class="tab-pane active" id="tab-fillup1">
															<div class="row">
																<div class="col-md-6">
																	<h3>Follow us &amp; get updated!</h3>
																	<p>Instantly connect to what's most important to you. Follow your friends, experts, favorite celebrities, and breaking news.</p>
																</div>
																<div class="col-md-6">
																	<div id="datepicker-embeded"></div>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tab-fillup2">
															<div class="row">
																<div class="col-md-6">
																	<h3>Select a Date Below</h3>
																	<div id="datepicker-embeded"></div>
																</div>
																<div class="col-md-6">
																	<h5>Time Periods</h5>
																	<p class="small">The button will be automatically sized according to the visible content size.</p>
																	<select class="cs-select cs-skin-slide" data-init-plugin="cs-select">
																		<option value="sightseeing">Every 7 Days</option>
																		<option value="business">Every 14 Days</option>
																		<option value="honeymoon">Every 30 Days</option>
																	</select>
																	
																</div>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- END PANEL -->
								<div class="tab-pane padding-20 slide-left" id="tab2">
									<div class="row row-same-height">
										<div class="col-md-5 b-r b-dashed b-grey sm-b-b">
											<div class="padding-30 m-t-50">
												<h2>Company Information</h2>
												<p>Discover goods you'll love from brands that inspire. The easiest way to open your own online store. Discover amazing stuff or open your own store for free!</p>
												<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
											</div>
										</div>
										<div class="col-md-7">
											<div class="padding-30">
												<form role="form">
													<div class="form-group">
														<label>Company Name</label>
														<input class="form-control" required="1" placeholder="Company Name" type="name">
													</div>
													<div class="form-group">
														<label>Email Address</label>
														<input class="form-control" required="1" placeholder="Client Email" type="email">
													</div>
													<div class="form-group">
														<label>Additional Email Addresses</label>
														<input class="form-control" required="" placeholder="Separate with a comma ie. test@test.com, test2@test.com" type="email">
													</div>
													<div class="form-group">
														<label>Address</label>
														<input class="form-control" placeholder="Street Address" required="" type="text">
														<br>
														<div class="col-md-4 col-xs-6" style="padding-left:0px;">
															<input class="form-control" placeholder="City" required="" type="text">
														</div>
														<div class="col-md-4 col-xs-6">
															<select class="full-width" data-init-plugin="select2">
																<option value="AL">Alabama</option>
																<option value="AK">Alaska</option>
																<option value="AZ">Arizona</option>
																<option value="AR">Arkansas</option>
																<option value="CA">California</option>
																<option value="CO">Colorado</option>
																<option value="CT">Connecticut</option>
																<option value="DE">Delaware</option>
																<option value="DC">District Of Columbia</option>
																<option value="FL">Florida</option>
																<option value="GA">Georgia</option>
																<option value="HI">Hawaii</option>
																<option value="ID">Idaho</option>
																<option value="IL">Illinois</option>
																<option value="IN">Indiana</option>
																<option value="IA">Iowa</option>
																<option value="KS">Kansas</option>
																<option value="KY">Kentucky</option>
																<option value="LA">Louisiana</option>
																<option value="ME">Maine</option>
																<option value="MD">Maryland</option>
																<option value="MA">Massachusetts</option>
																<option value="MI">Michigan</option>
																<option value="MN">Minnesota</option>
																<option value="MS">Mississippi</option>
																<option value="MO">Missouri</option>
																<option value="MT">Montana</option>
																<option value="NE">Nebraska</option>
																<option value="NV">Nevada</option>
																<option value="NH">New Hampshire</option>
																<option value="NJ">New Jersey</option>
																<option value="NM">New Mexico</option>
																<option value="NY">New York</option>
																<option value="NC">North Carolina</option>
																<option value="ND">North Dakota</option>
																<option value="OH">Ohio</option>
																<option value="OK">Oklahoma</option>
																<option value="OR">Oregon</option>
																<option value="PA">Pennsylvania</option>
																<option value="RI">Rhode Island</option>
																<option value="SC">South Carolina</option>
																<option value="SD">South Dakota</option>
																<option value="TN">Tennessee</option>
																<option value="TX">Texas</option>
																<option value="UT">Utah</option>
																<option value="VT">Vermont</option>
																<option value="VA">Virginia</option>
																<option value="WA">Washington</option>
																<option value="WV">West Virginia</option>
																<option value="WI">Wisconsin</option>
																<option value="WY">Wyoming</option>
															</select>
														</div>
														<div class="col-md-4 col-xs-6" >
															<input class="form-control" placeholder="Zip Code" required="" type="text">
															<br>
														</div>
													</div>

													<div class="form-group">
														<label>Phone</label>
														<input class="form-control" placeholder="Phone Number" required="" type="text">
													</div>

												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane slide-left padding-20" id="tab3">
									<div class="row row-same-height">
										<div class="col-md-5 b-r b-dashed b-grey ">
											<div class="padding-30">
												<h2>Invoice Title and Number</h2>
												<p>We respect your privacy and protect it with strong encryption, plus strict policies . Two-step verification, which we encourage all our customers to use.</p>
												<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
											</div>
										</div>
										<div class="col-md-7">
											<div class="padding-30">
												<div class="col-md-12">
													<div class="padding-30">
														<form role="form">
															<div class="form-group">
																<label>Invoice Title</label>
																<input class="form-control" required="" placeholder="Invoice Title  Here" type="text">
															</div>
															<div class="form-group">
																<label>Invoice # </label>
																<input class="form-control" required="" placeholder="0001" type="text">
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane slide-left padding-20" id="tab4">
									<div class="row row-same-height">
										<div class="col-md-3 b-r b-dashed b-grey ">
											<div class="padding-30">
												<h2>Invoice Items</h2>
												<p>We respect your privacy and protect it with strong encryption, plus strict policies . Two-step verification, which we encourage all our customers to use.</p>
												<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
											</div>
										</div>
										<div class="col-md-9">
											<div class="padding-30">
												<form role="form">
													<div class="form-group">
														<label>Item</label>
														<input class="form-control" required="" placeholder="Item Here" type="name">
													</div>
													<div class="form-group">
														<label>Description</label>
														<input class="form-control" required="" placeholder="Description here" type="email">
													</div>
													<div class="col-md-2 form-group" style="padding-left:0px;">
														<label>Rate</label>
														<span class="help">e.g. "$45.50"</span>
														<input class="form-control" required="1" placeholder="Rate" type="text" value="$">
													</div>
													<div class="col-md-2 form-group">
														<label>Quantity</label>
														<input class="form-control" required="1" placeholder="1" type="text">
													</div>
													<div class="col-md-2 form-group">
														<label>Discount?</label>
														<input class="form-control" required="" type="text" placeholder="10">
														<div class="radio radio-success">
															<input type="radio" value="yes" name="optionyes" id="yes">
															<label for="yes">$ Discount</label>
															<input type="radio" checked="checked" value="no" name="optionyes" id="no">
															<label for="no">% Discount</label>
														</div>
													</div>
													<div class="clearfix"></div>
													<hr>
													<p class="pull-right">
														<button class="btn btn-primary btn-cons" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add Item</button>
													</p>
												</form>
												<div class="gap-50"></div>
												<div class="container-sm-height">
													<div class="row row-sm-height b-a b-grey">
														<div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
															<h5 class="font-montserrat all-caps small no-margin hint-text bold">Discount (10%)</h5>
															<p class="no-margin">$10</p>
														</div>
														<div class="col-sm-7 col-sm-height col-middle sm-padding-15 ">

														</div>
														<div class="col-sm-2 text-right bg-info col-sm-height col-middle padding-10">
															<h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
															<h4 class="no-margin text-white">$44</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane slide-left padding-20" id="tab5">
									<div class="row row-same-height">
										<div class="col-md-5 b-r b-dashed b-grey ">
											<div class="padding-30 m-t-50">
												<h2>Invoice Message</h2>
												<p>We respect your privacy and protect it with strong encryption, plus strict policies . Two-step verification, which we encourage all our customers to use.</p>
												<p class="small hint-text">Below is a sample page for your cart , Created using pages design UI Elementes</p>
											</div>
										</div>
										<div class="col-md-7">
											<div class="padding-30">
												<form role="form">
													<div class="form-group">
														<label>Message to Client</label>
														<textarea rows="8" class="form-control" id="name" placeholder="Briefly describe what this invoice is for..."></textarea>
													</div>
													<div class="form-group">
														<label>Terms and Conditions</label>
														<textarea rows="8" class="form-control" id="name" placeholder="Services will be invoiced in accordance with the Service Description. You must pay all undisputed invoices in full within 30 days of the invoice date, unless otherwise specified under the Special Terms and Conditions..."></textarea>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="padding-20 bg-white">
									<ul class="pager wizard">
										<li class="next">
											<button class="btn btn-info btn-cons btn-animated from-left fa fa-arrow-circle-o-right pull-right" type="button">
												<span>Next</span>
											</button>
										</li>
										<li class="next finish hidden">
											<button class="btn btn-success btn-cons btn-animated from-left fa fa-cog pull-right" type="button">
												<span>Send Invoice</span>
											</button>
										</li>
										<li class="previous first hidden">
											<button class="btn btn-default btn-cons btn-animated from-left fa fa-cog pull-right" type="button">
												<span>First</span>
											</button>
										</li>
										<li class="previous">
											<button class="btn btn-default btn-cons pull-right" type="button">
												<span>Previous</span>
											</button>
										</li>
									</ul>
								</div>
								<div class="wizard-footer padding-20 bg-master-light">
									<p class="small hint-text pull-left no-margin">
										If you have any questions feel free to email us at support@invoiceme.com
									</p>
									<div class="pull-right">
										<img src="/assets/img/logo.png" alt="logo" data-src="/assets/img/logo.png" data-src-retina="/assets/img/logo_2x.png" width="78" height="22">
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- END CONTAINER FLUID -->
				</div>
				<!-- END PAGE CONTENT -->
				<!-- START COPYRIGHT -->
				<?php include_once('../includes/copy.php'); ?>
				<!-- END COPYRIGHT -->
			</div>
			<!-- END PAGE CONTENT WRAPPER -->
		</div>
		<!-- END PAGE CONTAINER -->

		<!-- START OVERLAY -->
		<?php include_once('../includes/search.php'); ?>
		<!-- END Overlay Search Results !-->
		</div>
	<!-- END Overlay Content !-->
	</div>
<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
<script src="/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
<script src="/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="/assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/plugins/classie/classie.js"></script>
<script src="/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery-autonumeric/autoNumeric.js"></script>
<script type="text/javascript" src="/assets/plugins/dropzone/dropzone.min.js"></script>
<script type="text/javascript" src="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery-inputmask/jquery.inputmask.min.js"></script>
<script src="/assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="/pages/js/pages.min.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="/assets/js/form_wizard.js" type="text/javascript"></script>
    <script src="/assets/js/form_elements.js" type="text/javascript"></script>
<script src="/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
</body>
</html>