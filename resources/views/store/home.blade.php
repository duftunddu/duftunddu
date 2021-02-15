@extends('layouts.app')

<title>{{_('Store Dashboard | The Fragrance Hub | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/store_home.css') }}" rel="stylesheet">
</head>

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{_('Store Dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- User Review --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-lux-lipstick-red" onclick="window.location='{{ url('/store_call') }}'">
                                User Review
                            </button>
                        </div>
                    </div><br>

                    {{-- Total Fragrances --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <h5>Total Fragrances: {{__($no_of_f)}}</h5>
                        </div>
                    </div><br>

                    {{-- Stock Suitability --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-lux-pastel-purple" onclick="window.location='{{ url('/stock_suitability') }}'">
                                Stock Suitability
                            </button>
                        </div>
                    </div><br>

                    {{-- Stock --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('/stock') }}'">
                                Stock
                            </button>
                        </div>
                    </div><br>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection