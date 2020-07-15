@extends('layouts.app')

<title>{{_('Dashboard | Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .full-height {
            height: 75vh;
        }

        .full-width{
            width: 100vw;
        }

        .flex-center1 {
            /* background-image: url("https://www.designisthis.com/blog/images/uploads/2012/08/AnestasiA-Vodka.jpg"); */
            /* background-attachment: fixed; */
            /* background-size: cover; */
            /* background-repeat: no-repeat; */
            /* background-position: center top; */
            /* background-size: 100% 100%; */

            align-items: left;
            display: flex;
            justify-content: left;
            /* padding-top: 7.73vw; */
            /* padding-left: 10.1vw; */

            /* color:slategrey; */
        }
        
        .col-md-5{
            position: relative;
            text-align: center;
        }

        label{
            position: relative;
            text-align: center;
        }

    </style>

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <script src="{{ asset('js/home.js') }}" defer></script>

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

    {{-- Accordion --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <br>

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
                    @if ($brand->isNotEmpty())

                        {{-- Favorite Brand --}}
                        <div class="form-group row">
                            <label for="brand" class="col-md-5 col-from-label text-md-right"><h4>{{ __('Favourite Brand')}}</h4></label>

                            <div class="col-md-5">
                                <h4>
                                    <a href="/brand_output/{{$brand->name}}">{{$brand->name}}</a>
                                    {{-- {{_($brand->name)}} --}}
                                </h4>
                            </div>

                        </div>

                        {{-- All Fragrances of User --}}
                        <div class="form-group row">
                            <label for="brand" class="col-md-5 col-from-label text-md-right"><h4>{{ __('All Fragrances')}}</h4></label>

                            <div class="col-md-5">
                                <h4>
                                    @foreach($user_fragrances as $fragrance)
                                        {{_($fragrance->name)}}
                                        {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                        {{-- {{_($fragrance->like)}} --}}
                                        <br>
                                    @endforeach
                                </h4>
                            </div>
                        </div>

                        {{--  Button: Add a Fragrance --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-5">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Add a Fragrance') }}
                                </button>
                            </div>
                        </div>

                        <br>

                        {{-- Button: Get Reccommendation --}}
                        {{-- Only appears Brand exists --}}
                        @if($brand->isNotEmpty())
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">        
                                    <button type="submit" class="custom"> {{-- style="position:absolute; right:3vh" --}}
                                        <span class="before">{{_('Ask Genie')}}</span>
                                        <span class="after">{{_('Ask Genie')}}</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        
                        <br>
                        
                        {{-- Add a Profile - Button --}}
                        {{-- Only appears if there are no Profiles --}}
                        @if($profiles->isEmpty())

                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Add a Profile') }}
                                    </button>
                                </div>
                            </div>
                        
                        @endif

                    {{-- Empty Dashboard --}}
                    @else
                        <div class="form-group row">
                            {{-- <label for="brand" class="col-md-5 col-from-label text-md-right"><h4>{{ __('Favourite Brand')}}</h4></label> --}}

                            <div class="col-md-5">
                                {{-- style="margin-left: 30%" --}}
                                <h4>{{_('This place looks empty')}}</h4>
                            </div>

                        </div>
                        
                        <br>

                        {{--  Button: Add a Fragrance --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-5">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Add a Fragrance') }}
                                </button>
                            </div>
                        </div>

                        <br>
                        
                        {{-- Add a Profile - Button --}}
                        {{-- Only appears if there are no Profiles --}}
                        @if($profiles->isEmpty())

                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Add a Profile') }}
                                    </button>
                                </div>
                            </div>
                        
                        @endif

                    @endif

                </div>
            </div>

            <br><br>

            {{-- Card: Profiles --}}
            @if($profiles->isNotEmpty())
            <div class="card">
                <div class="card-header">{{_('Other Profiles')}}</div>
                @foreach($profiles as $profile)
                
                {{-- Accordions --}}
                <div id="accordion" class="accordion">
                    
                    {{-- Head --}}
                    <div class="as-accordion-head">

                        <span id="as-accordion-close" class="as-accordion-close" aria-hidden="true"><h2>&times;</h2></span>
                        
                        <span class="as-accordion-title">
                            <h4> {{_($profile[0]->detail)}} </h4>
                        </span>

                        {{-- <span> --}}

                            {{-- Button: Buy Gift Card --}}
                            {{-- <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-9">
                                    <button type="submit" class="custom" style="position:absolute; left:70%">
                                        {{ __('Buy Gift Card') }}
                                    </button>
                                </div>
                            </div> --}}

                        {{-- </span> --}}


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

                            {{-- Button: Buy Gift Card --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-8">
                                    <button type="submit" class="custom">
                                        <span class="before">{{_('Buy Gift Card')}}</span>
                                        <span class="after">{{_('Buy Gift Card')}}</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                @endforeach

                <br>

                {{-- Button: Add a Profile --}}
                <div class="form-group row mb-0">
                    <div class="col-md-5 offset-md-7">
                        <button type="submit" class="custom">
                            <span class="before">{{_('Add a Profile')}}</span>
                            <span class="after">{{_('Add a Profile')}}</span>
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
