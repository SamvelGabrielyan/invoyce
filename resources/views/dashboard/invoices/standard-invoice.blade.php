<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<title>Create a Standard Invoice | Invoyce</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
		<meta content="" name="description" />
		@include('includes.dashboard.head')

  
	</head>
	<body class="fixed-header menu-pin">
		<!-- BEGIN SIDEBPANELs-->
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

					<form role="form" id="form-stander" name="standardType" action="standardInvoice" method="POST" autocomplete="off">
						<input type="hidden" value="0" id="save_status" name="save_status" />

						<div class="container-fluid container-fixed-lg">
							<ul class="breadcrumb">
								<li>
									<a href="{{URL::to('/')}}/dashboard/invoices/choose">Invoices</a>
								</li>
								<li><a href="#" class="active">Standard Invoice</a>
								</li>
							</ul>
							<div class="padding-0 bg-transparent pull-right">
								<ul>
									<li style="display: inline;">
										<a class="btn btn-link pull-right" href="{{URL::to('/')}}/dashboard/invoices/choose"> <span><i class="fa fa-ban" aria-hidden="true"></i> Cancel</span> </a>
									</li>

									<li style="display: inline;">
										<button class="btn btn-link pull-right" type="button" id="saveDarf" >
											<span><i class="fa fa-floppy-o" aria-hidden="true"></i> Save As Draft</span> </button>
									</li>

									<li style="display: inline;">
										<a href="javascript:void(0);" id="show_details" data-toggle="modal" data-target="#modalSlideUp" onclick="showPreview();" class="btn btn-link pull-right" > <span><i class="fa fa-search" aria-hidden="true"></i> Preview</span> </a>
									</li>
								</ul>
							</div>
						</div>
						<!-- START CONTAINER FLUID -->
						<div class="container-fluid container-fixed-lg">
							<div id="rootwizard" class="m-t-10">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm hidden-xs">
									<li class="tablinks active"  id="tab_1">
										<a > <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> 1. Client Information</span></a>
									</li>
									<li  class="tablinks" id="tab_2">
										<a > <span><i class="fa fa-id-card-o" aria-hidden="true"></i> 2. Invoice Details & Items</span></a>
									</li>
									<li class="tablinks" id="tab_3">
										<a > <span><i class="fa fa-list" aria-hidden="true"></i> 3. Messages & Terms</span></a>
									</li>
									{{--<li  class="tablinks" id="tab_4">--}}
										{{--<a > <span><i class="fa fa-file-text-o" aria-hidden="true"></i> 4. Message & Terms</span></a>--}}
									{{--</li>--}}
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane padding-20 active slide-left fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab1">
										<div class="row row-same-height">
											<div class="col-md-5 b-r b-dashed b-grey sm-b-b">
												<div class="padding-30 m-t-50">
													<h2>Client Information</h2>
													<p>Enter in all of your customer's information here. Fields marked with a red asterisk are required fields.</p>
													<p class="small hint-text">Standard Invoices are sent out immediately for your client to pay.</p>
												</div>
											</div>
											<div class="col-md-7">
												<div class="padding-30">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<div class="form-group">
														<label>Company Name <span style="color: #ff0000;">*</span></label>

														<input class="form-control"  placeholder="Company Name" type="text" id="company_name" name="company_name">
														<span id="company_error" class="error-message"></span>
													</div>
													<div class="form-group">
														<label>Email Address <span style="color: #ff0000;">*</span></label>
														<input class="form-control"  placeholder="Client Email" type="text" id="email" name="email">
														<span id="email_error" class="error-message" style=" display: none;"></span>
													</div>
													<div class="form-group">
														<label>Additional Email Addresses</label> <small>(optional)</small>
														<input class="form-control"  placeholder="Separate with a comma ie. test@test.com, test2@test.com" type="text" id="additional_email" name="additional_email">
													</div>
													<hr>
													<div class="form-group">
														<label>Client Address</label> <small>(optional)</small>
														<input class="form-control" placeholder="Street Address"  type="text" id="address" name="address">
														<span id="address_error" class="error-message" style=" display: none;"></span>
													</div>
													<div class="row">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="form-group">
																<label class="visible-xs">City</label>
																<input class="form-control" placeholder="City" type="text" name="city" id="city">
																<span id="city_error" class="error-message" style=" display: none;"></span>
															</div>
														</div>
														<div class="col-md-4  col-sm-4 col-xs-12">
															<div class="form-group">
																<label class="visible-xs">State</label>
																<select class="full-width" data-init-plugin="select2" name="state" id="state">
																	<option value="">Select State</option>
																	@foreach($data['state'] as $key => $value)
																	<option value="{{$value->name}}" >{{$value->name}}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12" >
															<div class="form-group">
																<label class="visible-xs">Zip Code</label>
																<input class="form-control" placeholder="Zip Code"   type="text" id="zip_code" name="zip_code">
																<span id="zip_code_error" class="error-message" style=" display: none;"></span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label>Phone</label>
														<input class="form-control" placeholder="Phone Number"  type="text" name="phone" id="phone">
														<span id="phone_error" class="error-message" style=" display: none;"></span>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="tab-pane slide-left padding-20 fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab2">
										<div class="row row-same-height">
											<div class="col-md-3 b-r b-dashed b-grey ">
												<div class="padding-30">
													<h2>Invoice Title and Number</h2>
													<p>Enter in the title of your invoice. You can also change the invoice number to whatever you would like. </p>
												</div>
											</div>
											<div class="col-md-9">
												<div class="padding-30">
													<div>
														<div class="form-group">
															<label>Invoice Title <span style="color: #ff0000;">*</span></label>
															<input class="form-control"  placeholder="Invoice Title" type="text" name="invoice_title" id="invoice_title">
															<span id="invoice_title_error" class="error-message" style=" display: none;"></span>
														</div>
														<div class="form-group">
															<label>Invoice # <span style="color: #ff0000;">*</span> </label>
															<input class="form-control"  placeholder="0001" value="{{$data['rand_no']}}" type="text" name="invoice_number" id="invoice_number">
															<span id="invoice_number_error" class="error-message" style=" display: none;"></span>
														</div>
													</div>
												</div>  
											</div>
										</div>
										<div class="row row-same-height">
											<div class="col-md-3 b-r b-dashed b-grey ">
												<div class="padding-30">
													<h2>Invoice Items</h2>
													<p>Add the items you are charging them for here. You can add multiple items by clicking on the green Add Item button.</p>
												</div>
											</div>
											<input type="hidden" id="totalInvoice" name="totalInvoice" value="1" />
											<div class="col-md-9">
												<div class="padding-30">
													<div class="input_fields_wrap">
														<div class="form-group">
															<label>Item <span style="color: #ff0000;">*</span></label>
															<span id="item_name_error_1" class="error-message" style=" display: none;"></span>
															<input class="form-control"  placeholder="Item" type="text" name="item_name_1" id="item_name_1">
														</div>
														<div class="form-group">
															<input class="form-control"  placeholder="Description (optional)" type="text" name="item_description_1" id="item_description_1">
															<span id="item_description_error_1" class="error-message" style=" display: none;"></span></div>
														<div class="col-md-2 form-group" style="padding-left:0px;">
															<label>Rate <span style="color: #ff0000;">*</span></label>
															<span class="help">"45.50"</span>
															<div class="input-group">
																<span class="input-group-addon">$</span>
																<input class="form-control input-group-lg full_input" onblur="calculateTotal();"  placeholder="Rate" onkeypress="return isNumberKey(event);" type="text" name="item_rate_1" id="item_rate_1">
															</div>
															<span id="item_rate_error_1" class="error-message" style=" display: none;"></span>
														</div>
														<div class="col-md-2 form-group">
															<label>Quantity<span style="color: #ff0000;">*</span></label>
															<input class="form-control" onblur="calculateTotal();" value="1" type="text" onkeypress="return isNumberKey(event);" name="item_qty_1" id="item_qty_1">
															<span id="item_qty_error_1" class="error-message" style=" display: none;"></span>
														</div>
														<div class="col-md-2 form-group">
															<label>Discount?</label>
															<input class="form-control"  type="text" value="0" onblur="calculateTotal();"  onkeypress="return isNumberKey(event);" name="item_discount_1" id="item_discount_1">
															<span id="item_discount_error_1" class="error-message" style=" display: none;" data-value='0'></span>
														</div>
														<div class="col-md-2 form-group">
															<div class="radio m-0">
																<label class="p-0">
																	<input type="radio" name="item_dis_1" id="item_dis_1" onclick="calculateTotal();" value="yes">
																	<span class="cr"><i class="cr-icon fa fa-circle"></i></span>$ Discount</label>
															</div>
															<div class="radio m-0">
																<label class="p-0">
																	<input type="radio" name="item_dis_1" id="item_dis_1" value="no" onclick="calculateTotal();" checked="checked" >
																	<span class="cr"><i class="cr-icon fa fa-circle"></i></span>% Discount</label>
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
													<hr>
													<p class="pull-right">
														<button class="add_field_button btn btn-success btn-cons" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add Item</button>
													</p>

													<div class="gap-50"></div>
													<div class="container-sm-height">
														<div class="row row-sm-height b-a b-grey">
															<div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
																<h5 class="font-montserrat all-caps small no-margin hint-text bold">Discount ($)</h5>
																<p class="no-margin">$<span id="totalDiscount">0</span></p>
															</div>
															<div class="col-sm-7 col-sm-height col-middle sm-padding-15 ">

															</div>
															<div class="col-sm-2 text-right bg-info col-sm-height col-middle padding-10">
																<h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
																<h4 class="no-margin text-white">$<span id="totalAmount">0</span></h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane slide-left padding-20 fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab3">
										<div class="row row-same-height">
											<div class="col-md-5 b-r b-dashed b-grey ">
												<div class="padding-30 m-t-50">
													<h2>Email Message and Terms</h2>
													<p>Enter in a message you would like your client to view in the email that is sent. You can also include any additional terms if you would like.</p>
												</div>
											</div>
											<div class="col-md-7">
												<div class="padding-30">
													<div class="form-group">
														<label>Email Message to Client</label>
														<textarea rows="8" class="form-control" id="invoice_message" name="invoice_message" placeholder="Briefly describe what this invoice is for..."></textarea>
														<span id="invoice_message_error" class="error-message" style=" display: none;"></span>
													</div>
													<div class="form-group">
														<label>Terms and Conditions</label> <small>(optional)</small>
														<textarea rows="8" class="form-control" id="terms_conditions" name="terms_conditions" placeholder="Services will be invoiced in accordance with the Service Description. You must pay all undisputed invoices in full within 30 days of the invoice date, unless otherwise specified under the Special Terms and Conditions..."></textarea>
														<span id="terms_conditions_error" class="error-message" style=" display: none;"></span>
													</div>

													<div class="form-group">
														
														@if(Session::has('paypalrefreshkey') and (Auth::user()->stripe_connected=="Yes"))
														<label>Payment Method<span class="error_strick">*</span></label>
														<select class="full-width" data-init-plugin="select2" name="paymentmethod" id="paymentmethod" required>
															<option value="">Select Payment Method</option>															
																<option value="paypal" >Paypal</option>
																<option value="stripe" >Stripe</option>															
														</select>
														
														@elseif(Session::has('paypalrefreshkey'))
														<input type="hidden" name="paymentmethod" value="paypal"/>
														
														@elseif(Auth::user()->stripe_connected=="Yes")
														<input type="hidden" name="paymentmethod" value="stripe"/>														
														@endif
														
														
														
														<span id="paypal_method_error" class="error-message" style=" display: none;"></span>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="tab-pane slide-left padding-20 fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab4">
									</div>

									<div class="padding-20 bg-white">
										<ul class="pager wizard">
											<li id="next_2" style="display: none;">
												<button onclick="validateStanFrm();" class="btn btn-success btn-cons from-left pull-right" type="button">
													<span>Next </span>
												</button>
											</li>
											<li id="next_3" style="display: none;">
												<button onclick="validateStanFrm2()" class="btn btn-success btn-cons from-left pull-right" type="button">
													<span>Next</span>
												</button>
											</li>
											<li class="" id="next_5" style="display: none;">
												<button class="btn btn-success btn-cons from-left pull-right" type="submit">
													<span>Send Invoice</span>
												</button>
											</li>

											@if (Session::has('success'))
											<li class="next"  style="display: {{ Session::get('success') }};" id="errordiv">
												<div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success') }};">
													<div class="modal-dialog modal-sm">
														<div class="modal-content-wrapper">
															<div class="modal-content">
																<a  class="close" href="{{route('standardInvoicesList')}}"><i class="pg-close fs-14"></i>
																</a>
																<div class="container-xs-height full-height">
																	<div class="row-xs-height">
																		<div class="modal-body col-xs-height col-middle text-center   ">
																			<h5 class="text-success "><span class="semi-bold">Success!</span> Your invoice has been sent to
																				<span><strong>@php $email_id= Session::get('email_send'); $payAmount = Session::get('pay_amount'); @endphp {{$email_id}}</strong></span> in the amount of ${{$payAmount}}. We will let you know when it has been viewed and paid.</h5>
																			<br>
																			<a type="button" class="btn btn-default btn-block"  href="{{route('standardInvoicesList')}}">Close</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-backdrop fade in"></div>

											</li>
											@endif

											@if (Session::has('save'))
											<li class="next"  style="display: {{ Session::get('save') }};" id="errordiv2">
												<div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('save') }};">
													<div class="modal-dialog modal-sm">
														<div class="modal-content-wrapper">
															<div class="modal-content">
																<a  class="close" href="{{route('saveAllInvoice')}}"><i class="pg-close fs-14"></i>
																</a>
																<div class="container-xs-height full-height">
																	<div class="row-xs-height">
																		<div class="modal-body col-xs-height col-middle text-center   ">
																			<h5 class="text-success "><span class="semi-bold">Success!</span> Your invoice has been saved as a draft.</h5>
																			<br>
																			<a class="btn btn-default btn-block"  href="{{route('saveAllInvoice')}}">Close</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-backdrop fade in"></div>

											</li>
											@endif
											<li class="previous first hidden">
												<button class="btn btn-default btn-cons btn-animated from-left fa fa-cog pull-right" type="button">
													<span>First</span>
												</button>
											</li>

											<li class="previous disabled" id="previous_1" >
												<button  class="btn btn-default btn-cons pull-right" type="button">
													<span>Previous </span>
												</button>
											</li>

											<li  id="previous_2" style="display:none;" >
												<button onclick="openTab('tab1','tab_1','next_2','previous_1');" class="btn btn-default btn-cons pull-right" type="button">
													<span>Previous </span>
												</button>
											</li>

											<li  id="previous_3" style="display:none;">
												<button onclick="openTab('tab2','tab_2','next_3','previous_2');" class="btn btn-default btn-cons pull-right" type="button">
													<span>Previous </span>
												</button>
											</li>
										</ul>
									</div>

									@include('includes.dashboard.help')
								</div>


							</div>
						</div>
					</form>
					<!-- END CONTAINER FLUID -->
				</div>
				<!-- END PAGE CONTENT -->
				<!-- START COPYRIGHT -->
				@include('includes.dashboard.copy')

				<!-- END COPYRIGHT -->
			</div>
			<!-- END PAGE CONTENT WRAPPER -->
		</div>
		<!-- END PAGE CONTAINER -->

		<!-- START OVERLAY -->
		@include('includes.dashboard.search')

		<!-- END Overlay Search Results !-->
		</div>
	<!-- END Overlay Content !-->
	</div>
<!-- END OVERLAY -->




<!--Preview Section-->

<div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
	<div class="modal-dialog modal__width">
		<div class="modal-content-wrapper">
			<div class="modal-content">
				<div class="modal-body text-left">
					<div style="overflow-x: hidden !important;  margin-top:20px;">

						<div class="invoice padding-30 sm-padding-10">


							<div class="">
								@if($data['profile_info']->image!='')
								<img  alt=""  width="200"   data-src="{{URL::to('/')}}/profile/{{$data['profile_info']->image}}" src="{{URL::to('/')}}/profile/{{$data['profile_info']->image}}">
								
								<!--<img  alt=""  width="160" height="160"    data-src="{{url('')}}/dashboard/assets/img/default.png" src="{{url('')}}/dashboard/assets/img/default.png">-->
								@endif
								<!-- <img alt="" class="" width="200" data-src-retina="" data-src="{{url('')}}/profile/1516233097.png" src="{{url('')}}/profile/1516233097.png">-->
								<div class="gap"></div>

								<address class="m-t-10">
									<strong>{{$data['profile_info']->company}}</strong> @if($data['profile_info']->company)<br>@endif
									{{$data['profile_info']->address}}@if($data['profile_info']->address)<br>@endif
									{{$data['profile_info']->city}} @if($data['profile_info']->city),@endif {{$data['profile_info']->state}} {{$data['profile_info']->zip_code}}
									@if($data['profile_info']->phone)<br>@endif
									{{$data['profile_info']->phone}}
									@if($data['profile_info']->email)<br>@endif
									{{$data['profile_info']->email}}
								</address>
							</div>

							<div class="clearfix"></div>

							<hr>
							<div class="container-sm-height">
								<div class="row-sm-height">
									<div class="col-md-9 col-sm-height sm-no-padding">
										<p class="small no-margin">Invoice to:</p>

										<address>
											<p><strong><span id="s_company_name"></span></strong>
											<span id="s_address"></span></p>
											<p><span id="s_city"></span><span id="add_comma"></span> <span id="s_state"></span> <span id="s_zip_code"></span></p>
											<p><span id="s_phone"></span></p>
											<p><span id="s_email"></span></p>
										</address>
									</div>
									<div class="col-md-3 col-sm-height col-bottom sm-no-padding sm-p-b-20">
										<br>
										<div>
											<div class="pull-left font-montserrat bold all-caps">Invoice No :</div>
											<div class="pull-right"><span id="s_invoice_number"></span></div>
											<div class="clearfix"></div>
										</div>
										<div>
											<div class="pull-left font-montserrat bold all-caps">Invoice date :</div>
											<div class="pull-right">
												 {!! date("M d Y") !!}

											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="text-left">Title</th>
											<th class="text-left">Description</th>
											<th class="text-left">Rate</th>
											<th class="text-left">QTY</th>
											<th class="text-right">Total</th>
										</tr>
									</thead>
									<tbody id="item_div">


									</tbody>
								</table>
							</div>

							<br>
							<br>
							<div class="container-sm-height">
								<div class="row row-sm-height b-a b-grey">
									<div class="col-sm-2 col-sm-height col-middle p-l-25 sm-p-t-15 sm-p-l-15 clearfix sm-p-b-15">
										<h5 class="font-montserrat all-caps small no-margin hint-text bold">Sub-Total</h5>
										<h3 class="no-margin">$<span id="s_sub_total">0.00</span></h3>
									</div>
									<div class="col-sm-5 col-sm-height col-middle clearfix sm-p-b-15">
										<h5 class="font-montserrat all-caps small no-margin hint-text bold">Discount ($)</h5>
										<h3 class="no-margin">$<span id="s_totalDiscount">0.00</span></h3>
									</div>
									<div class="col-sm-5 text-right bg-menu col-sm-height padding-15">
										<h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
										<h1 class="no-margin text-white">$<span id="s_totalAmount">0.00</span></h1>
									</div>
								</div>
							</div>
							<br>

							<hr>

						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>

