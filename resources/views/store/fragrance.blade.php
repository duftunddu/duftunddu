@extends('layouts.app_store')

<title>{{__($fragrance->name)}} {{(' | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Stylesheet --}}
    <link href="{{ asset('css/fragrance.css') }}" rel="stylesheet">
    <link href="{{ asset('css/store_scroll_bar.css') }}" rel="stylesheet">
    
    <style>
        /* Fragracnce Picture */
        .reflect{
            background-image: url('https://static.toiimg.com/thumb/msid-63080082,imgsize-293543,width-800,height-600,resizemode-75/63080082.jpg');
        }

        .outdoor {
            background: linear-gradient(90deg, rgb(247,82,124, 1) {{100 - ($sillage->value)}}%, rgb(255, 255, 255, 1) 100%);
        }

        .indoor {
            background: linear-gradient(90deg, rgb(247,82,124, 1) {{$sillage->value}}%, rgb(255, 255, 255, 1) 100%);
        }


        /* Reviews */
        .longevity {
            width: {{$longevity<100 ? $longevity : 100 }}%;
        }

        .suitability {
            width: {{$suitability<100 ? $suitability : 100 }}%;
        }

        .sustainability {
            width: {{$sustainability<100 ? $sustainability : 100 }}%;
        }
    </style>

</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <br>

            <div class="row-pad">

                {{-- On Left --}}
                <div class="column">

                    {{-- Heading: User Name --}}
                    <h4 for="user name" class="center lux-red">
                        {{-- @auth --}}
                        {{-- {{ Auth::user()->name }} --}}
                        {{-- @else --}}
                        {{ __('You')}}
                        {{-- @endauth --}}
                        &thinsp;

                        {{-- Gender Image --}}
                        @if($user_gender == 'Male')
                        <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top"
                            data-html="true" title="Gender is Male." alt="Male Symbol"
                            src="{{ asset('images/vector_graphics/gender/male_symbol.png') }}">
                        @elseif($user_gender == 'Female')
                        <img class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                            title="Gender is Female." alt="Female Symbol"
                            src="{{ asset('images/vector_graphics/gender/female_symbol.png') }}">
                        @else
                        <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top"
                            data-html="true" title="Gender is Other." alt="OTher Symbol"
                            src="{{ asset('images/vector_graphics/gender/unisex_symbol.png') }}">
                        @endif
                    </h4>
                    <h5 for="personal numbers" class="center lux-red">Personal Numbers</h4>
                        <br>

                        <div class="left-border">
                            <div class="left-top-border"></div>
                            <div class="left">

                                {{-- Indoor vs Outdoor --}}
                                @if($sillage->value > 50)
                                {{-- Outdoor--}}
                                <h4 data-toggle="tooltip" data-placement="top" data-html="true"
                                    title="Better suited for outdoors, based on fragrance and your region.">
                                    <span class="doors outdoor">&nbsp;Outdoor / Indoor&nbsp;</span></h4>

                                @else
                                {{-- Indoor --}}
                                <h4 data-toggle="tooltip" data-placement="top" data-html="true"
                                    title="Better suited for indoors, based on fragrance and your region.">
                                    <span class="doors indoor">&nbsp;Indoor / Outdoor&nbsp;</span></h4>

                                @endif

                                <hr class="hr-purple-line">

                                {{-- Longevity --}}
                                <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                    title="How long the fragrance lasts.<br>100 is max.">Longevity: <span
                                        class="lux-red">{{$longevity}}</span>
                                </h4>
                                {{-- Bar --}}
                                <div class="review-bar-cont">
                                    <div class="review-bar longevity"></div>
                                </div>
                                <br><br><br>

                                {{-- <hr class="hr-purple-line"> --}}

                                {{-- Suitability --}}
                                <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                    title="Depends on season.<br>100 is average.<br>Above 100 is better.">
                                    Suitability: <span class="lux-red">{{$suitability}}</span></h4>
                                {{-- Bar --}}
                                <div class="review-bar-cont">
                                    <div class="review-bar suitability"></div>
                                </div>
                                <br><br><br>

                                {{-- <hr class="hr-purple-line"> --}}

                                {{-- Sustainability --}}
                                <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                    title="How much heat affects the longevity of fragrance.<br>100 means unaffected. Below 100 means it will wear off sooner.">
                                    Sustainability: <span class="lux-red">{{$sustainability}}</span></h4>
                                {{-- Bar --}}
                                <div class="review-bar-cont">
                                    <div class="review-bar sustainability"></div>
                                </div>
                                <br>

                                {{-- <br><br> --}}

                                <hr class="hr-purple-line">

                                <p class="de-gray right-align">v 1.1</p>
                                <br>


                            </div>
                        </div>
                </div>

                {{-- On Right --}}
                <div class="column">

                    {{-- Heading: Fragrance Name --}}
                    <h4 for="fragrance name" class="center lux-purple">{{ __($fragrance->name)}}
                        &thinsp;

                        {{-- Gender Suitability --}}
                        @if($fragrance->gender == 'Male')
                        <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top"
                            data-html="true" title="Fragrance is masculine." alt="Male Symbol"
                            src="{{ asset('images/vector_graphics/gender/male_symbol.png') }}">
                        @elseif($fragrance->gender == 'Female')
                        <img class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                            title="Fragrance is feminine." alt="Female Symbol"
                            src="{{ asset('images/vector_graphics/gender/female_symbol.png') }}">
                        @else
                        <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top"
                            data-html="true" title="Fragrance is unisex." alt="Unisex Symbol"
                            src="{{ asset('images/vector_graphics/gender/unisex_symbol.png') }}">
                        @endif
                    </h4>
                    <h5 for="fragrance details" class="center lux-purple">Fragrance Details</h4>
                        <br>

                        <div class="right-border">
                            <div class="right-top-border"></div>
                            <div class="right">

                                {{-- Fragrance Image --}}
                                {{-- <div class="img-ref-div center-img">
                                    <div class="reflect"></div>
                                </div> --}}

                                {{-- Text --}}
                                <h4>Type: <span class="lux-purple">{{$type->name}}</span></h4>

                                <hr class="hr-red-line">

                                <h4>Accords:</h4>

                                @foreach($accords as $accord)
                                @if (!($loop->last))
                                <h5>{{$accord}},</h5>
                                @endif
                                @if ($loop->last)
                                <h5>{{$accord}}</h5>
                                @endif
                                @endforeach<br>

                                <hr class="hr-red-line">

                                <h4>Notes:</h4>
                                @foreach($notes as $note)
                                @if (!($loop->last))
                                <h5>{{$note->name}},</h5>
                                @endif
                                @if ($loop->last)
                                <h5>{{$note->name}}</h5>
                                @endif
                                @endforeach<br>

                                <hr class="hr-red-line">

                                <p class="de-gray left-align">Added on {{$fragrance->created_at->format('d/M/y')}}</p>

                            </div>
                        </div>
                </div>
            </div>
            <br>

            {{-- Button: Allow --}}

            <div class="form-group row mb-0 center">
                <button type="submit" class="btn btn-outline-dark" 
                onclick="window.location='{{ url('/store_profile') }}'">Edit Profile</button>
            </div><br>

    </div>
</div>

<div id="csrf">
    @csrf
</div>
@endsection