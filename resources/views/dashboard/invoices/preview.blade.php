<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Invoice Preview | Invoyce</title>
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
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg">
                        <!-- START PANEL -->
                        <div class="panel panel-default m-t-20">
                            <div class="padding-0 bg-transparent pull-right m-t-20 m-r-20">
                                <ul>
                                    <!--<li style="display: inline;">
                                        <button class="btn btn-warning btn-cons pull-right" type="button"> <span><i class="fa fa-floppy-o" aria-hidden="true"></i> Save As Draft</span> </button>
                                        </li>-->
                                    @if($data['invoice_data']->invoice_type==1)
                                    @php $url='update-standard-invoice'; @endphp
                                    @endif
                                    @if($data['invoice_data']->invoice_type==2)
                                    @php $url='update-scheduled-invoice'; @endphp
                                    @endif
                                    @if($data['invoice_data']->invoice_type==3)
                                    @php $url='update-subscription-invoice';@endphp
                                    @endif
                                    @if ($data['invoice_data']->save_status!=3)
                                    <li style="display: inline;">
                                        <a href="{{URL::to('/')}}/dashboard/invoices/{{$url}}/{{$data['invoice_data']->id}}" class="btn btn-info btn-cons pull-right" type="button"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</span></a>
                                    </li>
                                    @else
                                    <li style="display: inline;"> <img  alt="" class="invoice-logo" data-src-retina="" data-src="{{URL::to('/')}}/dashboard/assets/img/paid.png" src="{{URL::to('/')}}/dashboard/assets/img/paid.png"></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="invoice padding-50 sm-padding-10">
                                    <div>
                                        <div class="pull-left">
                                            @if($data['profile_info']->image!='')
                                            <img  alt="" class="" data-src-retina="" data-src="{{ asset( 'profile/') .'/'. $data['profile_info']->image }}" src="{{ asset( 'profile/') .'/'. $data['profile_info']->image }}" style="max-width: 240px;">
                                            @else
                                            <h1>{{$data['profile_info']->company}}</h1>
                                            @endif
                                            <address class="m-t-10">
												@if($data['profile_info']->image!='')
                                                <strong>{{$data['profile_info']->company}}</strong> <br>
                                                @endif
                                                
                                                @if($data['profile_info']->address!="")
                                                {{$data['profile_info']->address}} <br>
                                                @endif
                                                @if($data['profile_info']->city!="" || $data['profile_info']->state!="" || $data['profile_info']->zip_code!="")
                                                {{$data['profile_info']->city}}, {{$data['profile_info']->state}} {{$data['profile_info']->zip_code}}<br>
                                                @endif
                                                @if($data['profile_info']->phone!="")
                                                {{$data['profile_info']->phone}}<br>
                                                @endif
                                                {{$data['profile_info']->email}}
                                            </address>
                                        </div>
                                        <div class="pull-right sm-m-t-20">
                                            <h2 class="font-montserrat all-caps hint-text">Invoice</h2>
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
                                            @php
                                            $date='';
                                            @endphp
                                            @if($data['invoice_data']->schedule_type=='0')
                                            @php
                                            $date = date('M d Y', strtotime($data['invoice_data']->add_date));@endphp
                                            @else 
                                            @php
                                            $date = date('M d Y', strtotime($data['invoice_data']->send_invoice_date));@endphp
                                            @endif
                                            @php
                                            $date = date('M d Y', strtotime($data['invoice_data']->send_invoice_date));
                                            @endphp
                                            <div class="col-md-3 col-sm-height col-bottom sm-no-padding sm-p-b-20">
                                                <br>
                                                <div>
                                                    <div class="pull-left font-montserrat bold all-caps">Invoice No :</div>
                                                    <div class="pull-right">{{$data['invoice_data']->invoice_number}}</div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div>
                                                    <div class="pull-left font-montserrat bold all-caps">Invoice date :</div>
                                                    <div class="pull-right">{{$date}}</div>
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
                                                @php $total=0; @endphp
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
                                                @php $total += ($value->rate*$value->qty);@endphp
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
                                    @if($data['invoice_data']->terms_conditions!='')
                                    <br>
                                    <h5>Terms and Conditions</h5>
                                    <p class="small hint-text">{!! nl2br(e($data['invoice_data']->terms_conditions)) !!} </p>
                                    <br>
                                    @endif
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
        <!--<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script> -->
        <script src="{{URL::to('/')}}/dashboard/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <!--<script src="{{URL::to('/')}}/dashboard/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script> -->
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
