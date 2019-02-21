@extends('layouts.default')
@section('content')
<!-- BEGIN HEADER -->
<nav class="header bg-header transparent-light " data-pages="header" data-pages-header="autoresize" data-pages-resize-class="dark">
    @include('includes.nav')
</nav>
<!-- END HEADER -->
<!-- Jon Sync Test -->
<section id="home" class="jumbotron last full-height xs-full-height z-index-10" data-pages="parallax" data-pages-bg-image="{{URL::to('/')}}/assets/images/Hero.jpg">
    <div class="container-xs-height full-height inner">
        <div class="col-xs-height col-middle text-left">
            <!-- START CONTENT -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="text-center sm-p-t-30">
                            <h1 class="text-uppercase">Get Paid Faster & Focus on What You do Best</h1>
                            <h4 class="hero-sub">
                                Sign up today for a FREE 7-day trial. No credit card required. </h4>
                            <br>
                            <h4 class="hero-sub-icons">
                                <i class="fal fa-check-square"></i> <span class="semi-bold">Standard</span> <span class="m-r-20">Invoices</span>

                                <i class="fal fa-check-square"></i> <span class="semi-bold">Scheduled</span> <span class="m-r-20">Invoices</span>

                                <i class="fal fa-check-square"></i> <span class="semi-bold">Subscription</span> <span class="m-r-20">Invoices</span></h4 >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="row">

                            <form id="form-login" class="m-t-20 sm-m-t-20 m-b-5 clearfix" role="form" method="POST" action="{{route('register')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="status" value="1">

                                <div class="col-sm-5   p-r-5 sm-p-r-15">
                                    <div class="form-group form-group-default col-sm-12">
                                        <label class="control-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control" required placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-sm-7  p-l-10 sm-p-l-15">
                                    <div class="form-group form-group-default input-group input-group-attached col-xs-12">
                                        <label class="control-label">Email Address</label>
                                        <input type="email" name="email_address" class="form-control" placeholder="Email" required>
                                        <span class="input-group-btn">
                                            <button class="btn btn-success  btn-cons" type="submit">Get Started</button>
                                        </span>
                                    </div>
                                    <p class="fs-12 pull-right text-right m-r-20 hidden-xs">*Send and get paid on unlimited invoices FREE for 7 days.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
</section>
<!-- END JUMBOTRON -->

<!-- START CONTENT SECTION -->
<section class=" p-t-60 sm-p-b-30" id="about">

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <h6 class="block-title m-b-0 ">About Us</h6>
                <h1 class="m-t-5">Why Use Invoyce?</h1>
                <p></p>
                <!--<p class="font-arial fs-12 hint-text m-t-20">Try it Today for FREE</p> -->

            </div>
        </div>
    </div>
</section>
<section class="container container-fixed-lg p-b-60">
    <div class="md-p-l-20 md-p-r-20 xs-no-padding">
        <div class="row">
            <div class="col-sm-4 xs-m-b-30">
                <!--<h2 class="font-montserrat no-margin text-uppercase p-l-30 sm-no-padding">$<span data-pages-animate="number" data-value="102345345" data-animation-duration="800">102,345,345</span></h2>
<h6 class="block-title fs-13 m-t-5 text-uppercase p-l-30 sm-no-padding muted">Invoices Paid</h6>-->
                <div class="row">
                    <div class="col-xs-5 text-right b-r b-grey">
                        <h6 class="block-title p-r-5 ">Try It Free <br> for 7 Days</h6>

                    </div>
                    <div class="col-xs-7 text-left">
                        <h6 class="block-title m-t-20 p-l-5"><a href="/register">Get started now</a></h6>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
            <div class="col-sm-8">
                <div class="sm-p-l-20 xs-no-padding">
                    <p>I was tired of using multiple invoicing platforms, so I built what I needed for my web design and development agency. I wanted to have different options of the invoices I can send out and more importantly, I wanted to spend the least amount of time trying to get paid by my clients. </p>
                    <p>Invoyce makes it ridiculously easy to send invoices and get paid fast!</p>

                    <p class="m-t-20 fs-14 font-arial hint-text pull-left">Jon Taggart, Founder & Customer
                    </p>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>

    </div>
</section>
<!-- START CONTENT SECTION -->
<section id="demo-content-3" class="jumbotron p-b-60 p-t-70 relative no-overflow bg-white hidden-xs">
    <img class="demo-browser-desktop visible-lg visible-xlg" src="assets/images/browser_desktop.jpg" data-pages="float" data-max-top-translate="0" data-max-bottom-translate="40" data-speed="0.1" data-delay="1000" data-curve="ease" alt="">
</section>
<!-- END CONTENT SECTION -->
<!-- END CONTENT SECTION -->
<section class="p-t-90 p-b-90 bg-master-darkest demo-story-block xs-p-t-20 xs-p-b-20">
    <div class="container text-center sm-p-t-20">
        <h6 class="block-title text-white m-b-0">No Risk FREE Trial</h6>
        <h3 class="text-white m-b-0 m-t-5">Send and get paid on unlimited invoices for 7 days absolutely free!</h3>
        <p class="font-arial fs-12 hint-text text-white m-t-5">No credit card required. Can't wait to hear what you think.</p>
        <a class="btn btn-success m-t-20 text-uppercase" href="<?=url('')?>/register">Try it Out Today</a>
    </div>
