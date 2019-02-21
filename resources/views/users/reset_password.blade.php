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
                Images displayed are solely for representation purposes only. All work copyright of respective owner, otherwise &copy; 2017 Taggart Media Group LLC.
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
            @if($error == '')
            <p class="p-t-35 text-center">Reset Your Invoyce account password below...</p>
            <!-- START Login Form -->
            	{!!Form::open(['url' => route('resetPasswordPost',$token),'method'=>'POST'])!!}
                {!!drawErrors()!!}
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    {!!Form::label('password', 'Password*')!!}
                    <div class="controls">
                        {!!Form::password('password', ['class'=>'form-control'])!!}
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    {!!Form::label('Confirm Password', 'Confirm Password*')!!}
                    <div class="controls">
                    	{!!Form::password('password_confirmation', ['class'=>'form-control'])!!}
                    </div>
                </div>
                <!-- START Form Control-->
                <!-- END Form Control-->
                <button class="btn btn-block btn-success btn-cons m-t-10" type="submit">Reset Password</button>
            {{ Form::close() }}
            @else
            <div class="alert alert-danger errordivMain"><span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >×</span>{!!$error!!}</div>
            
            @endif
            
            
            
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