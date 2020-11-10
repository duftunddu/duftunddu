{{-- <title>Header</title> --}}

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<link href="{{ asset('css/header.css') }}" rel="stylesheet">

<body class="hero-anime">

    <div class="navigation-wrap bg-light start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">

                        {{-- <a class="navbar-brand" href="/" ><img src="https://assets.codepen.io/1462889/fcy.png" alt=""></a> target="_blank" --}}
                        <a class="navbar-brand" href="/" ><img src="../images/logo_header.png" alt=""></a> {{-- target="_blank" --}}

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">

                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">{{-- active --}}
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
                                        aria-expanded="false">Home</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="search_engine">Search Engine</a>
                                        {{-- <a class="dropdown-item" href="catalog">Catalog</a> --}}
                                        <a class="dropdown-item" href="about_us">About Us</a>
                                    </div>
                                </li>

                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="brand_ambassador"
                                        role="button" aria-haspopup="true" aria-expanded="false">Brand Ambassador</a>
                                    <div class="dropdown-menu">

                                        @unlessrole('new_brand_ambassador|brand_ambassador|premium_brand_ambassador')
                                        {{-- If not roles --}}
                                        <a class="dropdown-item" href="brand_ambassador_proposal">Join Us</a>
                                        <a class="dropdown-item" href="brand_ambassador_proposal">Advertise</a>
                                        {{-- Redirect to Join Us --}}
                                        @else
                                        {{-- If roles --}}
                                        @unlessrole('new_brand_ambassador')
                                        {{-- If not new_brand_ambassador  --}}
                                        <a class="dropdown-item" href="ambassador_home">Dashboard</a>
                                        <a class="dropdown-item" href="advertise">Advertise</a>
                                        @else
                                        {{-- If new_brand_ambassador  --}}
                                        <a class="dropdown-item" href="brand_entry">Add Brand</a>
                                        <a class="dropdown-item" href="application_status">Application Status</a>
                                        @endunlessrole
                                        @endunlessrole
                                        <a class="dropdown-item" href="#">Premium Features</a>

                                    </div>
                                </li>

                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                        role="button" aria-haspopup="true" aria-expanded="false">Insights</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Coming Soon</a>
                                    </div>
                                </li>

                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="faq">FAQ</a>
                                </li>

                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                        aria-haspopup="true" aria-expanded="false">Contact Us</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="request_brand_view">Request a Brand</a>
                                        <a class="dropdown-item" href="request_feature">Request a Feature</a>
                                        <a class="dropdown-item" href="#">Feedback</a>
                                        <a class="dropdown-item" href="#">Contact</a>
                                    </div>
                                </li>

                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4"></li>

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
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @hasrole('admin')
                                            <a class="dropdown-item" href="admin_links">Admin Links</a>
                                        @endhasrole
                                        <a class="dropdown-item" href="home">Dashboard</a>
                                        <a class="dropdown-item" href="#">Premium</a>

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

<!-- Link to page
	================================================== -->

{{-- <a href="https://front.codes/" class="logo" target="_blank">
		<img src="https://assets.codepen.io/1462889/fcy.png" alt="">
	</a> --}}

{{-- </body> --}}
{{-- Sleek Border Line --}}
{{-- <div>
		<span class="sleek-border"></span>
	</div>
--}}

<script src="{{ asset('js/header.js') }}"></script>