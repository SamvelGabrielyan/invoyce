<div class="overlay hide" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid"> 
          <!-- BEGIN Overlay Logo !--> 
          <img class="overlay-brand" src="{{url('/dashboard/assets/img/logo.png')}}" alt="logo" data-src="{{url('/dashboard/assets/img/logo.png')}}" data-src-retina="{{url('/dashboard/assets/img/logo.png')}}" width="78" height="22"> 
          <!-- END Overlay Logo !--> 
          <!-- BEGIN Overlay Close !--> 
          <a href="#" class="close-icon-light overlay-close text-black fs-16" id="js-overlay-search-close"> <i class="pg-close"></i> </a>
          <!-- END Overlay Close !--> 
        </div>
        <!-- END Overlay Header !-->
        <div class="container-fluid"> 
          <!-- BEGIN Overlay Controls id="overlay-search"  !-->
          <input class="no-border overlay-search bg-transparent demo"
                 id="js-overlay-search-input"
                 data-url="{{route('search')}}" placeholder="Search..."
                 autocomplete="off" spellcheck="false" autofocus >
          <br>
          <div class="inline-block m-l-10">
            <p class="fs-13">Press enter to search</p>
          </div>
          <!-- END Overlay Controls !--> 
        </div>
        <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
        <div class="container-fluid"> <br>
          <div class="search-results m-t-40">
            <p class="bold">Pages Search Results</p>
            <div class="row">
              <div class="col-md-6">
                <div id="invoice_list"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

{{ Html::script('/js/extra/search.js?')}}