</section>

<!-- START CONTENT SECTION -->
<section class=" p-b-85 p-t-75 p-b-65 p-t-55 text-center" id="features">
    <div class="container">
        <div class="md-p-l-20 xs-no-padding clearfix">
            <div class="col-sm-4 no-padding">
                <div class="p-r-40 md-pr-30 xs-no-padding clearfix">
                    <img src="assets/images/invoice.png" class="m-b-20" height="60" alt="">
                    <h4 class="p-b-5"><span class="semi-bold">Standard</span> Invoices</h4>
                    <p class="m-b-30">It's pretty straightforward with this one. Create you invoice, we send it to your client and they pay you directly. </p>
                    <a href="/register" class="btn btn-success btn-cons text-uppercase">Get Started Today</a>
                </div>
                <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
            </div>
            <div class="col-sm-4 no-padding">
                <div class="p-r-40 md-pr-30 xs-no-padding clearfix">
                    <img src="assets/images/calendar.png" class="m-b-20" height="60" alt="">
                    <h4 class="p-b-5"><span class="semi-bold">Scheduled</span> Invoices</h4>
                    <p class="m-b-30">This option allows you to schedule future invoices and also allows you to schedule recurring invoices for your clients.</p>
                    <a href="/register" class="btn btn-success btn-cons text-uppercase">Get Started Today</a>
                </div>
                <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
            </div>
            <div class="col-sm-4 no-padding">
                <div class="p-r-40 md-pr-30 xs-no-padding clearfix">
                    <img src="assets/images/repeat.png" class="m-b-20" height="60" alt="">
                    <h4 class="p-b-5"><span class="semi-bold">Subscription</span> Invoices</h4>
                    <p class="m-b-30">Have an invoices that need to charge your clients card automatically? This option will get you paid while you sleep.</p>
                    <a href="/register" class="btn btn-success btn-cons text-uppercase">Get Started Today</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTENT SECTION -->
