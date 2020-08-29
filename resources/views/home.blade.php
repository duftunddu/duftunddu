@extends('layouts.app')

<title>{{_('Dashboard | AI Powered Fragrance Genie | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .col-md-5{
            position: relative;
            text-align: center;
        }

        .center{
            display: block;
            margin: 0 auto;
        }

        .accordion-title-button{
            position: absolute;
            left: 68%;
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

        button.btn{
            opacity: 1;
            transform: translate(0);
            transition: all 200ms linear;
            transition-delay: 800ms;
        }
        body.hero-anime button.btn{
            opacity: 0;
            transform: translateY(8px);
            transition-delay: 800ms;
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

    <link href="{{ asset('css/home_accordion.css') }}" rel="stylesheet">
    <script src="{{ asset('js/home_accordion.js') }}" defer></script>

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

    {{-- Accordion --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Card: User --}}
            <div class="card">
                <div class="card-header">{{_('User Fragrances')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    {{-- User Fragrances --}}
                    @if (!empty($fav_brand))

                        {{-- Favorite Brand --}}
                        <div class="form-group row">
                            <label for="brand" class="col-md-5 col-from-label text-md-right"><h4>{{ __('Favourite Brand')}}</h4></label>

                            <div class="col-md-5">
                                <h4>
                                    <a href="/brand/{{$fav_brand->id}}">{{$fav_brand->name}}</a>
                                </h4>
                            </div>

                        </div>

                        {{-- All Fragrances of User --}}
                        <div class="form-group row">
                            <label for="brand" class="col-md-5 col-from-label text-md-right"><h4>{{ __('All Fragrances')}}</h4></label>

                            <div class="col-md-5">
                                <h4>
                                    @foreach($user_fragrances as $fragrance)
                                        <a href="/fragrance/{{$fragrance->id}}">{{$fragrance->name}}</a>
                                        <br>
                                    @endforeach
                                </h4>
                            </div>
                        </div>

                        <br>

                        {{--  Button: Add Fragrance --}}
                        <div class="form-group row">
                            <div class="center">
                                <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/genie_input/' . $user_profile->id) }}'">
                                    {{ __('Add Fragrance') }}
                                </button>
                            </div>
                        </div>

                        <br>

                        {{-- Button: Genie --}}
                        {{-- Only appears fav_brand exists --}}
                        @if (!empty($fav_brand))
                        <div class="form-group row">
                            <div class="center">
                                <button type="submit" class="custom" onclick="window.location='{{ url('/genie_output/' . $user_profile->id) }}'">
                                    <span class="before">{{_('Genie')}}</span>
                                    <span class="after">{{_('Genie')}}</span>
                                </button>
                            </div>
                        </div>

                        <br>
                        @endif

                    {{-- Empty Dashboard --}}
                    @else
                        <div class="form-group row">
                            <div class="col-md-5">
                                <h4>{{_('This place looks empty.')}}</h4>
                            </div>
                        </div>
                        
                        <br>

                        {{--  Button: Add Fragrance --}}
                        <div class="form-group row mb-0">
                            <div class="center">
                                <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/genie_input/' . $user_profile->id) }}'">
                                    {{ __('Add Fragrance') }}
                                </button>
                            </div>
                        </div>

                        <br>

                    @endif
                    
                    {{-- Add Profile - Button --}}
                    {{-- Only appears if there are no Profiles --}}
                    @if(empty($profiles) && empty($empty_profiles) )

                        <div class="form-group row mb-0">
                            <div class="center">        
                                <button type="submit" class="btn btn-dark"  onclick="window.location='{{ url('profile') }}'">
                                    {{ __('Add Profile') }}
                                </button>
                            </div>
                        </div>

                        <br>
                    @endif

                </div>
            </div>

            <br><br>

            {{-- Card: Profiles --}}
            @if(!empty($profiles) || !empty($empty_profiles) )
            <div class="card">
                <div class="card-header">{{_('Other Profiles')}}</div>
                
                {{-- Empty Profiles --}}
                @if ( !empty($empty_profiles) )
                    @foreach($empty_profiles as $profile)
                    
                    {{-- Accordion --}}
                    <div id="accordion" class="accordion">
                        
                        {{-- Head --}}
                        <div class="as-accordion-head">

                            <span id="as-accordion-close" class="as-accordion-close" aria-hidden="true"><h2>&times;</h2></span>
                            
                            <span class="as-accordion-title">
                                <h4> {{_($profile->detail)}} </h4>
                            </span>

                            {{--  Button: Add Fragrance --}}
                            <span>
                                <div class="accordion-title-button">
                                    <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/genie_input/' . $profile->id) }}'">
                                        {{ __('Add Fragrance') }}
                                    </button>
                                </div>
                            </span>

                        </div>

                    </div>

                    @endforeach

                    <br>
                @endif

                {{-- Profiles with Fragrances --}}
                @if ( !empty($profiles) )
                    @foreach($profiles as $profile)
                    
                    {{-- Accordion --}}
                    <div id="accordion" class="accordion">
                        
                        {{-- Head --}}
                        <div class="as-accordion-head">

                            <span id="as-accordion-close" class="as-accordion-close" aria-hidden="true"><h2>&times;</h2></span>
                            
                            <span class="as-accordion-title">
                                <h4> {{_($profile[0]->detail)}} </h4>
                            </span>

                            {{--  Button: Add Fragrance --}}
                            <span>
                                <div class = "accordion-title-button">
                                    <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/genie_input/' . $profile[0]->profile_id) }}'">
                                        {{ __('Add Fragrance') }}
                                    </button>
                                </div>
                            </span>

                        </div>
                        
                        {{-- Body --}}
                        <div class="as-accordion-collapse" id="collapseExample">
                            <div class="">

                                {{-- Profile Fragrances --}}                            
                                @foreach ($profile as $fragrance)                            
                                    <div class="form-group row">
                                        
                                        <div class="col-md-5">
                                            <h5>
                                                {{_($fragrance->name)}}
                                            </h5>
                                        </div>

                                    </div>
                                @endforeach

                                {{-- Button: Genie --}}
                                <button type="submit" style="display: block; margin:0 auto;" class="custom" onclick="window.location='{{ url('/genie_output/' . $profile[0]->profile_id) }}'">
                                    <span class="before">{{_('Genie')}}</span>
                                    <span class="after">{{_('Genie')}}</span>
                                </button>

                            </div>
                        </div>

                    </div>

                    @endforeach

                    <br>
                @endif

                {{-- Button: Add Profile --}}
                <div class="form-group row mb-0">
                    <div class="center">        
                        <button type="submit" class="btn btn-dark"  onclick="window.location='{{ url('profile') }}'">
                            {{ __('Add Profile') }}
                        </button>
                    </div>
                </div>

                <br>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection