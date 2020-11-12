@extends('layouts.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>

<link href="{{ asset('css/try.css') }}" rel="stylesheet">

@section('content')

<body class="no-scroll-y">
	
	<!-- Preloader -->
	<section>
		<div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="animation-preloader">
					<div class="spinner"></div>
					<div class="txt-loading">
						<span data-text-preloader="L" class="letters-loading">
							L
						</span>
						
						<span data-text-preloader="O" class="letters-loading">
							O
						</span>
						
						<span data-text-preloader="A" class="letters-loading">
							A
						</span>
						
						<span data-text-preloader="D" class="letters-loading">
							D
						</span>
						
						<span data-text-preloader="I" class="letters-loading">
							I
						</span>
						
						<span data-text-preloader="N" class="letters-loading">
							N
						</span>
						
						<span data-text-preloader="G" class="letters-loading">
							G
						</span>
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>
	</section>
	
</body>

<script src="{{ asset('js/try.js') }}" defer></script>

@endsection
