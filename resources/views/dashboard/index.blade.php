<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Dashboard | Invoyce</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
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
                <div class="content sm-gutter">
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid padding-25 sm-padding-10">
                        <!-- START ROW -->
                        <div class="row">
                            <div class="col-md-4 ">
                                @if($remainingDaysOfBilling < '8')
                                <div class="row">
                                    <div class="col-md-12 m-b-10">
                                        <div class="ar-3-2 widget-1-wrapper">
                                            <!-- START WIDGET widget_imageWidget-->
                                            <div class="widget-1 panel no-border bg-complete no-margin widget-loader-circle-lg">
                                                <div class="panel-body">
                                                    <div class="pull-bottom bottom-left bottom-right ">
                                                        <span class="label font-montserrat fs-11">GETTING STARTED</span>
                                                        <br>
                                                        <h2 class="text-white" style="line-height: 30px;">Setup Your Business</h2>
                                                        <p class="text-white hint-text">Start sending invoices in less than 5 minutes. Get started today!</p>
                                                        <div class="row stock-rates m-t-15">
                                                            <div class="company col-xs-4">
                                                                <a href="{{URL::to('/')}}/dashboard/account/account" class="btn btn-success btn-cons"><i class="fal fa-user-circle"></i> Setup My Account</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END WIDGET -->
                                        </div>
                                    </div>
                                </div>
                                @else
                                <!-- Account is setup -->
                                <div class="row">
                                    <div class="col-md-12 m-b-10">
                                        <div class="ar-3-2 widget-1-wrapper">
                                            <!-- START WIDGET widget_imageWidget-->
                                            <div class="widget-1b panel no-border bg-complete no-margin widget-loader-circle-lg">
                                                <div class="panel-body">
                                                    <div class="pull-bottom bottom-left bottom-right ">
                                                        <span class="label font-montserrat fs-11">New Invoice</span>
                                                        <br>
                                                        <h2 class="text-white" style="    line-height: 30px;">Create a New Invoice</h2>
                                                        <p class="text-white hint-text">Click the button below to create and send a new invoice today. </p>
                                                        <div class="row stock-rates m-t-15">
                                                            <div class="company col-xs-4">
                                                                <a href="/dashboard/invoices/choose" class="btn btn-success btn-cons"><i class="fal fa-list-alt"></i> Create New Invoice</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END WIDGET -->
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-12 m-b-10">
                                        <!-- START WIDGET D3 widget_graphTileFlat-->
                                        <div class="widget-8 panel no-border bg-success no-margin widget-loader-bar">
                                            <div class="container-xs-height full-height">
                                                <div class="row-xs-height">
                                                    <div class="col-xs-height col-top">
                                                        <div class="panel-heading top-left top-right">
                                                            <div class="panel-title text-black hint-text">
                                                                <span class="font-montserrat fs-11 all-caps">Last 7 Day Sales <i class="fa fa-chevron-right"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-xs-height ">
                                                    <div class="col-xs-height col-top relative">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="p-l-20">
                                                                    <h3 class="no-margin p-b-5 text-white">${{number_format($data['all_paid'],2)}}</h3>
                                                                    <p class="small hint-text m-t-5">
                                                                        <span class="label  font-montserrat m-r-5">+ {{number_format($data['per_amount'])}}%</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6"></div>
                                                        </div>
                                                        <div class="widget-8-chart line-chart" data-line-color="black" data-point-color="success" data-points="true" data-stroke-width="2">
                                                            <svg>
                                                                <g class="nvd3 nv-wrap nv-lineChart" transform="translate(-10,10)">
                                                                    <g>
                                                                        <rect height="103" style="opacity: 0;" width="168"></rect>
                                                                        <g class="nv-x nv-axis"></g>
                                                                        <g class="nv-y nv-axis"></g>
                                                                        <g class="nv-linesWrap">
                                                                            <g class="nvd3 nv-wrap nv-line" transform="translate(0,0)">
                                                                                <defs>
                                                                                    <clippath id="nv-edge-clip-20842">
                                                                                        <rect height="103" width="168"></rect>
                                                                                    </clippath>
                                                                                </defs>
                                                                                <g clip-path>
                                                                                    <g class="nv-groups">
                                                                                        <g class="nv-group nv-series-0" style="stroke-opacity: 1; fill-opacity: 0.5; fill: rgb(0, 0, 0); stroke: rgb(0, 0, 0);">
                                                                                            <path class="nv-line" d="M0,103L28.000000000000004,75.53333333333333L56.00000000000001,34.33333333333334L84,27.46666666666667L112.00000000000001,0L140,13.733333333333334L168,5.733333333333334,0L140"></path>
                                                                                        </g>
                                                                                    </g>
                                                                                    <g class="nv-scatterWrap" clip-path>
                                                                                        <g class="nvd3 nv-wrap nv-scatter nv-chart-20842" transform="translate(0,0)">
                                                                                            <defs>
                                                                                                <clippath id="nv-edge-clip-20842">
                                                                                                    <rect height="103" width="168"></rect>
                                                                                                </clippath>
                                                                                            </defs>
                                                                                            <g clip-path>
                                                                                                <g class="nv-groups">
                                                                                                    <g class="nv-group nv-series-0" style="stroke-opacity: 1; fill-opacity: 0.5; stroke: rgb(0, 0, 0); fill: rgb(0, 0, 0);">
                                                                                                        <circle class="nv-point nv-point-0" cx="0" cy="103" r="3" style="stroke-width: 2px;"></circle>
                                                                                                        <circle class="nv-point nv-point-1" cx="28.000000000000004" cy="75.53333333333333" r="3" style="stroke-width: 2px;"></circle>
                                                                                                        <circle class="nv-point nv-point-2" cx="56.00000000000001" cy="34.33333333333334" r="3" style="stroke-width: 2px;"></circle>
                                                                                                        <circle class="nv-point nv-point-3" cx="84" cy="27.46666666666667" r="3" style="stroke-width: 2px;"></circle>
                                                                                                        <circle class="nv-point nv-point-4" cx="112.00000000000001" cy="0" r="3" style="stroke-width: 2px;"></circle>
                                                                                                        <circle class="nv-point nv-point-5" cx="140" cy="13.733333333333334" r="3" style="stroke-width: 2px;"></circle>
                                                                                                        <circle class="nv-point nv-point-6" cx="168" cy="5.733333333333334" r="3" style="stroke-width: 2px;"></circle>
                                                                                                    </g>
                                                                                                </g>
                                                                                                <g class="nv-point-paths"></g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                        <g class="nv-legendWrap"></g>
                                                                        <g class="nv-interactive"></g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END WIDGET -->
                                        <div class="gap-10"></div>
                                        <div class="widget-9 panel no-border bg-primary no-margin widget-loader-bar">
                                            <div class="container-xs-height full-height">
                                                <div class="row-xs-height">
                                                    <div class="col-xs-height col-top">
                                                        <div class="panel-heading  top-left top-right">
                                                            <div class="panel-title text-black">
                                                                <span class="font-montserrat fs-11 all-caps">Most Profitable Client <i class="fa fa-chevron-right"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-xs-height">
                                                    <div class="col-xs-height col-top">
                                                        <div class="p-l-20 p-t-15">
                                                            <h3 class="no-margin p-b-5 text-white">${{number_format($data['most_paid'])}}</h3>
                                                            <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>
                                                            </a>
                                                            <span class="small hint-text">{{$data['most_profitable_client']}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-xs-height">
                                                    <div class="col-xs-height col-bottom">
                                                        <div class="progress progress-small m-b-20">
                                                            <!-- START BOOTSTRAP PROGRESS (http://getbootstrap.com/components/#progress) -->
                                                            <div class="progress-bar progress-bar-white" style="width:45%"></div>
                                                            <!-- END BOOTSTRAP PROGRESS -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="date-box">
                                                    <h3><span>Average Time Invoices Paid <i class="fa fa-chevron-right"></i> </span>{{$data['average_time']}} Days</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-6 col-md-12 m-b-10">
                                        <div class="">
                                            <!-- START WIDGET widget_tableWidget-->
                                            <div class="panel no-border  no-margin widget-loader-bar">
                                                <div class="panel-heading ">
                                                    <div class="panel-title">All Unpaid Invoices</div>
                                                </div>
                                                <div class="p-l-25 p-r-25 p-b-20">
                                                    <div class="container-sm-height">
                                                        <div class="row row-sm-height">
                                                            <div class="col-sm-2 col-sm-height col-middle p-l-25 sm-p-t-15 sm-p-l-15 clearfix sm-p-b-15">
                                                            </div>
                                                            <div class="col-sm-5 col-sm-height col-middle clearfix sm-p-b-15">
                                                            </div>
                                                            <div class="col-sm-5 text-right bg-menu col-sm-height padding-15"  style="background-color: #ff0000;">
                                                                <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
                                                                <h1 class="no-margin text-white">${{number_format($data['all_pending'],2)}}</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="widget-11-table">
                                                    <div class="table-responsive" >
                                                        <!--style="min-height:240px;"-->
                                                        <table class="table table-hover m-b-0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:10%;text-align: center;">Date Sent</th>
                                                                    <th style="width:18%;text-align: center;">Title</th>
                                                                    <th style="width:5%;text-align: center;">Status</th>
                                                                    <th style="width:10%;text-align: center;">Viewed</th>
                                                                    <th style="width:14%;text-align: center;">Amount</th>
                                                                    <th style="width:10%;text-align: center;">Options</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($data['invoicedata']) > 0)
                                                                @foreach($data['invoicedata'] as $key => $value)
                                                                <tr>
                                                                    <td class="v-align-middle ">
                                                                        <p>{{date('m/d/Y', strtotime($value->add_date))}}</p>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <p><strong>  {{$value->invoice_title}} </strong></p>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        @if($value->save_status==3)
                                                                        <p style="color:#ff0000;">Paid</p>
                                                                        @elseif ($value->save_status<3)
                                                                        <p style="color:#ff0000;">Unpaid</p>
                                                                        @endif
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        @if($value->view_status==0)
                                                                        <p>Not Viewed</p>
                                                                        @endif
                                                                        @if($value->view_status==1)
                                                                        <p>Viewed</p>
                                                                        @endif
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <p>${{number_format($value->total_amount,2)}}</p>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <div class="btn-group dropdown-default">
                                                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> Options <span class="caret"></span> </a>
                                                                            <ul class="dropdown-menu ">
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/preview/{{$value->id}}">View</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" data-target="#modalFillIn" onclick="getInvoiceLink({{$value->id}});" data-toggle="modal" >Invoice Link</a>
                                                                                </li>
                                                                                @if($value->save_status !=4 && $value->save_status!=3)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/sendReminder/{{$value->id}}/1">Remind</a>
                                                                                </li>
                                                                                @endif
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/duplicate/{{$value->id}}">Duplicate</a>
                                                                                </li>
                                                                                @if($value->invoice_type==1 && $value->save_status!=3 && $value->save_status !=4)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-standard-invoice/{{$value->id}}">Edit</a>
                                                                                </li>
                                                                                @endif
                                                                                @if($value->invoice_type==2 &&  $value->save_status!=3 && $value->save_status !=4)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-scheduled-invoice/{{$value->id}}">Edit</a>
                                                                                </li>
                                                                                @endif
                                                                                @if($value->invoice_type==3 && $value->save_status!=3 && $value->save_status !=4)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-subscription-invoice/{{$value->id}}">Edit</a>
                                                                                </li>
                                                                                @endif
                                                                                @if($value->invoice_type==3 && $value->save_status!=3)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/account/cancel_invoice.php?invoiceId={!! base64_encode($value->id)!!}&type=1">Cancel</a>
                                                                                </li>
                                                                                @elseif($value->save_status !=4 && $value->save_status !=3)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/cancel/{{$value->id}}/1">Cancel</a>
                                                                                </li>
                                                                                @endif
                                                                                    @if($value->invoice_type !=4 && $value->save_status !=3)
                                                                                <li>
                                                                                    <a href="#" id="modalPaid_id" data-value="{{$value->id}}" data-target="#modalPaid" data-toggle="modal" >Paid</a>
                                                                                </li>
                                                                            @endif
                                                                                <!-- <li>
                                                                                    <a href="#">Mark as Paid</a>
                                                                                    </li>-->
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="8" style=" text-align: center;">  Great news! You don't have any unpaid invoices.  </td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        {{ $data['invoicedata']->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END WIDGET -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Paid Invoyces -->
                                 <div class="row">
                                    <div class="col-sm-6 col-md-12 m-b-10">
                                        <div class="">
                                            <!-- START WIDGET widget_tableWidget-->
                                            <div class="panel no-border  no-margin widget-loader-bar">
                                                <div class="panel-heading ">
                                                    <div class="panel-title">Invoices Paid in the Last 7 Days</div>
                                                </div>
                                                <div class="p-l-25 p-r-25 p-b-20">
                                                    <div class="container-sm-height">
                                                        <div class="row row-sm-height">
                                                            <div class="col-sm-2 col-sm-height col-middle p-l-25 sm-p-t-15 sm-p-l-15 clearfix sm-p-b-15">
                                                            </div>
                                                            <div class="col-sm-5 col-sm-height col-middle clearfix sm-p-b-15">
                                                            </div>
                                                            <div class="col-sm-5 text-right bg-menu col-sm-height padding-15" style="background-color: #1eb343;">
                                                                <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
                                                                <h1 class="no-margin text-white">${{number_format($data['all_paid_total'],2)}}</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="widget-11-table">
                                                    <div class="table-responsive" >
                                                        <!--style="min-height:240px;"-->
                                                        <table class="table table-hover m-b-0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:10%;text-align: center;">Date Sent</th>
                                                                    <th style="width:18%;text-align: center;">Title</th>
                                                                    <th style="width:5%;text-align: center;">Status</th>
                                                                    <th style="width:10%;text-align: center;">Viewed</th>
                                                                    <th style="width:14%;text-align: center;">Amount</th>
                                                                    <th style="width:10%;text-align: center;">Options</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($data['paid_invoices']) > 0)
                                                                @foreach($data['paid_invoices'] as $key => $value)
                                                                <tr>
                                                                    <td class="v-align-middle ">
                                                                        <p>{{date('m/d/Y', strtotime($value->add_date))}}</p>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <p><strong>  {{$value->invoice_title}} </strong></p>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        @if($value->save_status==3)
                                                                        <p style="color:#ff0000;">Paid</p>
                                                                        @elseif ($value->save_status<3)
                                                                        <p style="color:#ff0000;">Unpaid</p>
                                                                        @endif
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        @if($value->view_status==0)
                                                                        <p>Not Viewed</p>
                                                                        @endif
                                                                        @if($value->view_status==1)
                                                                        <p>Viewed</p>
                                                                        @endif
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <p>${{number_format($value->total_amount,2)}}</p>
                                                                    </td>
                                                                    <td class="v-align-middle">
                                                                        <div class="btn-group dropdown-default">
                                                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> Options <span class="caret"></span> </a>
                                                                            <ul class="dropdown-menu ">
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/preview/{{$value->id}}">View</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" data-target="#modalFillIn" onclick="getInvoiceLink({{$value->id}});" data-toggle="modal" >Invoice Link</a>
                                                                                </li>
                                                                                @if($value->save_status !=4 && $value->save_status!=3)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/sendReminder/{{$value->id}}/1">Remind</a>
                                                                                </li>
                                                                                @endif
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/duplicate/{{$value->id}}">Duplicate</a>
                                                                                </li>
                                                                                @if($value->invoice_type==1 && $value->save_status!=3 && $value->save_status !=4)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-standard-invoice/{{$value->id}}">Edit</a>
                                                                                </li>
                                                                                @endif
                                                                                @if($value->invoice_type==2 &&  $value->save_status!=3 && $value->save_status !=4)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-scheduled-invoice/{{$value->id}}">Edit</a>
                                                                                </li>
                                                                                @endif
                                                                                @if($value->invoice_type==3 && $value->save_status!=3 && $value->save_status !=4)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-subscription-invoice/{{$value->id}}">Edit</a>
                                                                                </li>
                                                                                @endif
                                                                                @if($value->invoice_type==3 && $value->save_status!=3)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/account/cancel_invoice.php?invoiceId={!! base64_encode($value->id)!!}&type=1">Cancel</a>
                                                                                </li>
                                                                                @elseif($value->save_status !=4 && $value->save_status !=3)
                                                                                <li>
                                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/cancel/{{$value->id}}/1">Cancel</a>
                                                                                </li>
                                                                                @endif
                                                                                <!-- <li>
                                                                                    <a href="#">Mark as Paid</a>
                                                                                    </li>-->
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="8" style=" text-align: center;">
                                                                    You don't have any paid invoices in the last 7 days.  </td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        {{ $data['invoicedata']->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END WIDGET -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTAINER FLUID -->
            </div>
            <!-- END PAGE CONTENT -->
            <!-- LINK MODAL -->
            <div class="modal fade fill-in" id="modalFillIn" tabindex="-1" role="dialog" aria-hidden="true">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="pg-close"></i>
                </button>
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-left p-b-5"><span class="semi-bold">Invoice</span> Link</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-9 ">
                                    <input type="text" placeholder="" value="" class="form-control input-lg" id="invoice_url" name="icon-filter">
                                </div>
                                <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                                    <button type="button" id="js__textareacopybtn" class="btn btn-success btn-lg btn-large fs-15">Copy Link</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

             <!-- Paid Modal -->
           <div class="modal fade fill-in" id="modalPaid" tabindex="-1" role="dialog" aria-hidden="true">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="pg-close"></i>
                </button>
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-left p-b-5"><span class="semi-bold">Mark Invoice as Paid</span> </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <form method="post" action="{{URL::to('/')}}/dashboard/invoices/standardInvoiceAsPaid">
                                    <input id="mark_paid_id" type="hidden" name="id" value="">
                                <div class="col-md-9 ">
                                    <select class="form-control input-lg" name="mark_paid">
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Check">Check</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Cryptocurrency">Cryptocurrency</option>
                                        <option value="Wire Transfer">Wire Transfer</option>
                                        <option value="Other">Other</option>
                                    </select>

                                </div>
                                <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                                    <button type="submit" id="js-textareacopybtn" class="btn btn-success btn-lg btn-large fs-15">Mark as Paid</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Paid modal End -->
            @if (Session::has('valid'))

                <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('valid') }};">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content-wrapper">
                            <div class="modal-content">
                                <a  class="close" href="{{route('dashboard')}}"><i class="pg-close fs-14"></i>
                                </a>
                                <div class="container-xs-height full-height">
                                    <div class="row-xs-height">
                                        <div class="modal-body col-xs-height col-middle text-center   ">
                                            <h5 class="text-success "><span class="semi-bold">Success!</span> Reminder has been sent successfully.</h5>
                                            <br>
                                            <a class="btn btn-default btn-block"  href="{{route('dashboard')}}">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade in"></div>

            @endif
            @if (Session::has('success_cancel'))

                <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success_cancel') }};">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content-wrapper">
                            <div class="modal-content">
                                <a  class="close" href="{{route('dashboard')}}"><i class="pg-close fs-14"></i>
                                </a>
                                <div class="container-xs-height full-height">
                                    <div class="row-xs-height">
                                        <div class="modal-body col-xs-height col-middle text-center   ">
                                            <h5 class="text-success "><span class="semi-bold">Success!</span> Invoice has been cancelled.</h5>
                                            <br>
                                            <a class="btn btn-default btn-block"  href="{{route('dashboard')}}">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade in"></div>

            @endif
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
        <!--<script src="{{URL::to('/')}}/dashboard/assets/js/form_elements.js" type="text/javascript"></script> -->
        <script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/dashboard/assets/js/jquery.fitvids.js" type="text/javascript"></script>
        <script src="{{ URL::to('/')}}/assets/js/dashboard.js"></script>
        <style>
            .menu-pin .copyright { margin-left: 235px !important;}
            @media only screen and (max-width: 767px){
            .menu-pin .copyright { margin-left: 0px !important;}
            }
        </style>
        <script type="text/javascript">
            $(document).on('click', '#modalPaid_id', function (e) {
               var value = $(this).attr('data-value');
               $('#mark_paid_id').val(value);
            });
        </script>
        <!-- END FOOTER -->
        @include('includes.dashboard.scripts')
    </body>
</html>