<style>
address p{
	margin:0;
}
.pager.wizard .btn-cons {
    margin-left: 18px;
}
</style>


<script>
	jQuery("#show_details").click(function(){
		var get_cityval=jQuery("#city").val();
		if(get_cityval!=""){
			
			jQuery("#add_comma").html(",");
		} else{
			jQuery("#add_comma").html("");
		}
	});
</script>

<!-- BEGIN VENDOR JS -->
<script src="{{URL::to('/')}}/dashboard/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<!-- <script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>  -->
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
<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-autonumeric/autoNumeric.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/dashboard/assets/plugins/dropzone/dropzone.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-inputmask/jquery.inputmask.min.js"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/moment/moment.min.js"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{URL::to('/')}}/dashboard/pages/js/pages.min.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{URL::to('/')}}/dashboard/assets/js/form_wizard.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<link class="main-stylesheet" href="{{URL::to('/')}}/js/extra/common.css?89" rel="stylesheet" type="text/css" />
<script src="{{URL::to('/')}}/js/extra/common.js"></script>
<script src="{{URL::to('/')}}/js/extra/standar_invoice.js?{{ time() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="{{ URL::to('/')}}/assets/js/standard-invoices.js"></script>
<link href="{{URL::to('/')}}/dashboard/assets/css/invoicecommon.css" rel="stylesheet" type="text/css"></script>

@include('includes.dashboard.scripts')


</body>
</html>
