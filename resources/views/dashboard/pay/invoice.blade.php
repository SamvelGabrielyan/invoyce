<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Pay Invoice | Invoyce</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
        <meta content="" name="description" />
        @include('includes.dashboard.head')
    </head>
    <body class="fixed-header ">
        <!-- BEGIN SIDEBPANEL-->
        <!-- END SIDEBPANEL-->
        <!-- START PAGE-CONTAINER -->
        <div class="page-container " style="padding-left:0px;">
            <!-- START HEADER -->
            <!-- END HEADER -->
            <!-- START PAGE CONTENT WRAPPER -->
            <div class="page-content-wrapper ">
                <!-- START PAGE CONTENT -->
                <div class="content " style="padding-top: 9px;">
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg">
                        <!-- START PANEL -->
                        <div class="panel panel-default m-t-20">
                            <div class="panel-body">
                                <div class="invoice padding-50 sm-padding-10">
                                    <div class="padding-0 bg-transparent pull-right">
                                        <ul>
                                            <li style="display: inline;">
                                                
                                                @if($data['invoice_data']->save_status == 3)
                                                    <img alt='Paid' title='Paid' style="width:150px;" src='{{url('images/paid.png')}}'/>    
                                                @else
                                                    <a href="{{url('')}}/pay/invoice_payment/{{$data['invoice_data']->invoice_url}}" class="btn btn-success btn-cons btn-lg pull-right" type="button" style="margin-bottom:10px;"> <span><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Invoice</span> </a>
                                                    <div class="clearfix"></div>
                                                    <img alt='Credit card logos' title='Credit card logos' src='//payments.intuit.com/payments/landing_pages/LB/default.jsp?c=VMAD&l=H&s=1&b=F9FAF9'/>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <div class="pull-left">
                                            @if($data['profile_info']->image!='')
                                            <img  alt="" class="" width="200" class="img-flex"  data-src-retina="" data-src="{{url('')}}/profile/{{$data['profile_info']->image}}" src="{{url('')}}/profile/{{$data['profile_info']->image}}">
                                            <div class="gap"></div>
                                            @else
                                            &nbsp;
                                            @endif
                                            <address class="m-t-10">
                                                <strong>{{$data['profile_info']->company}} </strong><br>
                                                {{$data['profile_info']->address}}<br>
                                                {{$data['profile_info']->city}}, {{$data['profile_info']->state}} {{$data['profile_info']->zip_code}}<br><br>
                                                {{$data['profile_info']->phone}}<br>
                                                {{$data['profile_info']->email}}
                                            </address>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <hr>
                                    <div class="container-sm-height">
                                        <div class="row-sm-height">
                                            <div class="col-md-9 col-sm-height sm-no-padding">
                                                <p class="small no-margin">Invoice to:</p>
                                                <address>
                                                    <strong>{{$data['invoice_data']->company_name}}</strong>
                                                    <br>
                                                    @if($data['invoice_data']->address!="")
                                                    {{$data['invoice_data']->address}}<br />
                                                    @endif
                                                    @if($data['invoice_data']->city!="" || $data['invoice_data']->state!="" || $data['invoice_data']->zip_code!="")
                                                    {{$data['invoice_data']->city}}, {{$data['invoice_data']->state}} {{$data['invoice_data']->zip_code}}<br /> <br />
                                                    @endif
                                                    @if($data['invoice_data']->phone!="")
                                                    {{$data['invoice_data']->phone}}<br>
                                                    @endif
                                                    {{$data['invoice_data']->email}}
                                                </address>
                                            </div>
                                            <div class="col-md-3 col-sm-height col-bottom sm-no-padding sm-p-b-20">
                                                <br>
                                                <div>
                                                    <div class="pull-left font-montserrat bold all-caps">Invoice No :</div>
                                                    <div class="pull-right">{{$data['invoice_data']->invoice_number}}</div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div>
                                                    <div class="pull-left font-montserrat bold all-caps">Invoice date :</div>
                                                    <div class="pull-right">
                                                        @php $date=''; @endphp
                                                        @if($data['invoice_data']->schedule_type=='0')
                                                        @php
                                                        $date = date('M d Y', strtotime($data['invoice_data']->add_date));@endphp
                                                        @else
                                                        @php
                                                        $date = date('M d Y', strtotime($data['invoice_data']->send_invoice_date));
                                                        @endphp
                                                        @endif
                                                        @php
                                                        $date = date('M d Y', strtotime($data['invoice_data']->send_invoice_date));@endphp
                                                        {{$date}}
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table m-t-50">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Description</th>
                                                    <th class="text-center">Rate</th>
                                                    <th class="text-center">QTY</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total=0;@endphp
                                                @foreach($data['item'] as $key => $value)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$value->item}}
                                                    </td>
                                                    <td class="text-center">{{$value->description}} </td>
                                                    <td class="text-center">${{number_format($value->rate,2)}}</td>
                                                    <td class="text-center">{{$value->qty}}</td>
                                                    <td class="text-right">${{number_format($value->rate*$value->qty,2)}}</td>
                                                </tr>
                                                @php $total += ($value->rate*$value->qty); @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="container-sm-height">
                                        <div class="row row-sm-height b-a b-grey">
                                            <div class="col-sm-2 col-sm-height col-middle p-l-25 sm-p-t-15 sm-p-l-15 clearfix sm-p-b-15">
                                                <h5 class="font-montserrat all-caps small no-margin hint-text bold">Sub-Total</h5>
                                                <h3 class="no-margin">${{number_format($total,2)}}</h3>
                                            </div>
                                            <div class="col-sm-5 col-sm-height col-middle clearfix sm-p-b-15">
                                                <h5 class="font-montserrat all-caps small no-margin hint-text bold">Discount ($)</h5>
                                                <h3 class="no-margin">${{number_format($total-$data['invoice_data']->total_amount,2)}}</h3>
                                            </div>
                                            <div class="col-sm-5 text-right bg-menu col-sm-height padding-15">
                                                <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
                                                <h1 class="no-margin text-white">${{number_format($data['invoice_data']->total_amount,2)}}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if($data['invoice_data']->terms_conditions!='')
                                    <h5>Terms and Conditions</h5>
                                    <p class="small hint-text">
                                        {!! nl2br(e($data['invoice_data']->terms_conditions)) !!}
                                    </p>
                                    @endif
                                    <br>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- END PANEL -->
                    </div>
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
        <!-- END Overlay Content !-->
        </div>
        <!-- END OVERLAY -->
        <!-- BEGIN VENDOR JS -->
        <script src="{{URL::to('/')}}/dashboard/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
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
        <script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL JS -->
        @include('includes.dashboard.scripts')
    </body>
</html>