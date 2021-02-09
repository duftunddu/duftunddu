@extends('layouts.app')

<title>{{_('Webstore Dashboard | The Fragrance Hub | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/webstore_home.css') }}" rel="stylesheet">
</head>

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{_('Dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{-- Get User Review --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-lux-lipstick-red" onclick="window.location='{{ url('fragrance_entry/') }}'">
                                Get User Review
                            </button>
                        </div>
                    </div><br>

                    {{-- Calls Made --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <h5>Calls Made This Month: {{__($no_of_f)}}</h5>
                        </div>
                    </div><br>

                    {{-- Total Fragrances --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <h5>Total Fragrances: {{__($no_of_f)}}</h5>
                        </div>
                    </div><br>

                    {{-- Get Fragrance Suitability --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-lux-pastel-purple" onclick="window.location='{{ url('fragrance_suitability/') }}'">
                                Get Fragrance Suitability
                            </button>
                        </div>
                    </div><br>

                    {{--  Button: Add Fragrance --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('fragrance_entry/') }}'">
                                Add Fragrance
                            </button>
                        </div>
                    </div><br>

                    {{-- All Fragrances --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('fragrances/') }}'">
                                All Fragrances
                            </button>
                        </div>
                    </div><br>

                    {{-- Total Fragrances --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <h5>API Key: {{__($no_of_f)}}</h5>
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('fragrances/') }}'">
                                Edit API
                            </button>
                        </di
                        </div>
                    </div><br>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection