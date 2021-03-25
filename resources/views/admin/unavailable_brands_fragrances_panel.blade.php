@extends('layouts.app')

<title>{{('Unavailable Brand & Fragrances Panel | Admin Panel | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/unavailable_brands_fragrances_panel.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Unavailable Brand & Fragrances')}}</div>

                <div class="card-body">
                    <div class="center">
                        
                        {{-- Brands --}}
                        <a href="{{ url("/add_brand_mod/Brand Name") }}"><h4 class="lux-black-font">Brands</h4></a>
                        @foreach($brands as $brand)
                            <h5>
                                <a href="{{ url("/add_brand_mod/" . $brand) }}">{{ $brand }}</a><br>
                            </h5>
                        @endforeach

                        <br><br>

                        {{-- Fragrances --}}
                        <a href="{{ url("/add_fragrance_mod/Fragrance Name") }}"><h4 class="lux-black-font">Fragrances</h4></a>
                        @foreach($fragrances as $fragrance)
                            <h5>
                                <a href="{{ url("/add_fragrance_mod/" . $fragrance) }}">{{ $fragrance }}</a><br>
                            </h5>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection