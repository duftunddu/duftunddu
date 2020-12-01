@extends('layouts.app')

<title>{{_('Ambassador Dashboard | The Fragrance Genie | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/brand_ambassador_home.css') }}" rel="stylesheet">

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
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

                    <br>
                    {{-- Chart --}}
                    @if($queries_data != NULL)
                    
                        @include('features.ambassador_dashboard_chart')<br>
                        
                    @else
                        <div class="form-group row mb-0">
                            <div class="center">
                                <h5>It looks empty in here...</h5>
                            </div>
                        </div>
                    @endif
                    <br>

                    {{-- Total Fragrances --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <h5>{{ __('Total Fragrances: ')}} {{__(count($fragrances))}}</h5>
                        </div>
                    </div>

                    <br>

                    {{--  Button: Add Fragrance --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('fragrance_entry') }}'">
                                {{ __('Add Fragrance') }}
                            </button>
                        </div>
                    </div>

                    <br>

                    {{-- All Fragrances --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('fragrances/'.$ambassador->brand_id) }}'">
                                {{ __('All Fragrances') }}
                            </button>
                        </div>
                    </div>

                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection