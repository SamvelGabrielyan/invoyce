<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Edit Subscription Invoice | Invoyce</title>
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
                <div class="content">
                    <form role="form" id="form-stander" action="subscriptionUpdate" method="POST" autocomplete="off">
                        <input type="hidden" value="0" id="save_status" name="save_status" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="edit_id" value="{{$data['invoice_data']->id}}">
                        <div class="container-fluid container-fixed-lg">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="{{route('invoices')}}">Invoices</a>
                                </li>
                                <li><a href="#" class="active">Edit Subscription Invoice</a>
                                </li>
                            </ul>
                            <div class="padding-0 bg-transparent pull-right">
                                <ul>
                                    <li style="display: inline;">
                                        <a class="btn btn-link pull-right" href="{{route('invoices')}}"> <span><i class="fa fa-ban" aria-hidden="true"></i> Cancel</span> </a> 
                                    </li>
                                    <li style="display: inline;">
                                        <button class="btn btn-link pull-right" type="button"  id="saveDarf"> <span><i class="fa fa-floppy-o" aria-hidden="true"></i> Save As Draft</span> </button> 
                                    </li>
                                    <li style="display: inline;">
                                        <?php /*?><a href="{{URL::to('/')}}/dashboard/invoices/preview/{{$data['invoice_data']->id}}"  target="_blank" class="btn btn-link pull-right" type="button"> <span><i class="fa fa-search" aria-hidden="true"></i> Preview</span> </a><?php */?>
                                        <a href="javascript:viod();"  data-toggle="modal" data-target="#modalSlideUp" onclick="showPreview();" class="btn btn-link pull-right" > <span><i class="fa fa-search" aria-hidden="true"></i> Preview</span> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- START CONTAINER FLUID -->
                        <div class="container-fluid container-fixed-lg">
                            <div id="rootwizard" class="m-t-50">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm hidden-xs">
                                    <li class="tablinks active"  id="tab_1">
                                        <a  > <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> 1. Schedule Charge</span></a>
                                    </li>
                                    <li class="tablinks "  id="tab_2">
                                        <a > <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> 2. Client Information</span></a>
                                    </li>
                                    <li  class="tablinks" id="tab_3">
                                        <a > <span><i class="fa fa-id-card-o" aria-hidden="true"></i> 3. Invoice Details & Items</span></a>
                                    </li>
                                    {{--<li class="tablinks" id="tab_4">--}}
                                    {{--<a  > <span><i class="fa fa-list" aria-hidden="true"></i> 4. Invoice Items</span></a>--}}
                                    {{--</li>--}}
                                    <li  class="tablinks" id="tab_4">
                                        <a  > <span><i class="fa fa-file-text-o" aria-hidden="true"></i> 4. Message & Terms</span></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->                            
                                <div class="tab-content padding-20 bg-white">
                                    <div class="tab-pane padding-20 active slide-left fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab1">
                                        <div class="row row-same-height">
                                            <div class="col-md-5 b-r b-dashed b-grey sm-b-b">
                                                <div class="padding-30 m-t-50">
                                                    <h2>Subscription <span class="semi-bold">Invoices</span></h2>
                                                    <p>This is my personal favorite type of invoice. This allows you to send an invoice and charge your cient's card automatically for the time period you set. </p>
                                                    <p class="small hint-text">Get paid while you sleep with subscription invoices.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="padding-30">
                                                    <h3>Charge <span class="semi-bold">Schedule</span></h3>
                                                    <p class="small">Set the time period you want to automatically charge their card <strong>after the first invoice is paid</strong>.</p>
                                                    <select class="cs-select cs-skin-slide" id="time_periods" name="time_periods" data-init-plugin="cs-select">
                                                    <option value="7" {{ '7' == $data['invoice_data']->send_invoice_days ? 'selected="selected"' : '' }}>Every 7 Days</option>
                                                    <option value="14" {{ '14' == $data['invoice_data']->send_invoice_days ? 'selected="selected"' : '' }}>Every 14 Days</option>
                                                    <option value="30" {{ '30' == $data['invoice_data']->send_invoice_days ? 'selected="selected"' : '' }}>Every 30 Days</option>
                                                    </select>
                                                    <div class="gap"></div>
                                                    <h5>Send <span class="semi-bold">Notification?</span></h5>
                                                    <p>Check the box below if you would like to send an email notification to your client 24 hours prior before we charge their card on your behalf.</p>
                                                    <div class="checkbox asr___checkbox check-success">
                                                        <input type="checkbox" value="1" id="checkbox1" name='notification_status' {{ '1' == $data['invoice_data']->notification_status ? 'checked="checked"' : '' }} >
                                                        <label for="checkbox1">Yes, Send Notification</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PANEL -->
                                    <div class="tab-pane padding-20 slide-left fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab2">
                                        <div class="row row-same-height">
                                            <div class="col-md-5 b-r b-dashed b-grey sm-b-b">
                                                <div class="padding-30 m-t-50">
                                                    <h2>Company Information</h2>
                                                    <p>Enter in all of your customer's information here. Fields marked with a red asterisk are required fields.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="padding-30">
                                                    <div class="form-group">
                                                        <label>Company Name <span class='error_strick'>*</span></label>
                                                        <input class="form-control"  placeholder="Company Name" type="text" id="company_name" name="company_name" value="{{$data['invoice_data']->company_name}}">
                                                        <span id="company_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email Address <span class='error_strick'>*</span></label>
                                                        <input class="form-control"  placeholder="Client Email" type="text" id="email" name="email" value="{{$data['invoice_data']->email}}">
                                                        <span id="email_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Additional Email Addresses</label> <small>(optional)</small>
                                                        <input class="form-control"  placeholder="Separate with a comma ie. test@test.com, test2@test.com" type="text" id="additional_email" name="additional_email" value="{{$data['invoice_data']->additional_email}}">
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Client Address</label> <small>(optional)</small>
                                                        <input class="form-control" placeholder="Street Address"  type="text" id="address" name="address" value="{{$data['invoice_data']->address}}">
                                                        <span id="address_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label class="visible-xs">City</label>
                                                                <input class="form-control" placeholder="City" type="text" name="city" id="city" value="{{$data['invoice_data']->city}}">
                                                                <span id="city_error" class="error-message" style=" display: none;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label class="visible-xs">State</label>
                                                                <select class="full-width" data-init-plugin="select2" name="state">
                                                                    <option value="">Select State</option>
                                                                    @foreach($data['state'] as $key => $value)
                                                                    <option value="{{$value->name}}" {{ $data['invoice_data']->state == $value->name ? 'selected="selected"' : '' }}>{{$value->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label class="visible-xs">Zip Code</label>
                                                                <input class="form-control" placeholder="Zip Code"   type="text" id="zip_code" name="zip_code" value="{{$data['invoice_data']->zip_code}}">
                                                                <span id="zip_code_error" class="error-message" style=" display: none;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input class="form-control" placeholder="Phone Number"  type="text" name="phone" id="phone" value="{{$data['invoice_data']->phone}}">
                                                        <span id="phone_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane slide-left padding-20 fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab3">
                                        <div class="row row-same-height">
                                            <div class="col-md-3 b-r b-dashed b-grey ">
                                                <div class="padding-30">
                                                    <h2>Invoice Title and Number</h2>
                                                    <p>Enter in the title of your invoice. You can also change the invoice number to whatever you would like. </p>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="padding-30">
                                                    <div class="form-group">
                                                        <label>Invoice Title <span class='error_strick'>*</span></label>
                                                        <input class="form-control"  placeholder="Invoice Title  Here" type="text" name="invoice_title" id="invoice_title" value="{{$data['invoice_data']->invoice_title}}">
                                                        <span id="invoice_title_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Invoice #  <span class='error_strick'>*</span></label>
                                                        <input class="form-control"  placeholder="0001" type="text" name="invoice_number" id="invoice_number" value="{{$data['invoice_data']->invoice_number}}">
                                                        <span id="invoice_number_error" class="error-message" style=" display: none;"></span>
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
                                            <div class="col-md-9">
                                                <div class="padding-30">
                                                    @php $i = 1 @endphp
                                                    @foreach($data['item'] as $key => $value)
                                                        @if($i==1)
                                                            <div class="{{ $i == 1 ?'input_fields_wrap' : '' }}">
                                                                @endif
                                                                <div >
                                                                    <div class="form-group">
                                                                        <label>Item <span class='error_strick'>*</span></label>
                                                                        <input class="form-control"  placeholder="Item Here" type="text" name="item_name_{{$i}}" id="item_name_{{$i}}"  value="{{$value->item}}">
                                                                        <span id="item_name_error_{{$i}}" class="error-message" style=" display: none;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <input class="form-control"  placeholder="Description here" type="text" name="item_description_{{$i}}" id="item_description_{{$i}}" value="{{$value->description}}">
                                                                        <span id="item_description_error_{{$i}}" class="error-message" style=" display: none;"></span>
                                                                    </div>
                                                                    <div class="col-md-3 form-group" style="padding-left:0px;">
                                                                        <label>Rate <span class='error_strick'>*</span></label>
                                                                        <span class="help">e.g. "45.50"</span>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">$</span>
                                                                            <input class="form-control input-group-lg full_input"  placeholder="45.50" onblur="calculateTotal();" onkeypress="return isNumberKey(event);" type="text" name="item_rate_{{$i}}" id="item_rate_{{$i}}" value="{{$value->rate}}">
                                                                        </div>
                                                                        <span id="item_rate_error_{{$i}}" class="error-message" style=" display: none;"></span>
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <label>Quantity <span class='error_strick'>*</span></label>
                                                                        <input class="form-control"  placeholder="1" type="text" onblur="calculateTotal();" onkeypress="return isNumberKey(event);" name="item_qty_{{$i}}" id="item_qty_{{$i}}" value="{{$value->qty}}">
                                                                        <span id="item_qty_error_{{$i}}" class="error-message" style=" display: none;"></span>
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <label>Discount?</label>
                                                                        <input class="form-control"  type="text" placeholder="10" onblur="calculateTotal();" onkeypress="return isNumberKey(event);" name="item_discount_{{$i}}" id="item_discount_{{$i}}" value="{{$value->discount}}">
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <div class="radio m-0">
                                                                            <label class="p-0">
                                                                                <input type="radio" name="item_dis_{{$i}}" id="item_dis_{{$i}}"  value="yes" onclick="calculateTotal();" {{ 'yes' == $value->discount_type ? 'checked="checked"' : '' }}>
                                                                                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>$ Discount</label>
                                                                        </div>
                                                                        <div class="radio m-0">
                                                                            <label class="p-0">
                                                                                <input type="radio" name="item_dis_{{$i}}" id="item_dis_{{$i}}" value="no" onclick="calculateTotal();"  {{ 'no' == $value->discount_type ? 'checked="checked"' : '' }}>
                                                                                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>% Discount</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <a style="text-align: right;float: right;" href="#" class="remove_field btn btn-danger btn-cons"><i class="fa fa-ban" aria-hidden="true"></i> REMOVE</a>
                                                                    <hr>
                                                                </div>
                                                                @if(count($data['item'])==$i)
                                                            </div>
                                                        @endif
                                                        @php $i++ @endphp
                                                    @endforeach
                                                    <input type="hidden" id="totalInvoice" name="totalInvoice" value="{{count($data['item'])}}" />
                                                    <p class="pull-right">
                                                        <!--<button class="btn btn-warning btn-cons " type="button" onclick="calculateTotal();"><i class="fa fa-plus" aria-hidden="true"></i> CALCULATE TOTAL</button>-->
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
                                    {{--<div class="tab-pane slide-left padding-20 fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab4">--}}

                                    {{--</div>--}}
                                    <div class="tab-pane slide-left padding-20 fadeInRightBig animated" data-wow-delay="0ms" data-wow-duration="1500ms" id="tab4">
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
                                                        <label>Message to Client</label>
                                                        <textarea rows="8" class="form-control" id="invoice_message" name="invoice_message" placeholder="Briefly describe what this invoice is for...">{{$data['invoice_data']->invoice_message}}</textarea>
                                                        <span id="invoice_message_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Terms and Conditions</label> <small>(optional)</small>
                                                        <textarea rows="8" class="form-control" id="terms_conditions" name="terms_conditions" placeholder="Services will be invoiced in accordance with the Service Description. You must pay all undisputed invoices in full within 30 days of the invoice date, unless otherwise specified under the Special Terms and Conditions...">{{$data['invoice_data']->terms_conditions}}</textarea>
                                                        <span id="terms_conditions_error" class="error-message" style=" display: none;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="padding-20 bg-white">
                                        <ul class="pager wizard">
                                            <li  id="next_2" style="display: none;">
                                                <button onclick="openTab('tab2','tab_2','next_3','previous_2');" class="btn btn-success btn-cons  pull-right" type="button">
                                                    <span>Next </span>
                                                </button>
                                            </li>
                                            <li  id="next_3" style="display: none;">
                                                <button onclick="validateStanFrm();" class="btn btn-success btn-cons  pull-right" type="button">
                                                    <span>Next </span>
                                                </button>
                                            </li>
                                            <li  id="next_4" style="display: none;">
                                                <button onclick="validateStanFrm1();" class="btn btn-success btn-cons  pull-right" type="button">
                                                    <span>Next </span>
                                                </button>
                                            </li>
                                            <li class="" id="next_6" style="display: none;">
                                                <button class="btn btn-success btn-cons pull-right"  type="submit">
                                                    <span>Send Invoice</span>
                                                </button>
                                            </li>
                                            @if (Session::has('success'))
                                            <li class="next"  style="display: {{$data['status']}};" id="errordiv">
                                                <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{$data['status']}};">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content-wrapper">
                                                            <div class="modal-content">
                                                                <a  class="close"  href="{{route('subscriptionInvoicesList')}}"><i class="pg-close fs-14"></i>
                                                                </a>
                                                                <div class="container-xs-height full-height">
                                                                    <div class="row-xs-height">
                                                                        <div class="modal-body col-xs-height col-middle text-center   ">
                                                                            <h5 class="text-success ">
                                                                                <span class="semi-bold">Success!</span> your invoice has been sent successfully.
                                                                                <span >
                                                                                    {{$data['invoice_data']->email}}
                                                                                    @if ($data['invoice_data']->additional_email )
                                                                                    {{$data['invoice_data']->additional_email}}
                                                                                    @endif
                                                                                    <!--  -->
                                                                                </span>
                                                                                We will notify you when this invoice has been viewed and paid.
                                                                            </h5>
                                                                            <br>
                                                                            <a class="btn btn-default btn-block"   href="{{route('subscriptionInvoicesList')}}">Close</a>
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
                                            <li class="next"  style="display: {{$data['status']}};" id="errordiv2">
                                                <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{$data['status']}};">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content-wrapper">
                                                            <div class="modal-content">
                                                                <a  href="{{url('')}}/dashboard/invoices/saved-invoices" class="close"><i class="pg-close fs-14"></i>
                                                                </a>
                                                                <div class="container-xs-height full-height">
                                                                    <div class="row-xs-height">
                                                                        <div class="modal-body col-xs-height col-middle text-center   ">
                                                                            <h5 class="text-success "><span class="semi-bold">Success!</span> your invoice has been saved as a draft.</h5>
                                                                            <br>
                                                                            <a  class="btn btn-default btn-block"   href="{{url('')}}/dashboard/invoices/saved-invoices">Close</a>
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
                                            @if (Session::has('send'))
                                            <li class="next"  style="display: {{$data['status']}};" id="errordiv3">
                                                <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{$data['status']}};">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content-wrapper">
                                                            <div class="modal-content">
                                                                <a  class="close"  href="{{url('')}}/dashboard/invoices/invoices"><i class="pg-close fs-14"></i>
                                                                </a>
                                                                <div class="container-xs-height full-height">
                                                                    <div class="row-xs-height">
                                                                        <div class="modal-body col-xs-height col-middle text-center   ">
                                                                            <h5 class="text-success "><span class="semi-bold">Success!</span> your invoice has been sent successfully.</h5>
                                                                            <br>
                                                                            <a  class="btn btn-default btn-block"   href="{{url('')}}/dashboard/invoices/invoices">Close</a>
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
                                            <li  id="previous_4" style="display:none;">
                                                <button onclick="openTab('tab3','tab_3','next_4','previous_3');" class="btn btn-default btn-cons pull-right" type="button">
                                                    <span>Previous</span>
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
        <div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog modal__width">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-body text-left">
                            <div style="overflow-x: hidden !important;  margin-top:20px;">
                                <div class="invoice padding-30 sm-padding-10">
                                    <div class="">
                                        @if(Auth::user()->image!='')
                                        <img  alt=""  width="200"    data-src="{{URL::to('/')}}/profile/{{Auth::user()->image}}" src="{{URL::to('/')}}/profile/{{Auth::user()->image}}">
                                        
                                        <!--<img  alt=""  width="160" height="160"    data-src="{{url('')}}/dashboard/assets/img/default.png" src="{{url('')}}/dashboard/assets/img/default.png">-->
                                        @endif
                                        <!-- <img alt="" class="" width="200" data-src-retina="" data-src="{{url('')}}/profile/1516233097.png" src="{{url('')}}/profile/1516233097.png">-->
                                        <div class="gap"></div>
                                        <address class="m-t-10">
                                            <strong>{{Auth::user()->company}}</strong> <br>
                                            {{Auth::user()->address}}<br>
                                            {{Auth::user()->city}}, {{Auth::user()->state}} {{Auth::user()->zip_code}}<br><br>
                                            {{Auth::user()->phone}}<br>
                                            {{Auth::user()->email}}
                                        </address>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="container-sm-height">
                                        <div class="row-sm-height">
                                            <div class="col-md-9 col-sm-height sm-no-padding">
                                                <p class="small no-margin">Invoice to:</p>
                                                <address>
                                                    <strong><span id="s_company_name"></span></strong>
                                                    <span id="s_address"></span><br />
                                                    <span id="s_city"></span>,<span id="s_state"></span> <span id="s_zip_code"></span><br />
                                                    <span id="s_phone"></span><br />
                                                    <span id="s_email"></span>
                                                    <br>
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
                                                        <span id="s_send_date">{{date("m/d/y")}}</span>
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
        <!-- BEGIN VENDOR JS -->
        <script src="{{URL::to('/')}}/dashboard/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <!--<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>-->
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
        <!--<script src="{{URL::to('/')}}/dashboard/assets/js/form_elements.js" type="text/javascript"></script>-->
        <script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL JS -->
        <link class="main-stylesheet" href="{{URL::to('/')}}/js/extra/common.css" rel="stylesheet" type="text/css" />
        <script src="{{URL::to('/')}}/js/extra/common.js"></script>
        <script src="{{URL::to('/')}}/js/extra/subscription_invoice.js?5522"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
        <script src="{{ URL::to('/')}}/assets/js/subscription-invoices.js"></script>
        <link href="{{URL::to('/')}}/dashboard/assets/css/invoicecommon.css" rel="stylesheet" type="text/css">
        </script>
        <script>
            calculateTotal();
        </script>
        @include('includes.dashboard.scripts')
    </body>
</html>
