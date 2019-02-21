<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Saved Invoices | Invoyce</title>
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
                                <a href="{{route('invoices')}}">Invoices</a>
                            </li>
                            <li><a href="#" class="active">Saved Invoices</a>
                            </li>
                        </ul>
                    </div>
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg">
                        <form role="form" id="form-stander" name="search" action="saved-invoices" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-lg-8 pull-left ">
                                <div class="row">
                                    <h5 class="pad_mobile_left">Filter By <span class="semi-bold">Date Range</span></h5>
                                    <div class="col-xs-9 col-sm-6">
                                        <div class="btn-group m-b-10">
                                            <div class="input-daterange input-group" id="datepicker-range">
                                                <input type="text" class="input-sm form-control" value=""  name="start" id="start_date" placeholder="Start Date"/>
                                                <span class="input-group-addon">to</span>
                                                <input type="text" class="input-sm form-control"  value="" name="end" id="end_date" placeholder="End Date"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3"> <button type="submit" class="btn btn-success btn-block" style="margin-top:-2px; height: 34px;"><span class="hidden-xs">FILTER</span><span class="visible-xs"><i class="fa fa-fw fa-paper-plane-o"></i></span> </button></div>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <!-- START PANEL -->
                        <div class="container-fixed-lg bg-white">
                            <div class="panel panel-transparent">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="basicTable">
                                            <thead>
                                                <tr>
                                                    <th style="width:1%;text-align: center;">INVOICE DATE</th>
                                                    <th style="width:8%;text-align: center;">Invoice #</th>
                                                    <th style="width:29%;text-align: center;">Title</th>
                                                    <th style="width:17%;text-align: center;">Client</th>
                                                    <th style="width:2%;text-align: center;">Status</th>
                                                    <th style="width:10%;text-align: center;">Viewed</th>
                                                    <th style="width:15%;text-align: center;">Amount</th>
                                                    <th style="width:15%;text-align: center;">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($data['allInvoices']) > 0)
                                                @foreach($data['allInvoices'] as $key => $value)
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
                                                        <p style="color:#ff0000;">----</p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <p>-------    </p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <p>${{number_format($value->total_amount,2)}}</p>
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <div class="btn-group dropdown-default">
                                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 155px;"> Options <span class="caret"></span> </a>
                                                            <ul class="dropdown-menu ">
                                                                @if($value->invoice_type==1)
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-standard-invoice/{{$value->id}}">Edit</a>
                                                                </li>
                                                                @endif
                                                                @if($value->invoice_type==2)
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-scheduled-invoice/{{$value->id}}">Edit</a>
                                                                </li>
                                                                @endif
                                                                @if($value->invoice_type==3)
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-subscription-invoice/{{$value->id}}">Edit</a>
                                                                </li>
                                                                @endif
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/delete-invoice/{{$value->id}}">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="8" style=" text-align: center;">  No invoices have been saved  </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        @if (count($data['allinvoice']) > 0)
                                        {{ $data['allinvoice']->links() }}
                                        @endif
                                    </div>
                                    @include('includes.dashboard.help')
                                </div>
                            </div>
                        </div>
                        <!-- END PANEL -->
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
                                                <input type="text" placeholder="" value="https://customshortlink.com" class="form-control input-lg" id="icon-filter" name="icon-filter">
                                            </div>
                                            <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                                                <button type="button" class="btn btn-success btn-lg btn-large fs-15">Copy Link</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- Modal -->
                        @if (Session::has('success'))
                        <div class="padding-20 bg-white">
                            <ul class="pager wizard">
                                <li class="next"  style="display: {{ Session::get('success') }};" id="errordiv">
                                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success') }};">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content-wrapper">
                                                <div class="modal-content">
                                                    <button type="button" class="close" onclick="hideErrorDiv();"><i class="pg-close fs-14"></i>
                                                    </button>
                                                    <div class="container-xs-height full-height">
                                                        <div class="row-xs-height">
                                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                                <h5 class="text-success "><span class="semi-bold">Success!</span> invoice has been deleted .</h5>
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
        <!--<script src="{{URL::to('/')}}/dashboard/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>  -->
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
        <link class="main-stylesheet" href="{{URL::to('/')}}/js/extra/common.css" rel="stylesheet" type="text/css" />
        <script src="{{URL::to('/')}}/js/extra/common.js"></script>
        <script src="{{URL::to('/')}}/js/extra/save_invoice.js"></script>
        <!-- END PAGE LEVEL JS -->
        <script>
            $(document).ready(function() {
            	$('#datepicker-range').datepicker();
            });
        </script>
        @include('includes.dashboard.scripts')
    </body>
</html>