<!-- START CONTENT SECTION -->
<section id="testimonials" class="p-b-50 p-t-50 bg-master-lightest">
    <div class="text-center">
        <img src="<?=url('')?>/assets/images/quotes.png" alt="">
        <h6 class="font-montserrat text-uppercase hint-text fs-15 text-center">What Our Customers Think</h6>
        <h1 class="m-t-5">Testimonials</h1>
    </div>
    <!-- BEGIN TESTIMONIALS SLIDER-->
    <div class="container">
        <div class="swiper-container m-t-60">
            <div class="swiper-wrapper">
                <div class="container content">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> <!-- Indicators -->

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <!-- BEGIN TESTIMONIAL -->
                                <div class="swiper-slide bg-transparent">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <h4 class="text-center light test_msg">
                                                    "Invoyce is the single best decision I have made this year. Now I know when clients see the invoices and pay them instantly. It also allows us to take credit cards easily and get paid quickly. The platform is well thought out and easy to use. I sent out 10 invoices in the first month and was paid early on ALL of them! I will be a lifelong user."
                                                </h4>
                                                <h5 class="hint-text fs-16">- Tyler Barnett</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- END TESTIMONIAL -->
                            </div>

                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#" data-target="#carousel-example-generic" data-slide="prev">
                            <div class="swiper-button-prev"><i class="fa fa-arrow-circle-o-left"></i></div> </a>
                        <a class="right carousel-control" href="#" data-target="#carousel-example-generic" data-slide="next">
                            <div class="swiper-button-next"><i class="fa fa-arrow-circle-o-right"></i></div>
                        </a> </div>
                </div>


            </div>
            <!-- Add Navigation -->


        </div>
    </div>
    <!-- END TESTIMONIALS -->



    <style>
        .test_msg{ min-height:70px !important; padding:0px 25px;}
        .carousel-control{ color:#000 !important; width:5%; }
        .carousel-control:hover, .carousel-control:focus{ color:#1EB343; }
        .carousel-control.left, .carousel-control.right { background-image: none; }
        .carousel-control.right { right:15px !important;}
        @media screen and (max-width: 768px) { .media-object{ margin-top:0; } }
        .no-img{background: none !important;left:10px !important ;top:0px !important;font-size:20px !important;}
    </style>


</section>
<!-- END CONTENT SECTION -->
<section class="p-b-65 p-t-65" id="pricing">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 text-center m-b-40">
                        <h6 class="block-title m-b-0 ">How Much Does it Cost?</h6>
                        <h1 class="m-t-5">Super Simple Pricing</h1>
                    </div>
                    <div class="col-sm-5 sm-m-t-30">
                        <div class="p-r-65 md-p-l-0 md-p-r-10 sm-m-t-20">
                            <div class="b-black b-a text-center b-rad-md no-overflow">
                                <div class="bg-black p-t-30 p-b-30">
                                    <h5 class="block-title text-white no-margin">JUST</h5>
                                    <h1 class="font-montserrat no-margin text-white">$19</h1>
                                    <p class="text-white no-margin fs-14">per month</p>
                                </div>
                                <div class="p-t-20 p-b-20">
                                    <p class="semi-bold">What's Included?</p>
                                    <ul class="list-unstyled p-l-60 p-r-60  sm-p-l-10 sm-p-r-10 hint-text m-t-20">
                                        <li class="b-b b-grey">
                                            <p class="font-arial fs-14 no-margin p-t-5 p-b-5">Unlimited Invoices</p>
                                        </li>
                                        <li class="b-b b-grey">
                                            <p class="font-arial fs-14  no-margin p-t-5 p-b-5">Detailed Reporting</p>
                                        </li>
                                        <li class="b-b b-grey">
                                            <p class="font-arial fs-14 no-margin p-t-5 p-b-5">No Transaction Fees</p>
                                        </li>
                                        <li class="b-b b-grey">
                                            <p class="font-arial fs-14 no-margin p-t-5 p-b-5">Fast Deposits</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="bg-master-lighter p-t-20 p-b-20">
                                    <a class="btn b btn-success" href="#">Get Started for Free</a>

                                    <p class="small hint-text m-t-15 m-b-5">*No credit card required </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7  sm-p-t-20 ">
                        <div class="p-t-50">
                            <dl>
                                <dt class="block-title p-b-15 text-black">Unlimited Invoices <i class="pg-arrow_right m-l-10"></i></dt>
                                <dd class="m-b-30">Send and get paid on unlimited invoices.</dd>
                            </dl>
                            <dl>
                                <dt class="block-title p-b-15 text-black">Detailed Reporting <i class="pg-arrow_right m-l-10"></i></dt>
                                <dd class="m-b-30">Know exactly what is going on with your invoices. </dd>
                            </dl>
                            <dl>
                                <dt class="block-title text-black p-b-15 ">No Trasaction Fees <i class="pg-arrow_right m-l-10"></i></dt>
                                <dd class="m-b-30">We do not charge any transaction fees. </dd>
                            </dl>
                            <dl>
                                <dt class="block-title text-black p-b-15 ">Fast Deposits <i class="pg-arrow_right m-l-10"></i></dt>
                                <dd class="m-b-30">Money is deposited quickly so you can focus on what you do best.  </dd>
                            </dl>
                        </div>
                        <hr>
                        <div class="row m-t-40">
                            <div class="col-xs-5 text-right b-r b-grey">
                                <h6 class="block-title p-r-5 ">Free 7-Day Trial</h6>
                                <h6 class="block-title hint-text p-r-5"><small>*no credit card required</small></h6>
                            </div>
                            <div class="col-xs-7 text-left">
                                <h6 class="block-title m-t-20 p-l-5"><a href="/register">Get started today</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fixed-lg p-t-70 p-b-80  sm-p-t-30 sm-p-b-30 bg-master-lightest" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <h4>Have a question or need support? <br>
                            We can help.
                        </h4>
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <br class="visible-md visible-xs">
                        <address class="text-master m-t-5">Use the form on the right to send us a message<br> and a member of our team will get back to you <br>right away.</address>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <br class=" visible-xs">
                <br class="visible-xs">
                <h4 class="sm-m-t-20">Fill out the form below</h4>
                <!-- @if (Session::has('success'))
                <div class="alert alert-success" id='errordiv'>{{ Session::get('success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >×</span></div>
                @endif -->
                <div id="response_div">
                
                </div>
                <div id="form-content">						
                <div id="new-form">
                {!!Form::open(['url' => route('contactUsPost'),'id'=>'contactSubmitForm','method'=>'POST'])!!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                {!!Form::label('name', 'Name*', ['class' => 'control-label'])!!}
                                {!!Form::text('name', '', ['class'=>'form-control','placeholder'=>'Name','required'=>'true'])!!}
                              </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                {!!Form::label('email', 'Email*', ['class' => 'control-label'])!!}
                                {!!Form::email('email', '', ['class'=>'form-control','placeholder'=>'Email','required'=>'true'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-default">
                        {!!Form::label('message', 'Message*', ['class' => 'control-label'])!!}
                        {!!Form::textarea('message', '', ['class'=>'form-control','placeholder'=>'What can we help you with?','style'=>'height:100px','required'=>'true'])!!}
                                
                    </div>
                     <div class="form-group">
                     	{!!Form::label('humen', 'Are you human?*', ['class' => 'control-label'])!!}
                        {!! app('captcha')->display() !!}
                    </div>
                    <button type="submit" id="contactSubmit"<?php /*?> onClick="sendcontectUs(this.id)"<?php */?>  class="btn btn-success font-montserrat all-caps fs-11 pull-left sm-m-t-10">Send Message</button>
                    <div class="clearfix"></div>
                {{ Form::close() }}
                </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- START FOOTER -->
@stop      