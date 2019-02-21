<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Payment Detail | Invoyce</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
<meta content="" name="description" />

@include('includes.dashboard.head')
<link href="{{ URL::to('/')}}/css/card-js.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="fixed-header menu-pin">
<!-- BEGIN SIDEBPANEL-->
<?php /*?>@include('includes.dashboard.nav')<?php */?>
<!-- END SIDEBPANEL-->
<!-- START PAGE-CONTAINER -->
<div class="page-container ">
<!-- START HEADER -->
<?php /*?>@include('includes.dashboard.top-bar')<?php */?>
<!-- END HEADER -->
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper ">
<!-- START PAGE CONTENT -->
<div class="content " style="padding-left : 0px">
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg">
    <!-- START PANEL -->
    <div class="panel panel-default m-t-20">

        <div class="panel-body">
            <div class="invoice padding-50 sm-padding-10">
                <div>
                    <div class="pull-left">

                        <address class="m-t-10">
                            <strong>{{$data['getUserInfo']->company}}</strong> <br>
                            {{$data['getUserInfo']->address}}<br>
                            {{$data['getUserInfo']->city}}, {{$data['getUserInfo']->state}} {{$data['getUserInfo']->zip_code}}<br><br>
                            {{$data['getUserInfo']->phone}}<br>
                            {{$data['getUserInfo']->email}}
                        </address>
                    </div>
                    <div class="pull-right">
                        @if($data['getUserInfo']->image!='')
                        <img  alt="" class="" style="max-width:200px;" data-src-retina="" data-src="{{url('')}}/profile/{{$data['getUserInfo']->image}}" src="{{url('')}}/profile/{{$data['getUserInfo']->image}}">

                        @else
                        &nbsp;

                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr>
                <h5>
                    Billing Information
                </h5>
                @php 
                    $error_mes = Session::get('error');
                 @endphp   
                {{ Form::open(['url' => route('invoicePayPost',$data['invoice_id']), 'method' => 'POST','id'=>'payment-form','autocomplete'=>'off']) }}
                    {!!drawErrors()!!}
                    <div id="payment_errors" ></div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group required">
                                <input type="text" class="card-form-group" name="fname" placeholder="First name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group  required">
                                
                                <input type="text" class="card-form-group" placeholder="Last name" name="lname" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-js">
                        <input class="card-number" data-stripe="number" name="card-number" required>
                        <input class="expiry-month" data-stripe="exp_month" name="expiry-month" required>
                        <input class="expiry-year" data-stripe="exp_year" name="expiry-year" required>
                        <input class="cvc" name="cvc" data-stripe="cvc" required>
                    </div>

                    <br>
                    <div class="container-sm-height">
                        <div class="row row-sm-height b-a b-grey">
                            <div class="col-sm-2 col-sm-height col-middle p-l-25 sm-p-t-15 sm-p-l-15 clearfix sm-p-b-15">
                                <h5 class="font-montserrat all-caps small no-margin hint-text bold">Sub-Total</h5>
                                <h3 class="no-margin">$<?php echo number_format($data['total'],2);?></h3>
                            </div>
                            <div class="col-sm-5 col-sm-height col-middle clearfix sm-p-b-15">
                                <h5 class="font-montserrat all-caps small no-margin hint-text bold">Discount ($)</h5>
                                <h3 class="no-margin">${{ number_format($data['total']-$data['getInvoiceInfo']->total_amount,2)}}</h3>
                            </div>
                            <div class="col-sm-5 text-right bg-menu col-sm-height padding-15">
                                <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
                                <h1 class="no-margin text-white">${{number_format($data['getInvoiceInfo']->total_amount,2)}}</h1>
                            </div>
                        </div>

                    </div>
                    <div class="gap"></div>
                    <div class="padding-0 bg-transparent pull-right">
                        <ul>
                            <li style="display: inline;">
                                <input type="submit"  value="Pay Invoice" class="btn btn-success btn-cons btn-lg pull-right" type="button" style="margin-bottom:10px;">
                                <!--<span><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Invoice</span>    -->
                                <div class="clearfix"></div>
                                <img alt='Credit card logos' title='Credit card logos' src='//payments.intuit.com/payments/landing_pages/LB/default.jsp?c=VMAD&l=H&s=1&b=F9FAF9'/>
                            </li>

                        </ul>
                    </div>
                {{ Form::close()}}
                <br>
                @if($data['getInvoiceInfo']->terms_conditions!='')
                <h5>Terms and Conditions</h5>
                <p class="small hint-text">{!! nl2br($data['getInvoiceInfo']->terms_conditions)!!}</p>
                @endif
                <br>
                <hr>

            </div>
            <div class="container-fluid container-fixed-lg">
                <div class="copyright sm-text-center" style="border-top:0px;">
                    <p class="small no-margin pull-left sm-pull-reset">
                        <span class="hint-text">Made with love by <a href="https://taggartmediagroup.com" target="_blank">Taggart Media Group</a></span>
                        <br>
                        <span class="hint-text">Copyright &copy; 2017 - 2018 </span>
                        <span class="font-montserrat">Invoyce LLC</span>.
                        <span class="hint-text">All rights reserved. </span>
                        <span class="sm-block"><a href="/terms" class="m-l-10 m-r-10">Terms & Conditions</a> | <a href="/privacy" class="m-l-10">Privacy Policy</a></span>

                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PANEL -->
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
<!-- BEGIN VENDOR JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{URL::to('/')}}/dashboard/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<!-- <script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script> -->
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
<!-- <script src="{{URL::to('/')}}/dashboard/assets/js/tables.js" type="text/javascript"></script> -->
<script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
<script src="{{ URL::to('/')}}/assets/js/dashboard.js"></script>

<script src="{{ URL::to('/')}}/assets/js/card-js.min.js"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <!-- TO DO : Place below JS code in js file and include that JS file -->
        <script type="text/javascript">
            <?php /*?>Stripe.setPublishableKey('{{Config::get('constants.STRIPE_PUBLIC_KEY')}}');<?php */?>
            Stripe.setPublishableKey('{{$data['getUserInfo']->stripe_publishable_key}}');
			$(function() {
                var $form = $('#payment-form');
                $form.submit(function(event) {
                    // Disable the submit button to prevent repeated clicks:
                    $form.find('.submit').prop('disabled', true);

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
                    //$form.find('.payment-errors').text(response.error.message);

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
$(document).ready(function() {
$('#datepicker-range').datepicker();
});
</script>

<!-- END PAGE LEVEL JS -->
</body>
</html>