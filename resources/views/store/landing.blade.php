@extends('layouts.app')

<title>{{_('Store | The Fragrance Hub | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/brand_ambassador_home.css') }}" rel="stylesheet">

    {{-- Full Screen Buttons --}}
    <script src="{{ asset('js/full_screen_buttons.js') }}" defer></script>

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

</head>

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">{{_('Duft Und Du at Store')}}</div>

                <div class="card-body">
                   
                    <br>

                    {{-- Button: Begin --}}
                    <div class="form-group row">
                        <div class="center">
                            <button type="button" class="custom" onclick="window.location='{{ url('/store_profile') }}'">
                                <span class="before">{{_('Begin')}}</span>
                                <span class="after">{{_('Begin')}}</span>
                            </button>
                        </div>
                    </div>

                    <br>

                    {{-- Button: Exit --}}
                    <div class="form-group row">
                        <div class="center">
                            <button type="button" class="custom" onclick="window.location='{{ url('/store_stats') }}'">
                                <span class="before">{{_('Exit')}}</span>
                                <span class="after">{{_('Exit')}}</span>
                            </button>
                        </div>
                    </div>
                    <br>

                    {{-- Button: Full Screen --}}
                    {{-- <button id="fs-doc-button">Go Fullscreen</button>
                    <button id="fs-exit-doc-button">Exit Fullscreen</button> --}}


                    {{-- Checkbox --}}
                    {{-- TODO: Create the checkbox which will logout on fullscreen exit--}}
                    {{-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="exit_on_logout" id="exit_on_logout">

                                <label class="form-check-label" for="exit on logout">
                                    {{ __('Logout On Exit') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    checkbox to ask if the user wants to logout when exiting fullscreen
                    Access will only be allowed on this page. If you close the page, you will have to login again. --}}

                    {{-- <br> --}}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection