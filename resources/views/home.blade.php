@extends('layouts.app')

<title>{{_('Dashboard | AI Powered Fragrance Genie | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .col-md-5{
            /* position: relative;
            text-align: center; */
        }

        .center{
            display:flex;
            justify-content: center;
        }

        .accordion-title-button{
            position: absolute;
            left: 68%;
        }
        @media (max-width: 480px) {
            .accordion-title-button{
                position: absolute;
                left: 55%;
                
            }
            h4{
                font-size: 1.3rem !important;
            }
            .small-btn{
                /* width: 9rem; */
                /* height: 5rem; */
                font-size: 1rem !important;
            }
        }

        .margin-border{
            margin: 25px;
            text-align: justify;
        }
        .red-color{
            color: #f7527c;
        }
        .purple-color{
            color: #8167a9;
        }

        h4{
            /* display: inline; */
            display: inline-block;
            opacity: 1;
            transform: translate(0);
            transition: all 200ms linear;
            transition-delay: 700ms;
        }
        body.hero-anime h4{
            opacity: 0;
            transform: translateY(8px);
            transition-delay: 700ms;
        }
        h5{
            /* display: inline; */
            display: inline-block;
            opacity: 1;
            transform: translate(0);
            transition: all 200ms linear;
            transition-delay: 750ms;
        }
        body.hero-anime h5{
            opacity: 0;
            transform: translateY(10px);
            transition-delay: 750ms;
        }
        body.hero-anime button.btn{
            opacity: 0;
            transform: translateY(8px);
            transition-delay: 800ms;
        }

        p{
            opacity: 1;
            transform: translate(0);
            transition: all 250ms linear;
            transition-delay: 900ms;
        }
        body.hero-anime p{
            opacity: 0;
            transform: translateY(12px);
            transition-delay: 900ms;
        }

        small{
            opacity: 1;
            transform: translate(0);
            transition: all 250ms linear;
            transition-delay: 1000ms;
        }
        body.hero-anime small{
            opacity: 0;
            transform: translateY(50px);
            transition-delay: 1000ms;
        }
    </style>

    {{-- <link href="{{ asset('css/home_accordion.css') }}" rel="stylesheet" defer>
    <script src="{{ asset('js/home_accordion.js') }}" defer></script> --}}

    {{-- Button --}}
    {{-- <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet"> --}}

    {{-- Accordion: Requires JS. Currently coming from Preloader. --}}
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Card: User --}}
            <div class="card">
                <div class="card-header">{{_('User Dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <br>

                    {{--  Button: Add Fragrance Review --}}
                    <div class="form-group">
                        <div class="center">
                            <button type="button" class="btn btn-lux-lipstick-red" onclick="window.location='{{ url('/search_engine') }}'">
                                {{ __('Get Personalized Fragrance Review') }}
                            </button>
                        </div>
                    </div>

                    <br>

                    {{--  Button: Add Fragrance Review --}}
                    <div class="form-group">
                        <div class="center">
                            <button type="button" class="btn btn-lux-pastel-purple" onclick="window.location='{{ url('/fragrance_review_entry/') }}'">
                                Add Fragrance Review <br> (Give Back To The Community)
                            </button>
                        </div>
                    </div>


                    {{--  Button: Add Profile --}}
                    {{-- <div class="form-group row mb-0">
                        <div class="center">        
                            <button type="submit" class="btn btn-dark"  onclick="window.location='{{ url('profile') }}'">
                                {{ __('Add Profile') }}
                            </button>
                        </div>
                    </div> --}}

                </div>
            </div>

            {{-- CREATE AN ACCORDION FOR PROFILES 
                WHICH WILL HAVE TWO BUTTONS
                "Edit Profile"
                "Delete Profile"
                Maybe keep fav brand if you want but fix it to fragrance review--}}


        </div>
    </div>
</div>
@endsection