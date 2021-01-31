@extends('layouts.app')

<title>{{__($fragrance->name)}} {{(' | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Stylesheet --}}
    <link href="{{ asset('css/fragrance.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/store_scroll_bar.css') }}" rel="stylesheet"> --}}

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

{{-- JQuery for Ajax --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card"> --}}

                {{-- <div class="card-header">{{'Fragrance: '}} {{ __($fragrance->name)}}</div> --}}
                {{-- <div class="card-body"> --}}
                    {{-- <h4 for="&" class="wide center">{{ __('&')}} </h4>     --}}
                    {{-- <div class="wide center">
                        <div class="img-ref-div center-img">
                            <div class="reflect"></div>
                        </div>
                    </div> --}}


                    <br>
                    
                    <div class="row-pad">

                        {{-- On Left --}}
                        <div class="column">

                            {{-- Heading: User Name --}}
                            <h4 for="user name" class="center lux-red">
                            @auth
                            {{ Auth::user()->name }}
                            @else
                            {{ __('You')}}
                            @endauth
                            &thinsp;

                            {{-- Gender Image --}}
                            @if($user_gender == 'Male')
                            <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                            title="Gender is Male." alt="Male Symbol"
                                src="{{ asset('images/vector_graphics/gender/male_symbol.png') }}">
                            @elseif($user_gender == 'Female')
                            <img class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                            title="Gender is Female." alt="Female Symbol"
                                src="{{ asset('images/vector_graphics/gender/female_symbol.png') }}">
                            @else
                            <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                            title="Gender is Other." alt="OTher Symbol"
                                src="{{ asset('images/vector_graphics/gender/unisex_symbol.png') }}">
                            @endif
                            </h4>
                            <h5 for="personal numbers" class="center lux-red">Personal Numbers</h4>
                            <br>

                            <div class="left-border">
                                <div class="left-top-border"></div>
                                <div class="left">
                                    @auth
                                    
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
                                    {{-- <br> --}}

                                    <hr class="hr-purple-line">
                                    {{-- <br> --}}

                                    {{-- Longevity --}}
                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                        title="How long the fragrance lasts.<br>100 is max.">Longevity: <span class="lux-red">{{$longevity}}</span>
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
                                    {{-- <p>These are your personalized numbers.<br>
                                        Please leave feedback on fragrances you have used previously.<br>
                                        Your input will help us predict better!
                                    </p> --}}
                                    <br>

                                    {{-- Toggler --}}
                                    {{-- <div class="toggler">
                                        <div id="effect-open-close" class="ui-widget-content ui-corner-all">
                                            <h5 class="ui-widget-header ui-corner-all">Feedback</h5>
                                            <p>
                                                These are personalized numbers. These factors were researched and calculated using your region's weather data and the additional details you provided.<br>
                                                Your input will help us predict better!
                                            </p>
                                        </div>
                                    </div>
                                    <a href="#" id="toggle-button" role="button">Toggle</a> --}}

                                    @endauth
                                    @guest
                                    <h4 class="lux-red">You are missing out on Factors Affecting Fragrance Wearability.</h4>
                                    <h4 class="lux-red"><a href="/login">Log In</a> / <a href="/register">Sign Up</a>
                                        to see if <span class="lux-purple">{{ __($fragrance->name)}}</span>
                                        will suit you.</h4>
                                    <p class="de-gray right-align">For more info, visit <a href="/faq">FAQ</a>.</p>
                                    @endguest

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
                                <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                                title="Fragrance is masculine." alt="Male Symbol"
                                    src="{{ asset('images/vector_graphics/gender/male_symbol.png') }}">
                                @elseif($fragrance->gender == 'Female')
                                <img class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                                title="Fragrance is feminine." alt="Female Symbol"
                                    src="{{ asset('images/vector_graphics/gender/female_symbol.png') }}">
                                @else
                                <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                                title="Fragrance is unisex." alt="Unisex Symbol"
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
                                    <h4>Cost: <span class="lux-purple">{{$fragrance->cost}} {{$fragrance->currency}}
                                        <span data-toggle="tooltip" data-placement="top" data-html="true"
                                            title="This is an estimated cost.">*</span></span>
                                    </h4>

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
                    @if($allow_edit)
                    <div class="form-group row mb-0 center">
                        <button type="submit" class="btn btn-outline-dark"
                            onclick="window.location='{{ url('fragrance_edit/'.$fragrance->id) }}'">
                            {{ __('Edit') }}
                        </button>
                    </div><br>
                    @endif

                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>

<div id="csrf">
    @csrf
</div>


{{-- HSL Color --}}
{{-- <script>
    document.querySelectorAll(".hsl-color").forEach(function (e) {
        let s = e.innerText;
        let n =  parseInt(s.substring(s.indexOf(":") + 1).trim()) + 350;
        console.log(n);
        // e.style.color = "hsl(" + n + ",100%,39%)";
        e.style.color = "hsl(" + n + ",70%,50%)";
        // e.style.backgroundColor= "hsl("+n+",50%,50%)";
    })
</script> --}}

{{-- Longevity --}}
{{-- <script>
    function handleLongevity(Longevity) {
        var weights = {
            !!json_encode($weights) !!
        };
        $.ajax({
            type: 'POST',
            url: '/affecting_factors_data',
            //    data:{"_token": "{{ csrf_token() }}", value: Longevity.value, type: "Longevity"},
            data: {
                "_token": "{{ csrf_token() }}",
                value: Longevity.value,
                type: "Longevity",
                weights: weights
            },
            success: function (data) {
                alert(data);
            }
        });
    }
</script> --}}

{{-- Suitability --}}
{{-- <script>
    function handleSuitability(Suitability) {
        var weights = {
            !!json_encode($weights) !!
        };
        $.ajax({
            type: 'POST',
            url: '/affecting_factors_data',
            //    data:{"_token": "{{ csrf_token() }}", value: Suitability.value, type: "Suitability"},
            data: {
                "_token": "{{ csrf_token() }}",
                value: Suitability.value,
                type: "Suitability",
                weights: weights
            },
            success: function (data) {
                alert(data);
            }
        });
    }
</script> --}}

{{-- Sustainability --}}
{{-- <script>
    function handleSustainability(Sustainability) {
        var weights = {
            !!json_encode($weights) !!
        };
        $.ajax({
            type: 'POST',
            url: '/affecting_factors_data',
            //    data:{"_token": "{{ csrf_token() }}", value: Sustainability.value, type: "Sustainability"},
            data: {
                "_token": "{{ csrf_token() }}",
                value: Sustainability.value,
                type: "Sustainability",
                weights: weights
            },
            success: function (data) {
                alert(data);
            }
        });
    }
</script> --}}

{{-- Toggle Effect --}}
{{-- <script>
    $( function() {
      function runEffect() {
        // Run the effect
        $( "#effect-open-close" ).toggle( 'fold', {options:"swing"}, 1000 );
      };
   
      // Set effect from select menu value
      $( "#toggle-button" ).on( "click", function() {
        runEffect();
      });
    } );
</script> --}}

@endsection