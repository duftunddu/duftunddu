@extends('layouts.app')

<title>{{_('Services Dashboard | The Fragrance Hub | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/service_home.css') }}" rel="stylesheet">

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
</head>

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{_('Services Dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Service Users --}}

                    {{-- Brand --}}
                    @hasrole('brand_ambassador')
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('/ambassador_home') }}'">
                                {{ __('Brand Ambassador Dashboard') }}
                            </button>
                        </div>
                    </div><br>
                    @endhasrole
                    
                    {{-- Store --}}
                    {{-- Change to shop_owner --}}
                    @hasrole('shop_owner')
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('/store_home') }}'">
                                {{ __('Shop Dashboard') }}
                            </button>
                        </div>
                    </div><br>    
                    @endhasrole

                    {{-- Online Store --}}
                    {{-- Change to webstore_owner --}}
                    @hasrole('webstore_owner')
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ url('/webstore_home') }}'">
                                {{ __('Webstore Dashboard') }}
                            </button>
                        </div>
                    </div><br>    
                    @endhasrole

                    {{-- Button: Service Register --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/services_register') }}'">
                                {{ __('Register A Service') }}
                            </button>
                        </div>
                    </div><br>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection