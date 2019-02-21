@extends('layouts.auth')
@section('page_level_style')
	{{ Html::style('css/bootstrap-select.min.css')}}
    {{ Html::style('dashboard/assets/plugins/font-awesome/css/font-awesome.css')}}
    {{ Html::script('/assets/js/fontawesome-all.js')}}
@endsection
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
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-20 m-t-10 sm-p-l-15 sm-p-r-15 sm-p-t-40 m-b-30">
            <div class="center" style="text-align:center;">
               <a href="{{url('/')}}"><img src="{{url('/dashboard/assets/img/logo_2x.png')}}" alt="logo" data-src="{{url('/dashboard/assets/img/logo_2x.png')}}" data-src-retina="{{url('/dashboard/assets/img/logo_2x.png')}}" width="250"></a>
            </div>
            <h3 class="text-center">Start Your 7-Day FREE Trial</h3>
            <p class="font-arial fs-12 hint-text m-t-5 text-center">
                No credit card required. Can't wait to hear what you think.</p>
            <!-- START Login Form -->
			
            {!!Form::open(['url' => route('registerPost'),'method'=>'POST','class'=>'p-t-15','accept-charset'=>'UTF-8'])!!}
            {!!drawErrors()!!}
            <div class="row">
                <div class="col-sm-12">
                    <span id="fname_error" class="error-message" style="display: none;"></span>
                    <div class="form-group form-group-default">
                        {!!Form::label('first name', 'First Name*')!!}
                        {!!Form::text('first_name',$first_name, ['class'=>'form-control','placeholder'=>'First Name'])!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <span id="lname_error" class="error-message"  style="display: none;"></span>
                    <div class="form-group form-group-default">
                        {!!Form::label('last name', 'Last Name*')!!}
                        {!!Form::text('last_name', '', ['class'=>'form-control','placeholder'=>'Last Name'])!!}
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <span id="company_error" class="error-message"  style="display: none;"></span>
                    <div class="form-group form-group-default">
                    	{!!Form::label('Company Name', 'Company Name*')!!}
                        {!!Form::text('company_name', '', ['class'=>'form-control','placeholder'=>'Company Name'])!!}
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!!Form::label('Industry', 'Industry*')!!}
                        {!!Form::select('industry', $Industries, '', ['class'=>'form-control selectpicker','data-live-search'=>'true'])!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <span id="reg_email_error" class="error-message"  style="display: none;"></span>
                    <div class="form-group form-group-default">
                        {!!Form::label('Email', 'Email*')!!}
                        {!!Form::text('email', $email_address, ['class'=>'form-control','placeholder'=>'Email'])!!}
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        {!!Form::label('Password', 'Password*')!!}
                        {!!Form::password('password', ['class'=>'form-control'])!!}
                    </div>
                </div>
            </div>

            <div class="row m-t-10">
                <div class="col-md-12">
                    <div class="checkbox check-success">
                        <input type="checkbox" name="term_and_condition" id="term_and_condition">
                        <label for="term_and_condition">I agree to the <a href="{{route('termsCondition')}}" class="text-info small" target="_blank"> Terms & Conditions </a> and <a href="{{route('privacyPolicy')}}" class="text-info small" target="_blank">Privacy Policy</a>.</label>
                    </div>
                </div>

            </div>
            <button class="btn btn-block btn-success btn-cons m-t-10" type="submit">Create My Account</button>

            {!!Form::close()!!}

            <!--END Login Form-->

        </div>
    </div>
    <div class="clearfix"></div>

    <!-- END Login Right Container-->
</div>
@section('page_level_script')
{{ Html::script('js/bootstrap-select.min.js')}}
{{Html::script('dashboard/assets/plugins/jquery-validation/js/jquery.validate.min.js')}}
<script>
    $(function()
      {
        $('#form-login').validate()
    })
</script>
<script>

$(document).ready(function(e) {
    
});
</script>
@endsection
@stop