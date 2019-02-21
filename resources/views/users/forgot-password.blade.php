@extends('layouts.auth')
@section('content')
<!-- BEGIN JUMBOTRON -->
<div class="login-wrapper " style="height: 100% !important;">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{url('/dashboard/assets/img/seattle.jpg')}}" data-src="{{url('/dashboard/assets/img/seattle.jpg')}}" data-src-retina="{{url('/dashboard/assets/img/seattle.jpg')}}" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white">
                Invoyce makes it ridiculously easy to send invoices & get paid fast <i class="fal fa-bolt"></i></h2>
            <p class="small">
                Images displayed are solely for representation purposes only. All work copyright of respective owner, otherwise &copy; {{date('Y')}} Taggart Media Group LLC.
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->
    <!-- START Login Right Container-->
	<div class="login-container bg-white">
				<div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
					<div class="center" style="text-align:center;">
						 <a href="{{url('/')}}"><img src="{{url('/dashboard/assets/img/logo_2x.png')}}" alt="logo" data-src="{{url('/dashboard/assets/img/logo_2x.png')}}" data-src-retina="{{url('/dashboard/assets/img/logo_2x.png')}}" width="250"></a>
					</div>
					<h3 class="text-center">Reset Your Password</h3>
					<p class="p-t-2 text-center">Please enter your email address. You will receive a link to create a new password.</p>
					<!-- START Login Form -->
					{!!Form::open(['url' => route('forgotPasswordPost'),'method'=>'POST'])!!}
                    {!!drawErrors()!!}
						<!-- START Form Control-->
						<div class="form-group form-group-default">
							{!!Form::label('Email Address', 'Email Address*')!!}
							<div class="controls">
								{!!Form::text('email', '', ['class'=>'form-control','placeholder'=>'Email'])!!}
							</div>
						</div>
						<!-- END Form Control-->
						<!-- START Form Control-->
						<button class="btn btn-block btn-success btn-cons m-t-10" type="submit">Submit</button>
					{{ Form::close() }}
					<!--END Login Form-->
					<div class="pull-bottom sm-pull-bottom">
						<div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
							<div class="col-sm-12 no-padding m-t-10">
								<p>
									<small>
										Welcome to Invoyce. If you don't already have an account you can create one here for FREE. Click to <a href="{{route('register')}}">Create an Account.</a>
									</small>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
    <!-- END Login Right Container-->
</div>
@stop