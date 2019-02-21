<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Manage Scheduled Invoices | Invoyce</title>
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
                                <a href="{{URL::to('/')}}/dashboard/invoices/choose">Invoices</a>
                            </li>
                            <li><a href="#" class="active">Scheduled Invoices</a>
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
                                            <input type="text" class="input-sm form-control" value="{{$data['start_date']}}"  name="start" id="start_date" placeholder="Start Date"/>
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-sm form-control"  value="{{$data['end_date']}}" name="end" id="end_date" placeholder="End Date"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3"> <button type="button" onclick="filterStanDetails();" class="btn btn-success btn-block" style="margin-top:-2px; height: 34px;"><span class="hidden-xs">FILTER</span><span class="visible-xs"><i class="fa fa-fw fa-paper-plane-o"></i></span> </button></div>
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
                                                    <th style="width:1%;text-align: center;">INVOICE DATE</th>
                                                    <th style="width:8%;text-align: center;">Invoice #</th>
                                                    <th style="width:29%;text-align: center;">Title</th>
                                                    <th style="width:17%;text-align: center;">Client</th>
                                                    <th style="width:2%;text-align: center;">Status</th>
                                                    <th style="width:2%;text-align: center;">Paid Note</th>
                                                    <th style="width:10%;text-align: center;">Viewed</th>
                                                    <th style="width:15%;text-align: center;">Amount</th>
                                                    <th style="width:15%;text-align: center;">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($data['all_invoices']) > 0)
                                                @foreach($data['all_invoices'] as $key => $value)
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
                                                        @if($value->save_status==3)
                                                        <p style="color:#1EB343;">Paid</p>
                                                        @elseif ($value->save_status<3)
                                                        <p style="color:#ff0000;">Unpaid</p>
                                                        @elseif ($value->save_status==4)
                                                        <p style="color:#ff0000;">Cancelled</p>
                                                        @endif
                                                    </td>
                                                    <td class="v-align-middle">
                                                        <?php if($value->paid_note == 'stripe'){ ?>
                                                            <img width="50px" src="{{URL::to('/')}}/images/stripe.png">
                                                        <?php }elseif ($value->paid_note == 'paypal') { ?>
                                                            <img width="50px" src="{{URL::to('/')}}/images/paypal.png">
                                                        <?php }else{
                                                            echo $value->paid_note;
                                                        } ?>
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
                                                                    <a href="#"  data-toggle="modal" data-target="#modalSlideUp" onclick="viewPopup({{$value->id}});">View</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" data-target="#modalFillIn" onclick="getInvoiceLink({{$value->id}});" data-toggle="modal" >Invoice Link</a>
                                                                </li>
                                                                <?php if($value->save_status !=4 && $value->save_status !=3){?>
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/sendReminder/{{$value->id}}/3">Remind</a>
                                                                </li>
                                                                <?php } ?>
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/duplicate/{{$value->id}}">Duplicate</a>
                                                                </li>
                                                                <?php if($value->save_status !=4 && $value->save_status !=3){?>
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/update-scheduled-invoice/{{$value->id}}">Edit</a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($value->save_status !=4 && $value->save_status !=3){?>
                                                                <li>
                                                                    <a href="{{URL::to('/')}}/dashboard/invoices/cancel/{{$value->id}}/3">Cancel</a>
                                                                </li>
                                                                <?php } ?>
                                                               <?php if($value->save_status !=4 && $value->save_status !=3){?>
                                                                <li>
                                                                    <a href="#" id="modalPaid_id" data-value="{{$value->id}}" data-target="#modalPaid" data-toggle="modal" >Paid</a>
                                                                </li>
                                                                <?php } ?>
                                                                <!--<li>
                                                                    <a href="#">Cancel</a>
                                                                    </li>
                                                                    <li>
                                                                    <a href="#">Mark as Paid</a>
                                                                    </li>-->
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="8" style=" text-align: center;">  No scheduled invoices have been created or sent  </td>
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
                                            <form method="post" action="standardInvoiceAsPaid">
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
                                                <button type="button" id="js__textareacopybtn" class="btn btn-primary btn-lg btn-large fs-15">Copy Link</button>
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
                        @if (Session::has('valid'))
            
                            <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('valid') }};">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content-wrapper">
                                        <div class="modal-content">
                                            <a  class="close" href="{{route('scheduledInvoicesList')}}"><i class="pg-close fs-14"></i>
                                            </a>
                                            <div class="container-xs-height full-height">
                                                <div class="row-xs-height">
                                                    <div class="modal-body col-xs-height col-middle text-center   ">
                                                        <h5 class="text-success "><span class="semi-bold">Success!</span> Reminder has been sent successfully.</h5>
                                                        <br>
                                                        <a class="btn btn-default btn-block"  href="{{route('scheduledInvoicesList')}}">Close</a>
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
                                            <a  class="close" href="{{route('scheduledInvoicesList')}}"><i class="pg-close fs-14"></i>
                                            </a>
                                            <div class="container-xs-height full-height">
                                                <div class="row-xs-height">
                                                    <div class="modal-body col-xs-height col-middle text-center   ">
                                                        <h5 class="text-success "><span class="semi-bold">Success!</span> Invoice has been cancelled.</h5>
                                                        <br>
                                                        <a class="btn btn-default btn-block"  href="{{route('scheduledInvoicesList')}}">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-backdrop fade in"></div>
                        
                        @endif
                        <!-- Modal -->
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
        <div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog modal__width" id="modal_dailog_width">
            <div class="modal-content-wrapper">
                <div class="modal-content" id="popup_content">
                    <div class="modal-body text-left" id="popupPreview">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <!-- <script src="{{URL::to('/')}}/dashboard/assets/js/tables.js" type="text/javascript"></script> -->
        <script src="{{URL::to('/')}}/dashboard/assets/js/scripts.js" type="text/javascript"></script>
        <script src="{{URL::to('/')}}/js/extra/manageScheduledList.js?1251"></script>
        <script src="{{URL::to('/')}}/js/extra/common.js?2223"></script>
        <script src="{{ URL::to('/')}}/assets/js/dashboard.js"></script>
        <script>
            $(document).ready(function() {
            $('#datepicker-range').datepicker();
            });
            $(document).on('click', '#modalPaid_id', function (e) {
                var value = $(this).attr('data-value');
                $('#mark_paid_id').val(value);
            });
        </script>
        <!-- END PAGE LEVEL JS -->
        @include('includes.dashboard.scripts')
    </body>
</html>
