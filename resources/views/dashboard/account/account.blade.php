<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Account Settings | Invoyce</title>
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
                    <!-- START JUMBOTRON -->
                    <div class="jumbotron" data-pages="parallax">
                        <div class="container-fluid container-fixed-lg">
                            <div class="inner">
                                <!-- START BREADCRUMB -->
                                <ul class="breadcrumb">
                                    <li>
                                        <a href="#" >Account</a>
                                    </li>
                                    <li>
                                        <a href="#" class="active">Account Settings</a>
                                    </li>
                                </ul>
                                <!-- END BREADCRUMB -->
                                <div class="container-md-height m-b-20">
                                    <div class="row row-md-height">

                                        <div class="col-lg-4 col-md-height col-md-6 col-top">
                                            <!-- START PANEL -->
                                            <div class="panel panel-transparent">
                                                <div class="panel-heading">
                                                    <div class="panel-title">Updating Your Account
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <h3>How it Works</h3>
                                                    <p>This information will be added to the invoices that you send out to your client. Make sure to include the necessary fields.
                                                    </p>
                                                    <br>

                                                </div>
                                            </div>
                                            <!-- END PANEL -->
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-md-height col-middle ">
                                            <!-- START PANEL -->
                                            <div class="full-height">
                                                <!-- START PANEL -->
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">

                                                        <span class=" pull-left">
                                                            <div class="panel-title">
                                                                Account


                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="panel-body">
                                                        <h5>
                                                            Company Information
                                                        </h5>
                                                        <form class="" method="POST" role="form" id="form-profile" enctype="multipart/form-data" action="updateProfile">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default required">
                                                                        <label>First name</label>
                                                                        <input type="text" class="form-control" name="fname" value="{{$data['user_data']->first_name}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default required">
                                                                        <label>Last name</label>
                                                                        <input type="text" class="form-control" name="lname" value="{{$data['user_data']->last_name}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-default">
                                                                <label>Company Name</label>
                                                                <input type="text" class="form-control"  name="company" value="{{$data['user_data']->company}}" required>
                                                            </div>
                                                            <div class="form-group form-group-default">
                                                                <label>Tax ID</label>
                                                                <input type="text" class="form-control" name="tax_id" value="{{$data['user_data']->tax_id}}" >
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default required">
                                                                        <label>Email</label>
                                                                        <input type="text" class="form-control" name="email" value="{{$data['user_data']->email}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-group-default required">
                                                                        <label>Phone</label>
                                                                        <input type="text" class="form-control" name="phone" id="phone" value="{{$data['user_data']->phone}}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <h5>
                                                                Your Address
                                                            </h5>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Address</label>
                                                                        <input class="form-control" type="text" name="address" value="{{$data['user_data']->address}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4 col-xs-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>City</label>
                                                                        <input class="form-control" type="text" name="city" value="{{$data['user_data']->city}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-xs-12"  style="margin-bottom:10px;" >
                                                                    <div class="form-group form-group-default">
                                                                        <label>State</label>
                                                                        <input class="form-control" type="text" name="state" value="{{$data['user_data']->state}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-xs-12" >
                                                                    <div class="form-group form-group-default">
                                                                        <label>Zip Code</label>
                                                                        <input class="form-control" name="zip_code" value="{{$data['user_data']->zip_code}}" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <style>
                                                                .select2-container .select2-selection.select2-selection--single {
                                                                    height: 54px !important;
                                                                    border:1px solid rgba(0, 0, 0, 0.07) !important;
                                                                }
                                                                .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                                    color: #444;
                                                                    line-height: 45px !important;
                                                                }
                                                                .select2-container .select2-selection .select2-selection__arrow {
                                                                    top: 15px !important;
                                                                }
                                                            </style>
                                                            <br>
                                                            <h5>Upload Your Logo</h5>
                                                            <p class="fs-12 pull-left text-left">This will be shown on your invoices.</p>
                                                            <div class="clearfix"></div>
                                                            <div class="tools">
                                                                <a class="collapse" href="javascript:;"></a>
                                                                <a class="config" data-toggle="modal" href="#grid-config"></a>
                                                                <a class="reload" href="javascript:;"></a>
                                                                <a class="remove" href="javascript:;"></a>
                                                            </div>

                                                            <div class="panel-body no-scroll no-padding">
                                                                @if($data['user_data']->image!='')
                                                                <div style="padding: 5px 10px 10px 5px;"><img id="logo_output"  alt="" class="invoice-logo" data-src-retina="" data-src="{{ asset( 'profile/') .'/'. $data['user_data']->image }}" src="{{ asset( 'profile/') .'/'. $data['user_data']->image }}" width="160" class="img-flex"></div>

                                                                @else

                                                                <div style="padding: 5px 10px 10px 5px;"><img id="logo_output" alt="" class="invoice-logo" data-src-retina="" data-src="{{ asset( 'profile/') .'/'. $data['user_data']->image }}" src="{{ asset( 'profile/') .'/'. $data['user_data']->image }}" width="160" class="img-flex"></div>
                                                                @endif
                                                                <div class="fallback">
                                                                    <input name="image" type="file" onchange="loadFile(event)" />
                                                                    <span>Maximum Logo Size 250px * 90px  </span>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <button type="submit" class="btn btn-success btn-cons pull-right"><span>Save</span></button>

                                                        </form>
                                                        <div class="gap"></div>
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

                    <!-- NOTIFICATIONS -->
                    @if (Session::has('success'))
                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('success') }};">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content-wrapper">
                                <div class="modal-content">
                                    <a  class="close" href="{{route('account')}}"><i class="pg-close fs-14"></i>
                                    </a>
                                    <div class="container-xs-height full-height">
                                        <div class="row-xs-height">
                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                <h5 class="text-success "><span class="semi-bold">Success!</span> Your account information has been updated.
                                                    <span>.</h5>
                                                <br>
                                                <a type="button" class="btn btn-default btn-block"  href="{{route('account')}}">Close</a>
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
                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display: {{ Session::get('error')}};">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content-wrapper">
                                <div class="modal-content">
                                    <a  class="close" href="{{route('account')}}"><i class="pg-close fs-14"></i>
                                    </a>
                                    <div class="container-xs-height full-height">
                                        <div class="row-xs-height">
                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                <h5 class="text-success "><span class="semi-bold">Failed!</span> Email already exists.
                                                    <span>.</h5>
                                                <br>
                                                <a type="button" class="btn btn-default btn-block"  href="{{route('account')}}">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade in"></div>
                    @endif
                    <!--- Image logo Error -->
                    @if (Session::has('image-size-error'))
                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display:block;">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content-wrapper">
                                <div class="modal-content">
                                    <a  class="close" href="{{route('account')}}"><i class="pg-close fs-14"></i>
                                    </a>
                                    <div class="container-xs-height full-height">
                                        <div class="row-xs-height">
                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                <h5 class="text-success "><span class="semi-bold">Failed!</span>  {{ Session::get('image-size-error') }}
                                                    <span>.</h5>
                                                <br>
                                                <a type="button" class="btn btn-default btn-block"  href="{{route('account')}}">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade in"></div>
                    @endif
                    @if (Session::has('special-chars-error'))
                    <div class="modal fade slide-right in fadeInRightBig animated"  id="modalSlideLeft" tabindex="-1" role="dialog" aria-hidden="true" style="display:block;">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content-wrapper">
                                <div class="modal-content">
                                    <a  class="close" href="{{route('account')}}"><i class="pg-close fs-14"></i>
                                    </a>
                                    <div class="container-xs-height full-height">
                                        <div class="row-xs-height">
                                            <div class="modal-body col-xs-height col-middle text-center   ">
                                                <h5 class="text-success "><span class="semi-bold">Failed!</span>
                                                    @foreach(Session::get('special-chars-error') as $error)
                                                    {{ $error }}
                                                    @endforeach
                                                </h5>
                                                <br>
                                                <a type="button" class="btn btn-default btn-block"  href="{{route('account')}}">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade in"></div>
                    @endif
                </div>
                <!-- END PAGE CONTENT -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>

<script type="text/javascript">
    $(window).on('load', function (){
        var phones = [{"mask": "(###) ###-####"}, {"mask": "(###) ###-####"}];
        $('#phone').inputmask({
            mask: phones,
            greedy: false,
            definitions: {'#': {validator: "[0-9]", cardinality: 1}}
        });
    });
</script>


<script>
  var loadFile = function(event) {
    var output = document.getElementById('logo_output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

@include('includes.dashboard.scripts')
</body>
</html>