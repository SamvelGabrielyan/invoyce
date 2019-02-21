@extends('layouts.dashboard')

@section('page_level_style')

@endsection

@section('content')

<!-- START PAGE CONTENT -->

<div class="page-content-wrapper ">

   @if (Session::has('success'))

   <div class="padding-20 bg-white">

      <ul class="pager wizard">

         <li class="next"  style="display: {{ Session::get('success') }};" id="errordiv">

            <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success') }};">

               <div class="modal-dialog modal-sm">

                  <div class="modal-content-wrapper">

                     <div class="modal-content">

                        <button type="button" class="close" onclick="hideErrorDiv();"><i class="pg-close fs-14"></i></button>

                        <div class="container-xs-height full-height">

                           <div class="row-xs-height">

                              <div class="modal-body col-xs-height col-middle text-center   ">

                                 <h5 class="text-success "><span class="semi-bold">Success!</span> Stripe has been connected successfully.</h5>

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

                        <button type="button" class="close" onclick="hideErrorDiv();"><i class="pg-close fs-14"></i></button>

                        <div class="container-xs-height full-height">

                           <div class="row-xs-height">

                              <div class="modal-body col-xs-height col-middle text-center   ">

                                 <h5 class="text-success "><span class="semi-bold">Failed!</span> Sorry! Stripe cannot be connected. Please try again.</h5>

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

   <!-- START PAGE CONTENT -->

   <div class="content sm-gutter">

      <!-- START CONTAINER FLUID -->

      <div class="container-fluid padding-25 sm-padding-10">

         <div class="panel panel-transparent">

            <div class="panel-heading">

               <div class="panel-title">Payment Processor Options</div>

            </div>

            <div class="panel-body">

               <div class="row">

                  <div class="col-md-6">

                     <div class="panel panel-default">

                        <div class="panel-heading separator">

                           <div class="panel-title">Send Invoices with Stripe</div>

                        </div>

                        <div class="panel-body">

                           <br>

                           <img src="{{url('')}}/assets/images/stripe-logo.png" class="img-responsive" />

                           <p>Stripe handles billions of dollars every year for forward-thinking businesses around the world. This is personally my favorite online payment processor. It is powerful, secure and easy to work with.</p>

                           <br>

                           @if(!Auth::user()->stripe_connected || Auth::user()->stripe_connected == 'No')

                           <a href="{{route('connectStripe')}}" class="btn btn-success btn-cons">Connect With Stripe</a>

                           @else

                            <a href="javascript:void(0)"><strong><i>Connected</i></strong></a>

                           @endif

                        </div>

                     </div>

                  </div>

                  <div class="col-md-6">

                     <div class="panel panel-default">

                        <div class="panel-heading separator">

                           <div class="panel-title">Send Invoices with Paypal</div>

                        </div> 

                        <div class="panel-body">

                           <br>

                           <img src="{{url('')}}/assets/images/paypal-logo.png" class="img-responsive" /><br>

                           <p>Paypal handles billions of dollars every year for forward-thinking businesses around the world. This is personally my favorite online payment processor. It is powerful, secure and easy to work with.</p>

                           <br>

                           <!--form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">

                            <input type="hidden" name="business" value="gagansingh00923-business@gmail.com"> 

                            <input type="hidden" name="cmd" value="_xclick"> 

                             <input type="hidden" name="item_name" value="demo"> 

                            <input type="hidden" name="item_number" value="24792">

                            <input type="hidden" name="amount" value="20">   

                            <input type="hidden" name="currency_code" value="USD">   

                            <!-- <input type="hidden" name="cancel_return" value="http://demo.expertphp.in/payment-cancel"> 

                            <input type="hidden" name="return" value="http://demo.expertphp.in/payment-status"> -->

                           @if(Session::has('paypalrefreshkey'))

                               <a href="javascript:void(0)"><strong><i>  

                                          Connected

                                      </i></strong></a>  



                           @else 

                             <button type="button" class="btn btn-success btn-cons" onclick="window.location.href='{{ $paypalloginurl }}'">  

                                          Connect With Paypal

                                      </button>



                           @endif

                           



                        <!--/form-->

                        <!-- <SCRIPT>document.frmTransaction.submit();</SCRIPT>  -->

                        </div>

                     </div>

                  </div>

                  

              <?php /*?><div class="col-md-4">

                     <div class="panel panel-default">

                        <div class="panel-heading separator">

                           <div class="panel-title">

                              Send Invoices with PayPal

                           </div>

                        </div>

                        <div class="panel-body">

                           <br>

                           <img src="{{url('')}}/assets/images/paypal-logo.png" class="img-responsive" />

                           <br>

                           <p>PayPal’s 227 million active account holders the confidence to connect and transact in new and powerful ways, whether they are online, on a mobile device, in an app, or in person. You can't go wrong with PayPal.</p>

                           <br>

                           @if(Auth::user()->paypal_connected == 'No')

                           <a href="{{route('connectPaypal')}}" class="btn btn-success btn-cons">Connect With PayPal</a>

                           @else

                           <a href="javascript:void(0)"><strong><i>Connected</i></strong></a>

                           @endif

                        </div>

                     </div>

                  </div><?php */?>

                  

                  <div class="col-md-6">

                     <div class="panel panel-default">

                        <div class="panel-heading separator">

                           <div class="panel-title">Coming Soon</div>

                        </div>

                        <div class="panel-body">

                           <h3>

                              <span class="semi-bold">Coming</span> Soon

                           </h3>

                           <p>We are always adding new connections to Invoyce to make your invoicing even easier. If you would like to see your processor on here, send us an email.</p>

                           <a href="mailto:help@invoyce.me" class="btn btn-success btn-cons">Request New Processor</a>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

      <!-- END CONTAINER FLUID -->

   </div>

</div>

</div>

<!-- END PAGE CONTENT -->

@include('includes.dashboard.scripts')

@section('page_level_script')

<script type="text/javascript">

   function hideErrorDiv() 

   {

       document.getElementById('errordiv').style.display = "none";

   }

</script>

@endsection

@stop