<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" defer>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

<link href="{{ asset('css/header.css') }}" rel="stylesheet">

{{-- For Search Icon In Header --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" defer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/solid.min.css" defer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/regular.min.css" defer>

<body class="hero-anime">

    <div class="navigation-wrap bg-light start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <a class="navbar-brand" href="/"><img style="float: left;" src="{{ asset('images/logo_header.png') }}" alt=""></a> {{-- target="_blank" --}}
                        <a class="dnd-name" href="/">Duft Und Du</a>
                        
                        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse"  --}}
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">

                                {{-- AI Genie --}}
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">{{-- active --}}
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
                                        aria-expanded="false">AI Genie</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/search_engine') }}"><span class="header-icon"><i class="fas fa-search"></i></span>Personalized Fragrance Review</a>
                                    </div>
                                </li>

                                @hasrole('service_user')
                                {{-- Connected Genie Services --}}
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                        role="button" aria-haspopup="true" aria-expanded="false">Genie Services</a>
                                    <div class="dropdown-menu">
                                        
                                        {{-- Dashboards --}}
                                        @hasrole('brand_ambassador')
                                        <a class="dropdown-item" href="{{ url('/ambassador_home') }}"><span class="header-icon"><i class="far fa-copyright"></i></span>Brand Dashboard</a>
                                        @endhasrole
                                        @hasrole('store_owner')
                                        <a class="dropdown-item" href="{{ url('/store_home') }}"><span class="header-icon"><i class="fas fa-store"></i></span>Shop Dashboard</a>
                                        @endhasrole
                                        @hasrole('webstore_owner')
                                        <a class="dropdown-item" href="{{ url('/webstore_home') }}"><span class="header-icon"><i class="fas fa-mobile-alt"></i></span>Online Store Dashboard</a>
                                        @endhasrole

                                        {{-- Application Status --}}
                                        @hasrole('new_brand_ambassador')
                                        <a class="dropdown-item" href="{{ url('/brand_entry') }}"><span class="header-icon"><i class="far fa-copyright"></i></span>Add Brand</a>
                                        <a class="dropdown-item" href="{{ url('/brand_ambassador_application_status') }}"><span class="header-icon"><i class="far fa-copyright"></i></span>Brand Application Status</a>
                                        @endhasrole
                                        @hasrole('new_store_owner')
                                        <a class="dropdown-item" href="{{ url('/store_application_status') }}"><span class="header-icon"><i class="fas fa-store"></i></span>Shop Application Status</a>
                                        @endhasrole
                                        @hasrole('new_webstore_owner')
                                        <a class="dropdown-item" href="{{ url('/webstore_application_status') }}"><span class="header-icon"><i class="fas fa-mobile-alt"></i></span>Online Store Application Status</a>
                                        @endhasrole

                                        <a class="dropdown-item" href="{{ url('/advertise_proposal') }}"><span class="header-icon"><i class="fas fa-ad"></i></span>Advertise</a>
                                        {{-- <a class="dropdown-item" href="#">Premium Features</a> --}}

                                    </div>
                                </li>

                                @else
                                {{-- Connect Genie Services --}}
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                        role="button" aria-haspopup="true" aria-expanded="false">Connect Genie</a>
                                    <div class="dropdown-menu">
                       
                                        <a class="dropdown-item" href="{{ url('/brand_ambassador_proposal') }}"><span class="header-icon"><i class="far fa-copyright"></i></span>With Brand</a>
                                        <a class="dropdown-item" href="{{ url('/store_proposal') }}"><span class="header-icon"><i class="fas fa-store"></i></span>With Shop</a>
                                        <a class="dropdown-item" href="{{ url('/webstore_proposal') }}"><span class="header-icon"><i class="fas fa-mobile-alt"></i></span>With Online Store</a>
                                        <a class="dropdown-item" href="{{ url('/services_register') }}"><span class="header-icon"><i class="far fa-handshake"></i></span>Register Your Service</a>                                        
                                        <a class="dropdown-item" href="{{ url('/advertise_proposal') }}"><span class="header-icon"><i class="fas fa-ad"></i></span>Advertise</a>
                                        {{-- <a class="dropdown-item" href="#">Premium Features</a> --}}

                                    </div>
                                </li>
                                @endhasrole

                                {{-- Participate --}}
                                {{-- <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                        role="button" aria-haspopup="true" aria-expanded="false">Participate</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Join Us</a>
                                        <a class="dropdown-item" href="#">Research</a>
                                    </div>
                                </li> --}}

                                {{-- Insights --}}
                                {{-- <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                        role="button" aria-haspopup="true" aria-expanded="false">Insights</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Coming Soon</a>
                                    </div>
                                </li> --}}

                                {{-- FAQ --}}
                                {{-- <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="/faq">FAQ</a>
                                </li> --}}

                                {{-- Contact Us --}}
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                        aria-haspopup="true" aria-expanded="false">Contact Us</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/faq') }}">FAQ</a>
                                        <a class="dropdown-item" href="{{ url('/about_us') }}">About Us</a>
                                        {{-- <a class="dropdown-item" href="{{ url('/request_brand_view') }}">Request a Brand</a> --}}
                                        {{-- <a class="dropdown-item" href="{{ url('/request_feature_view') }}">Request a Feature</a> --}}
                                        {{-- <a class="dropdown-item" href="{{ url('/feedback') }}">Feedback</a> --}}
                                        {{-- <a class="dropdown-item" href="{{ url('/report') }}">Report</a> --}}
                                        {{-- Add FB, Insta, Linkedin, email address to contact details  --}}
                                        <a class="dropdown-item" href="{{ url('/contact_details') }}">Contact Details</a>
                                        {{-- <a class="dropdown-item" href="#">Contact</a> --}}
                                    </div>
                                </li>

                                {{-- <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4"></li> --}}

                                <!-- Authentication Links -->
                                @guest
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                </li>
                                @endif
                                @else
                                {{-- <li class="nav-item dropdown"> --}}
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="far fa-user-circle"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @hasrole('admin')
                                            <a class="dropdown-item" href="{{ url('/admin_links') }}">Admin Links</a>
                                        @endhasrole
                                        @hasrole('moderator')
                                            <a class="dropdown-item" href="{{ url('/moderator_links') }}">Moderator Links</a>
                                        @endhasrole
                                        
                                        <a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a>
                                        {{-- <a class="dropdown-item" href="#">Premium Features</a> --}}

                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
															document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Title --}}
    {{-- <div class="section full-height">
		<div class="absolute-center">
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="col-12">
				<h1><span>B</span><span>o</span><span>o</span><span>t</span><span>s</span><span>t</span><span>r</span><span>a</span><span>p</span> <span>4</span><br>
				<span>m</span><span>e</span><span>n</span><span>u</span></h1>
				<p>scroll for nav animation</p>	
						</div>	
					</div>		
				</div>		
			</div>
			<div class="section mt-5">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div id="switch">
								<div id="circle"></div>
							</div>
						</div>	
					</div>		
				</div>			
			</div>
		</div>
	</div> --}}

    {{-- <div class="my-5 py-5">
	</div> --}}

    <div class="top-padding"></div>

</body>

<script src="{{ asset('js/header.js') }}"></script>