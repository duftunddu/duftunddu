@extends('layouts.app')

<title>{{__($fragrance->name)}} {{(' | Duft Und Du')}}</title>

@section('content')

{{-- Toggle Box --}}
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script> --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css"> --}}

<style>
    /* #back-color {
        color:white !important;
        background: linear-gradient(90deg, rgba(0, 0, 0, 1) 27%, rgba(255, 255, 255, 1) 100%) !important;
    } */
</style>

<link href="{{ asset('css/fragrance.css') }}" rel="stylesheet">
<link href="{{ asset('css/colour-palette.css') }}" rel="stylesheet">

{{-- JQuery for Ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{'Fragrance: '}} {{ __($fragrance->name)}}</div>
                <div class="card-body">
                    <h4 for="&" class="wide center">{{ __('&')}} </h4>    
                    
                    <div class="row-pad">

                        {{-- On Left --}}
                        <div class="column">

                            {{-- Heading: User Name --}}
                            <h4 for="user name" class="center color-red">
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
                            <h5 for="personal numbers" class="center color-red">Personal Numbers</h4>
                            <br>

                            <div class="left-border">
                                <div class="left">
                                    @auth
                                    
                                    {{-- Indoor vs Outdoor --}}
                                    @if($sillage->value > 50)
                                    {{-- Outdoor--}}
                                    <h4 data-toggle="tooltip" data-placement="top" data-html="true"
                                        title="Better suited for outdoors, based on fragrance and your region.">
                                        <span style="color:white; 
                                        background: linear-gradient(90deg, rgb(247,82,124, 1) {{100 - ($sillage->value)}}%, rgb(255, 255, 255, 1) 100%);"
                                    >&nbsp;Outdoor / Indoor&nbsp;</span></h4>
                                    
                                    @else
                                    {{-- Indoor --}}
                                    <h4 data-toggle="tooltip" data-placement="top" data-html="true"
                                        title="Better suited for indoors, based on fragrance and your region."><span style="color:white; 
                                        background: linear-gradient(90deg, rgb(247,82,124, 1) {{$sillage->value}}%, rgb(255, 255, 255, 1) 100%);"
                                    >&nbsp;Indoor / Outdoor&nbsp;</span></h4>
                                    
                                    @endif

                                    {{-- Longevity --}}
                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                        title="How long the fragrance lasts.<br>100 is max.">Longevity: {{$longevity}}
                                    </h4>
                                    <!-- RATE -->
                                    <section class="rate rating">
                                        <!-- FIFTH STAR -->
                                        <input type="radio" id="star_5" name="longevity" value="5"
                                            onclick="handleLongevity(this);" />
                                        <label for="star_5" title="Five">&#9733;</label>
                                        <!-- FOURTH STAR -->
                                        <input type="radio" id="star_4" name="longevity" value="4"
                                            onclick="handleLongevity(this);" />
                                        <label for="star_4" title="Four">&#9733;</label>
                                        <!-- THIRD STAR -->
                                        <input type="radio" id="star_3" name="longevity" value="3"
                                            onclick="handleLongevity(this);" />
                                        <label for="star_3" title="Three">&#9733;</label>
                                        <!-- SECOND STAR -->
                                        <input type="radio" id="star_2" name="longevity" value="2"
                                            onclick="handleLongevity(this);" />
                                        <label for="star_2" title="Two">&#9733;</label>
                                        <!-- FIRST STAR -->
                                        <input type="radio" id="star_1" name="longevity" value="1"
                                            onclick="handleLongevity(this);" />
                                        <label for="star_1" title="One">&#9733;</label>
                                    </section><br><br>

                                    {{-- Suitability --}}
                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                        title="Depends on season.<br>100 is average.<br>Above 100 is better.">
                                        Suitability: {{$suitability}}</h4>
                                    <!-- RATE -->
                                    <section class="rate rating">
                                        <!-- FIFTH STAR -->
                                        <input type="radio" id="sstar_5" name="suitability" value="5"
                                            onclick="handleSuitability(this);" />
                                        <label for="sstar_5" title="Five">&#9733;</label>
                                        <!-- FOURTH STAR -->
                                        <input type="radio" id="sstar_4" name="suitability" value="4"
                                            onclick="handleSuitability(this);" />
                                        <label for="sstar_4" title="Four">&#9733;</label>
                                        <!-- THIRD STAR -->
                                        <input type="radio" id="sstar_3" name="suitability" value="3"
                                            onclick="handleSuitability(this);" />
                                        <label for="sstar_3" title="Three">&#9733;</label>
                                        <!-- SECOND STAR -->
                                        <input type="radio" id="sstar_2" name="suitability" value="2"
                                            onclick="handleSuitability(this);" />
                                        <label for="sstar_2" title="Two">&#9733;</label>
                                        <!-- FIRST STAR -->
                                        <input type="radio" id="sstar_1" name="suitability" value="1"
                                            onclick="handleSuitability(this);" />
                                        <label for="sstar_1" title="One">&#9733;</label>
                                    </section><br><br>

                                    {{-- Sustainability --}}
                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                                        title="How much heat affects the longevity of fragrance.<br>100 means unaffected. Below 100 means it will wear off sooner.">
                                        Sustainability: {{$sustainability}}</h4>
                                    <!-- RATE -->
                                    <section class="rate rating">
                                        <!-- FIFTH STAR -->
                                        <input type="radio" id="astar_5" name="sustainability" value="5"
                                            onclick="handleSustainability(this);" />
                                        <label for="astar_5" title="Five">&#9733;</label>
                                        <!-- FOURTH STAR -->
                                        <input type="radio" id="astar_4" name="sustainability" value="4"
                                            onclick="handleSustainability(this);" />
                                        <label for="astar_4" title="Four">&#9733;</label>
                                        <!-- THIRD STAR -->
                                        <input type="radio" id="astar_3" name="sustainability" value="3"
                                            onclick="handleSustainability(this);" />
                                        <label for="astar_3" title="Three">&#9733;</label>
                                        <!-- SECOND STAR -->
                                        <input type="radio" id="astar_2" name="sustainability" value="2"
                                            onclick="handleSustainability(this);" />
                                        <label for="astar_2" title="Two">&#9733;</label>
                                        <!-- FIRST STAR -->
                                        <input type="radio" id="astar_1" name="sustainability" value="1"
                                            onclick="handleSustainability(this);" />
                                        <label for="astar_1" title="One">&#9733;</label>
                                    </section><br>

                                    <br>
                                    <p class="color-light-gray right-align">v 1.1</p>
                                    <p>These are your personalized numbers.<br>
                                        Please leave feedback on fragrances you have used previously.<br>
                                        Your input will help us predict better!
                                    </p><br>

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
                                    <h4 class="color-red">You are missing out on Factors Affecting Fragrance Wearability.</h4>
                                    <h4 class="color-red"><a href="/login">Log In</a> / <a href="/register">Sign Up</a>
                                        to see if <span class="color-highlight-purple">{{ __($fragrance->name)}}</span>
                                        will suit you.</h4>
                                    <p class="color-light-gray right-align">For more info, visit <a href="/faq">FAQ</a>.</p>
                                    @endguest

                                </div>
                            </div>
                        </div>

                        {{-- On Right --}}
                        <div class="column">

                            {{-- Heading: Fragrance Name --}}
                            <h4 for="fragrance name" class="center color-highlight-purple">{{ __($fragrance->name)}}
                            &thinsp;

                                {{-- Gender Suitability --}}
                                @if($fragrance->gender == 'Male')
                                <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                                title="Fragrance is Masculine." alt="Male Symbol"
                                    src="{{ asset('images/vector_graphics/gender/male_symbol.png') }}">
                                @elseif($fragrance->gender == 'Female')
                                <img class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                                title="Fragrance is Feminine." alt="Female Symbol"
                                    src="{{ asset('images/vector_graphics/gender/female_symbol.png') }}">
                                @else
                                <img class="gender-png" class="gender-png" data-toggle="tooltip" data-placement="top" data-html="true"
                                title="Fragrance is Unisex." alt="Unisex Symbol"
                                    src="{{ asset('images/vector_graphics/gender/unisex_symbol.png') }}">
                                @endif
                            </h4>
                            <h5 for="fragrance details" class="center color-highlight-purple">Fragrance Details</h4>
                            <br>

                            <div class="right-border">
                                <div class="right">

                                    <h4>Type: {{$type->name}}</h4>
                                    <h4>Cost: {{$fragrance->cost}} {{$fragrance->currency}}
                                        <span data-toggle="tooltip" data-placement="top" data-html="true"
                                            title="This is an estimated cost.">*</span>
                                    </h4>
                                    <br>
                                    <h4>Accords:</h4>

                                    @foreach($accords as $accord)
                                    @if (!($loop->last))
                                    <h5>{{$accord}},</h5>
                                    @endif
                                    @if ($loop->last)
                                    <h5>{{$accord}}</h5>
                                    @endif
                                    @endforeach<br>

                                    <br>

                                    <h4>Notes:</h4>
                                    @foreach($notes as $note)
                                    @if (!($loop->last))
                                    <h5>{{$note->name}},</h5>
                                    @endif
                                    @if ($loop->last)
                                    <h5>{{$note->name}}</h5>
                                    @endif
                                    @endforeach<br>

                                    <br>

                                    <p class="color-light-gray left-align">Added on {{$fragrance->created_at->format('d/M/y')}}</p>

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

                </div>
            </div>
        </div>
    </div>
</div>

<div id="csrf">
    @csrf
</div>


{{-- HSL Color --}}
<script>
    document.querySelectorAll(".hsl-color").forEach(function (e) {
        let s = e.innerText;
        let n =  parseInt(s.substring(s.indexOf(":") + 1).trim()) + 350;
        console.log(n);
        // e.style.color = "hsl(" + n + ",100%,39%)";
        e.style.color = "hsl(" + n + ",70%,50%)";
        // e.style.backgroundColor= "hsl("+n+",50%,50%)";
    })
</script>

{{-- Longevity --}}
<script>
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
</script>

{{-- Suitability --}}
<script>
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
</script>

{{-- Sustainability --}}
<script>
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
</script>

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