@extends('layouts.dashboard')
@section('page_level_style')
<link href="{{ URL::to('/')}}/css/card-js.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content-wrapper ">
	<!-- START PAGE CONTENT -->
	<div class="content ">
		<!-- START JUMBOTRON  class="jumbotron" data-pages="parallax" -->
		<div>
			<div class="container-fluid container-fixed-lg">
				<div class="inner">
					<!-- START BREADCRUMB -->
					<ul class="breadcrumb">
						<li>
							<a href="#" >Account</a>
						</li>
						<li>
							<a href="#" class="active">Update Your Credit Card</a>
						</li>
					</ul>
					<!-- END BREADCRUMB -->
					<div class="container-md-height m-b-20">
						<div class="row row-md-height">

							<div class="col-lg-4 col-md-height col-md-6 col-top">
								<!-- START PANEL -->
								<div class="panel panel-transparent">
									<div class="panel-heading">
										<div class="panel-title">Updating Your Credit Card
										</div>
									</div>
									<div class="panel-body">
										<h3>How it Works</h3>
										<p>You can edit or add your billing information here at any time. If you have any questions email or chat with us.
										</p>
										<br>

									</div>
								</div>
								<!-- END PANEL -->
							</div>
							<div class="col-lg-8 col-md-6 col-md-height col-middle ">
								@if (Session::has('success'))

								<div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success') }};">
									<div class="modal-dialog modal-sm">
										<div class="modal-content-wrapper">
											<div class="modal-content">
												<a  class="close" href="{{route('billing')}}"><i class="pg-close fs-14"></i>
												</a>
												<div class="container-xs-height full-height">
													<div class="row-xs-height">
														<div class="modal-body col-xs-height col-middle text-center   ">
															<h5 class="text-success "><span class="semi-bold">Success!</span> Your billing payment has been processed successfully..</h5>
															<br>
															<a class="btn btn-default btn-block"  href="{{route('billing')}}">Close</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-backdrop fade in"></div>
								@endif
								@if (Session::has('error'))

								<div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
									<div class="modal-dialog modal-sm">
										<div class="modal-content-wrapper">
											<div class="modal-content">
												<a  class="close" href="{{route('billing')}}"><i class="pg-close fs-14"></i>
												</a>
												<div class="container-xs-height full-height">
													<div class="row-xs-height">
														<div class="modal-body col-xs-height col-middle text-center   ">
															<h5 class="text-success "><span class="semi-bold">Failed!</span> {{Session::get('error')}}.</h5>
															<br>
															<a class="btn btn-default btn-block"  href="{{route('billing')}}">Close</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-backdrop fade in"></div>

								@endif
								<!-- START PANEL -->
								<div class="full-height">
									<!-- START PANEL -->
									<div class="panel panel-default">
										<div class="panel-heading">
											<div class="panel-title pull-left" style="margin-top:5px;">
												Billing
											</div>

											<span class="pull-right" style="margin-right: -3px;">

												<a href="javascript:viod();"  data-toggle="modal" data-target="#modalSlideUp" class="btn btn-danger btn-xs btn-cons text-uppercase"><span>cancel subscription</span></a>


											</span>
										</div>
										<br />

										<div class="panel-body">
											@if(!empty($authUserBillingRow))
											Your next billing date is <strong>{{date('M, d Y',strtotime($authUserBillingRow->billing_expire_date))}}</strong>
											@endif
											<?php /*?>@if($remainingDaysOfBilling < '1')<?php */?>
											<?php if($authUserBillingRow->cc){ ?>
											<br> Card ending with  <?=$authUserBillingRow->cc?>
											<?php } ?>
											<br>
											{!!Form::open(['url' => route('stripeResponseBillingPost'),'id'=>'payment-form','method'=>'POST'])!!}
											<div id="payment_errors" ></div>

											<div class="row">
												<div class="col-sm-6">
													<div class="form-group required">
														<label>First Name</label>
														<input type="text" class="card-form-group" data-stripe="name" placeholder="First Name" required>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group required">
														<label>Last Name</label>
														<input type="text" class="card-form-group" placeholder="Last Name" required>
													</div>
												</div>
											</div>
											<div class="card-js form-group ">
												<label>Card Number</label>
												<input class="card-number" data-stripe="number" name="card-number" required>
												<label>Expiration</label>
												<input class="expiry-month" data-stripe="exp_month" name="expiry-month" required>
												<input class="expiry-year" data-stripe="exp_year" name="expiry-year" required>
												<label>CVV</label>
												<input class="cvc" name="cvc" data-stripe="cvc" required>

											</div>
											<div class="clear"></div>
											<div class="row">
												<div class="col-sm-6 pull-right">
													<div class="form-group required" style="margin-top: 10px;">
														<label>Coupon Code</label>
														<input class="card-form-group" placeholder="Coupon Code" name="coupon_code">
													</div>
												</div>
											</div>
											<div class="clear"></div>
											<br>
											<div> <input type="submit" id="payment-btn" value="UPDATE" class="btn btn-success btn-cons pull-right" /></div>
											<!-- <a href="#" class="btn btn-success btn-cons pull-right" href="#bouncyFlip" data-type="position-flip"><span>Update</span></a>-->
											<div class="clear"></div>
											{{ Form::close() }}
											<?php /*?>@else
                                            <h3>You will pay bill after {{$remainingDaysOfBilling}} Days</h3>
                                            @endif<?php */?>
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



	</div>
	<!-- END PAGE CONTENT -->
	<!-- START COPYRIGHT -->
	<div class="container-fluid container-fixed-lg footer">
		<div class="copyright sm-text-center">

			<p class="small no-margin pull-left sm-pull-reset">
				<span class="hint-text">Made with love by <a href="https://taggartmediagroup.com" target="_blank">Taggart Media Group</a></span>
				<br>
				<span class="hint-text">Copyright © 2017 - 2018 </span>
				<span class="font-montserrat">Invoyce LLC</span>.
				<span class="hint-text">All rights reserved. </span>
				<span class="sm-block"><a href="/terms" class="m-l-10 m-r-10">Terms &amp; Conditions</a> | <a href="/privacy" class="m-l-10">Privacy Policy</a></span>

			</p>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- END COPYRIGHT -->
</div>
<div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false"><div class="modal-dialog ">
	{{Form::open(['url' => route('cancelUserSubscription'), 'method' => 'POST', 'autocomplete'=>'off']) }}
	<div class="modal-content-wrapper">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
				</button>
				<h5>Cancel <span class="semi-bold">Account</span></h5>
				<p class="p-b-10">If you cancel your account, you will lose all of your data, reports, scheduled invoices and subscription invoices. Click the button below to cancel your account. We hate to see you go, but understand if Invoyce is not a good fit for you. To cancel your account please click the button below.</p>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-sm-8">
						<div class="p-t-20 clearfix p-l-10 p-r-10">

							<div class="pull-right">
								<div class="checkbox check-danger">
									<input type="checkbox"   id="checkbox6" required>
									<label for="checkbox6">I understand and would like to cancel my account.</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 m-t-10 sm-m-t-10">
						<button type="submit" name="submit" value="Cancel Subscription" class="btn btn-danger btn-block m-t-5">Cancel Account</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{ Form::close()}}
	<!-- /.modal-content -->
	</div>
</div>
@include('includes.dashboard.scripts')
@section('page_level_script')
<script src="{{ URL::to('/')}}/assets/js/card-js.min.js"></script>
{{ Html::script('https://js.stripe.com/v2/')}}
<!-- {{ Html::script('/dashboard/assets/plugins/bootstrapv3/js/bootstrap.min.js')}} -->
<script type="text/javascript">
	Stripe.setPublishableKey('{{Config::get('constants.STRIPE_PUBLIC_KEY')}}');
	$(function() {
		var $form = $('#payment-form');
		$form.submit(function(event) {
			// Disable the submit button to prevent repeated clicks:
			$('#payment-btn').prop('disabled', true);

			// Request a token from Stripe:
			Stripe.card.createToken($form, stripeResponseHandler);

			// Prevent the form from being submitted:
			return false;
		});
	});

	function stripeResponseHandler(status, response) {
		// Grab the form:
		var $form = $('#payment-form');

		if (response.error) { // Problem!

			// Show the errors on the form:
			document.getElementById("payment_errors").innerHTML  ='<div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert"></button><strong>Error: </strong>'+response.error.message+'</div>';

			$form.find('.submit').prop('disabled', false); // Re-enable submission

		} else { // Token was created!

			// Get the token ID:
			var token = response.id;

			// Insert the token ID into the form so it gets submitted to the server:
			$form.append($('<input type="hidden" name="stripeToken">').val(token));

			// Submit the form:
			$form.get(0).submit();
		}
	};
</script>
<script>
	$(document).ready(function(e) {

	});
</script>
@endsection
@stop