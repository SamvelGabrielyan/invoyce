<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Choose Invoice Type | Invoyce</title>
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
                    <div class="jumbotron hidden-xs" data-pages="parallax">

                        <div class="container-fluid container-fixed-lg">
                            <div class="inner">
                                <!-- START BREADCRUMB -->
                                <ul class="breadcrumb">
                                    <li><a href="#" class="active">Choose an Invoice Type...</a>
                                    </li>
                                </ul>

                                <!-- END BREADCRUMB -->
                                <?php /*
                                  <div class="container-md-height m-b-20">
                                  <div class="row row-md-height">
                                  <div class="col-lg-6 col-md-6 col-md-height col-middle">
                                  <!-- START PANEL -->
                                  <div class="full-height">
                                  <div class="panel-body text-center">
                                  <img src="<?=url('')?>/assets/images/account-setup.jpg" class="img-responsive" style="border:10px solid white" />
                                  </div>
                                  </div>
                                  <!-- END PANEL -->
                                  </div>
                                  <div class="col-lg-5 col-md-height col-md-6 col-top">
                                  <!-- START PANEL -->
                                  <div class="panel panel-transparent">
                                  <div class="panel-heading">
                                  <div class="panel-title">Getting started
                                  </div>
                                  </div>
                                  <div class="panel-body">
                                  <h3>How it Works</h3>
                                  <p>You can choose three different types of invoices that you can send to your clients. There are standard, scheduled, subscription and recurring invoices. Each one is explained in more detail below.
                                  </p>
                                  <br>
                                  <div>
                                  <div class="profile-img-wrapper m-t-5 inline">
                                  <img width="35" height="35" src="{{URL::to('/')}}/dashboard/assets/img/jon.jpg" alt="" data-src="{{URL::to('/')}}/dashboard/assets/img/jon.jpg" data-src-retina="{{URL::to('/')}}/dashboard/assets/img/jon.jpg">
                                  <div class="chat-status available">
                                  </div>
                                  </div>
                                  <div class="inline m-l-10">
                                  <p class="small hint-text m-t-5">Jon Taggart - Founder<br><a href="mailto:help@invoyce.me">help@invoyce.me</a></p>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  <!-- END PANEL -->
                                  </div>
                                  </div>
                                  </div><?php */ ?>
                            </div>
                        </div>
                    </div>
                    <!-- END JUMBOTRON -->
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg">
                        <div class="panel panel-transparent">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading separator">
                                                <div class="panel-title">
                                                    <i class="fal fa-bolt"></i> Send Out Immediately 
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class="col-heading4">
                                                    <span class="semi-bold">Standard</span> Invoice</h3>
                                                <p>This is the bread and butter of invoices. This one is pretty straightforward.</p> <p>You will be walked through each step to create the invoice and when you're ready it will be emailed directly to your client. </p>
                                                <p>This is the most popular type of invoice.</p>

                                                <hr>
                                                <a href="{{URL::to('/')}}/dashboard/invoices/standard-invoice" class="btn btn-success btn-cons btn-block button4block">Create Standard Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading separator">
                                                <div class="panel-title">
                                                    <i class="fal fa-calendar-alt"></i> Send at a Future Date & Recurring
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class="col-heading4">
                                                    <span class="semi-bold">Scheduled</span> Invoices</h3>
                                                <p>This type of invoice can make your life a lot easier if you need to be able to schedule when invoices should be emailed to your client automatically. </p>
                                                <p>You can schedule an individual invoice to be sent out at a future date, as well as schedule recurring invoices.</p>
                                                <hr>
                                                <a href="{{URL::to('/')}}/dashboard/invoices/scheduled-invoice" class="btn btn-success btn-cons btn-block button4block">Create Scheduled Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading separator">
                                                <div class="panel-title">
                                                    <i class="fal fa-credit-card"></i> Charge Cards Automatically
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class="col-heading4">
                                                    <span class="semi-bold">Subscription</span> Invoices</h3>
                                                <p>This is one of my favorite types of invoices because it allows me to easily get paid on invoices while I sleep. </p>
                                                <p>This invoice type will be sent to your client, but once they pay, their card will be stored securely and then will be charged automatically for the time period you set.</p>

                                                <hr>
                                                <a href="{{URL::to('/')}}/dashboard/invoices/subscription-invoice" class="btn btn-success btn-cons btn-block button4block">Create Subscription Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading separator">
                                                <div class="panel-title">
                                                    <i class="fal fa-calendar-alt"></i> Send at a Future Date & Recurring
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <h3 class="col-heading4">
                                                    <span class="semi-bold">Recurring</span> Invoices</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                                <hr>
                                                <a href="{{URL::to('/')}}/dashboard/invoices/recurring-invoice" class="btn btn-success btn-cons btn-block button4block">Create Recurring Invoice</a>
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
<!--FOOTER -->
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
<!-- END FOOTER -->
@include('includes.dashboard.scripts')
</body>
</html>