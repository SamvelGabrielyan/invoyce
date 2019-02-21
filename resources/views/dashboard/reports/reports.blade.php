<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Reports | Invoyce</title>
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
                    <div class="container-fluid container-fixed-lg">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/invoices/choose.php">Invoices</a>
                            </li>
                            <li><a href="#" class="active">Reports</a>
                            </li>
                        </ul>
                    </div>
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg">
                        <div class="col-lg-8 pull-left ">
                            <div class="row">
                                <h5 class="pad_mobile_left">Filter By <span class="semi-bold">Date Range</span></h5>
                                <div class="col-xs-12 col-sm-2 m-b-5 pad_mobile_left_div">
                                    <div style="margin-bottom: 5px;">
                                        <select class="cs-select cs-skin-slide" style="height: 34px !important; width: 100% !important;" id="filter_type" name="filter_type" data-init-plugin="cs-select">
                                        @php $selected = 'selected' @endphp
                                        <option value="All" @if ($data['sort_by']!='' && !empty($data['sort_by']))
                                        @if ('All'==$data['sort_by']) selected="{{$selected}}" }}@endif @endif>All Invoices</option>
                                        <option value="paid" @if ($data['sort_by']!='' && !empty($data['sort_by']))
                                        @if('paid'==$data['sort_by']) selected="{{$selected}}" @endif @endif>Paid</option>
                                        <option value="unpaid" @if ($data['sort_by']!='' && !empty($data['sort_by']))
                                        @if('unpaid'==$data['sort_by']) selected="{{$selected}}" @endif @endif>Unpaid</option>
                                        <option value="viewed" @if ($data['sort_by']!='' && !empty($data['sort_by']))
                                        @if('viewed'==$data['sort_by']) selected="{{$selected}}" @endif @endif>Viewed</option>
                                        <option value="not_viewed" @if($data['sort_by'] !='' && !empty($data['sort_by']))
                                        @if('not_viewed'==$data['sort_by']) selected="{{$selected}}" @endif @endif>Not Viewed</option>
                                        <option value="cancel" @if($data['sort_by']!='' && !empty($data['sort_by']))
                                        @if('cancel'==$data['sort_by']) selected="{{$selected}}" @endif @endif>Cancel</option>
                                        </select>
                                        <style>
                                            .pad-0{
                                            padding-left: 0px !important;
                                            }
                                            div.cs-skin-slide {
                                            height: 34px;
                                            }
                                        </style>
                                    </div>
                                </div>
                                <div class="col-xs-9 col-sm-6">
                                    <div class="btn-group m-b-10">
                                        <div class="input-daterange input-group" id="datepicker-range">
                                            <input type="text" class="input-sm form-control" value="{{$data['start_date']}}"  name="start" id="start_date" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-sm form-control"  value="{{$data['end_date']}}" name="end" id="end_date"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3"> <button type="button" onclick="filterRepDetails();" class="btn btn-success btn-block" style="margin-top:-2px; height: 34px;"><span class="hidden-xs">SUBMIT</span><span class="visible-xs"><i class="fa fa-fw fa-paper-plane-o"></i></span> </button></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- START PANEL -->
                        <div class="container-fixed-lg bg-white">
                            <div class="panel panel-transparent">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="basicTable">
                                            <thead>
                                                <tr>
                                                    <th style="width:1%;text-align: center;">INVOICE Date</th>
                                                    <th style="width:8%;text-align: center;">Invoice #</th>
                                                    <th style="width:29%;text-align: center;">Title</th>
                                                    <th style="width:17%;text-align: center;">Client</th>
                                                    <th style="width:2%;text-align: center;">Status</th>
                                                    <th style="width:10%;text-align: center;">Viewed</th>
                                                    <th style="width:15%;text-align: center;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total=0;
                                                $status='';@endphp
                                                @if (count($data['all_invoices']) > 0)
                                                @foreach($data['all_invoices'] as $key => $value)
                                                @if($value->save_status=='0' || $value->save_status=='2')
                                                @php
                                                $status='
                                                <p style="color:#ff0000;">Unpaid</p>
                                                ';
                                                @endphp
                                                @endif
                                                @if($value->save_status=='1')
                                                @php
                                                $status='
                                                <p style="color:#E3C028;">Saved</p>
                                                ';
                                                @endphp
                                                @endif
                                                @if($value->save_status=='3')
                                                @php
                                                $status='
                                                <p style="color:#1eb343;">Paid</p>
                                                ';
                                                @endphp
                                                @endif
                                                @if($value->save_status=='4')
                                                @php
                                                $status='
                                                <p style="color:#ff0000;">Cancelled</p>
                                                ';
                                                @endphp
                                                @endif
                                                <tr>
                                                    <td class="v-align-middle ">
                                                        <p>{{date('m/d/Y', strtotime($value->send_invoice_date))}}</p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <p>{{$value->invoice_number}}</p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <p><strong>  {{$value->invoice_title}} </strong></p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <p>{{$value->company_name}} </p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        @php echo $status;  @endphp
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
                                                </tr>
                                                @php
                                                $total += ($value->total_amount);
                                                @endphp
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="8" style=" text-align: left;">  I don't have any records!  </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="container-sm-height">
                                            <div class="row row-sm-height">
                                                <div class="col-sm-3 col-sm-height col-middle p-l-10 sm-padding-15">
                                                </div>
                                                <div class="col-sm-7 col-sm-height col-middle sm-padding-15 ">
                                                </div>
                                                <div class="col-sm-2 text-right bg-info col-sm-height col-middle padding-10">
                                                    <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
                                                    <h4 class="no-margin text-white">${{number_format($total,2)}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('includes.dashboard.help')
                                </div>
                            </div>
                        </div>
                        <!-- END PANEL -->
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
        <script>
            $(document).ready(function() {
                $('#datepicker-range').datepicker();
            });
            
            
        </script>
        <script src="{{URL::to('/')}}/js/extra/manageReport.js"></script>
        <script src="{{URL::to('/')}}/js/extra/common.js"></script>
        <!-- END PAGE LEVEL JS -->
        @include('includes.dashboard.scripts')
    </body>
</html>