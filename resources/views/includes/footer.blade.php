<section class="p-b-30 p-t-40 bg-master-darkest">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<img src="{{url('/assets/images/logo-white.png')}}" class="logo" width="200" alt="">
				<div class="m-t-10 ">
					<ul class="no-style fs-11 no-padding font-arial">
						<li class="inline no-padding"><a href="{{route('index')}}" class="link text-white p-r-10 b-r b-transparent-white">Home</a></li>
						<li class="inline no-padding"><a href="{{route('termsCondition')}}" class="link text-white p-l-10 p-r-10 b-r b-transparent-white">Terms & Conditions</a></li>
						<li class="inline no-padding"><a href="{{route('privacyPolicy')}}" class="link text-white p-l-10 p-r-10 b-r b-transparent-white">Privacy Policy</a></li>
						<li class="inline no-padding"><a href="javascript:void(0)" class="link text-white p-l-10 p-r-10 xs-no-padding xs-m-t-10">Support</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 text-right font-arial sm-text-left">
				<ul class="no-style fs-12 no-padding pull-right xs-pull-left xs-m-t-20">
					<li class="inline no-padding"><a class="text-white p-l-30 fs-16 xs-no-padding" href="https://www.facebook.com/invoyceme/" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li class="inline no-padding"><a class="text-white p-l-30 fs-16" href="https://twitter.com/invoyceme" target="_blank"><i class="fa fa-twitter"></i></a></li>
				</ul>
				<div class="clearfix"></div>
				<p class="fs-11 muted text-white m-t-5">Copyright &copy; 2017 - {{date('Y')}} Invoyce LLC. All Rights Reserved.</p>
			</div>
		</div>
	</div>
</section>



<!-- start olark code -->
<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('3429-369-10-7722');</script>
<!-- end olark code -->
<!-- END FOOTER -->
<!-- BEGIN VENDOR JS -->
{{ Html::script('/assets/plugins/jquery/jquery-1.11.1.min.js')}}
{{ Html::script('/assets/plugins/bootstrap/js/bootstrap.min.js')}}
{{ Html::script('/pages/js/pages.frontend.js')}}
{{ Html::script('/assets/js/custom.js?'.time())}}
{{ Html::script('/js/extra/common.js?'.time())}}
{{ Html::script('/js/sweetalert.min.js')}}
{{ Html::script('/assets/js/index.js')}}
{{ Html::script('/assets/js/fontawesome-all.js')}}
<?php /*?><?php */?>
