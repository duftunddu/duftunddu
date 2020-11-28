@extends('layouts.app')

<title>{{__($fragrance->name)}} {{(' | Duft Und Du')}}</title>

<style>
    .right{
        text-align: right;
        margin-right: 20px;
    }
    .row {
        display: flex;
    }
    .column {
       flex: 50%;
    }
    .right p{
        margin-left:20%;
        text-align: right;
    }
    .color-red{
        color: #f7527c;
    }
    .color-highlight-purple{
        color: #8167a9;
    }
    .center{
        display:flex;
        justify-content: center;
    }
    .gender-png{
        max-width:60px;
        max-height:60px;
    }

    .rating {
        /* position: absolute; */
        /* top: 0;
        left: 0;
        right: 0;
        bottom: 0; */
        width: 150px;
        height: 30px;
        /* padding: 5px 10px; */
        /* margin: auto; */
        /* align-content: right; */
        /* text-content: right; */ 
        /* justify-content: right; */
        float: right; 
        border-radius: 30px;
        background: #FFFAFF;
        display: block;
        overflow: hidden;
        
        box-shadow: 0 1px #CCC,
                    0 2px #DDD,
                    0 9px 6px -3px #999;
        
        unicode-bidi: bidi-override;
        direction: rtl;
        font-size: 1.5rem;
    }
    .rating:not(:checked) > input {
        display: none;
    }

    /* - - - - - RATE */
    .rate {
    /* top: -65px; */
    }
    .rate:not(:checked) > label {
        cursor:pointer;
        float: right;
        width: 30px;
        height: 30px;
        display: block;
        
        /* color: rgba(0, 135, 211, .4); */
        color: rgba(211, 0, 53, .4);
        line-height: 33px;
        text-align: center;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        /* color: rgba(0, 135, 211, .6); */
        color: rgba(211, 0, 53, .6);
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        /* color: rgba(0, 135, 211, .8); */
        color: rgba(211, 0, 53, .8);
    }
    .rate > input:checked ~ label {
        /* color: rgb(0, 135, 211); */
        color: rgb(211, 0, 53);
    }

    /* Toggler */
    /* #effect-open-close {
        position: relative;
        width:80%;
        text-align:start;
        float:right;
        padding: 0.3em;
    }
    #effect-open-close h5 {
        padding: 0.1em;
        text-align: center;
    } */
</style>

@section('content')

{{-- Toggle Box --}}
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script> --}}
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css"> --}}

{{-- JQuery for Ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{'Fragrance: '}} {{ __($fragrance->name)}}</div>
                <div class="card-body">
                    
                    <div class="row">
                        
                        {{-- The design was made by mistake, it looked better than the original so we kept it --}}

                        {{-- On Left --}}
                        <div class="column">
                            <h4 for="about you" class="center color-red">{{ __('You')}} </h4><br>

                            <div class="right">
                                @auth

                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true" title="How long the fragrance lasts.<br>100 is max.">Longevity: {{$longevity}}</h4>
                                        <!-- RATE -->
                                        <section class="rate rating">
                                            <!-- FIFTH STAR -->
                                            <input type="radio" id="star_5" name="longevity" value="5" onclick="handleLongevity(this);"/>
                                            <label for="star_5" title="Five">&#9733;</label>
                                            <!-- FOURTH STAR -->
                                            <input type="radio" id="star_4" name="longevity" value="4" onclick="handleLongevity(this);"/>
                                            <label for="star_4" title="Four">&#9733;</label>
                                            <!-- THIRD STAR -->
                                            <input type="radio" id="star_3" name="longevity" value="3" onclick="handleLongevity(this);"/>
                                            <label for="star_3" title="Three">&#9733;</label>
                                            <!-- SECOND STAR -->
                                            <input type="radio" id="star_2" name="longevity" value="2" onclick="handleLongevity(this);"/>
                                            <label for="star_2" title="Two">&#9733;</label>
                                            <!-- FIRST STAR -->
                                            <input type="radio" id="star_1" name="longevity" value="1" onclick="handleLongevity(this);"/>
                                            <label for="star_1" title="One">&#9733;</label>
                                        </section><br><br>

                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true" title="Depends on season.<br>100 is average.<br>Above 100 is better.">Suitability: {{$suitability}}</h4>
                                        <!-- RATE -->
                                        <section class="rate rating">
                                            <!-- FIFTH STAR -->
                                            <input type="radio" id="sstar_5" name="suitability" value="5" onclick="handleSuitability(this);"/>
                                            <label for="sstar_5" title="Five">&#9733;</label>
                                            <!-- FOURTH STAR -->
                                            <input type="radio" id="sstar_4" name="suitability" value="4" onclick="handleSuitability(this);"/>
                                            <label for="sstar_4" title="Four">&#9733;</label>
                                            <!-- THIRD STAR -->
                                            <input type="radio" id="sstar_3" name="suitability" value="3" onclick="handleSuitability(this);"/>
                                            <label for="sstar_3" title="Three">&#9733;</label>
                                            <!-- SECOND STAR -->
                                            <input type="radio" id="sstar_2" name="suitability" value="2" onclick="handleSuitability(this);"/>
                                            <label for="sstar_2" title="Two">&#9733;</label>
                                            <!-- FIRST STAR -->
                                            <input type="radio" id="sstar_1" name="suitability" value="1" onclick="handleSuitability(this);"/>
                                            <label for="sstar_1" title="One">&#9733;</label>
                                        </section><br><br>
                                        
                                    <h4 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true" title="How much heat affects the longevity of fragrance.<br>100 means unaffected. Below 100 means it will wear off sooner.">Sustainability: {{$sustainability}}</h4>
                                        <!-- RATE -->
                                        <section class="rate rating">
                                            <!-- FIFTH STAR -->
                                            <input type="radio" id="astar_5" name="sustainability" value="5" onclick="handleSustainability(this);"/>
                                            <label for="astar_5" title="Five">&#9733;</label>
                                            <!-- FOURTH STAR -->
                                            <input type="radio" id="astar_4" name="sustainability" value="4" onclick="handleSustainability(this);"/>
                                            <label for="astar_4" title="Four">&#9733;</label>
                                            <!-- THIRD STAR -->
                                            <input type="radio" id="astar_3" name="sustainability" value="3" onclick="handleSustainability(this);"/>
                                            <label for="astar_3" title="Three">&#9733;</label>
                                            <!-- SECOND STAR -->
                                            <input type="radio" id="astar_2" name="sustainability" value="2" onclick="handleSustainability(this);"/>
                                            <label for="astar_2" title="Two">&#9733;</label>
                                            <!-- FIRST STAR -->
                                            <input type="radio" id="astar_1" name="sustainability" value="1" onclick="handleSustainability(this);"/>
                                            <label for="astar_1" title="One">&#9733;</label>
                                        </section><br>
                                    
                                    <br><p>
                                        {{-- version 1.0.<br> --}}
                                        These are personalized numbers.<br>
                                        These factors were researched and calculated using your personal data.<br>
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
                                    <h4 class="color-red">You are missing out on Factors Affecting Fragrance Wearability</h4>
                                    <h4 class="color-red"><a href="/login">Log In</a> / <a href="/register">Sign Up</a> to see if <span class="color-highlight-purple">{{ __($fragrance->name)}}</span> will suit you.</h4>
                                    <p>For more info, visit <a href="/faq">FAQ</a>.</p>
                                @endguest

                            </div>
                        </div>

                        {{-- On Right --}}
                        <div class="column">
                            
                                <h4 for="about fragrance" class="center color-highlight-purple">{{ __('Fragrance')}} </h4><br>

                                {{-- <h4>Gender: {{$fragrance->gender}}</h4> --}}
                                @if($fragrance->gender == 'Male')
                                <img class="gender-png" src="{{ asset('images/vector_graphics/gender/male_symbol.png') }}"
                                alt="Ambassador Proposal">
                                @elseif($fragrance->gender == 'Female')
                                <img class="gender-png" src="{{ asset('images/vector_graphics/gender/female_symbol.png') }}"
                                alt="Ambassador Proposal">
                                @else
                                <img class="gender-png" src="{{ asset('images/vector_graphics/gender/unisex_symbol.png') }}"
                                alt="Ambassador Proposal">
                                @endif

                                <h4>Type: {{$type->name}}</h4>
                                <h4>Cost: {{$fragrance->cost}} {{$fragrance->currency}}
                                    <span data-toggle="tooltip"
                                    data-placement="top" data-html="true"
                                    title="This is an estimated cost.">*</span>
                                </h4>
                                <br>
                                <h4>Accords:</h4>
        
                                @foreach($accords as $accord)
                                    <h5>{{$accord}}</h5>
                                @endforeach
                                
                                <br>
        
                                <h4>Notes:</h4>
                                @foreach($notes as $note)
                                    <h5>{{$note->name}}</h5>
                                @endforeach
                                
                                <br>

                                <p>Added on {{$fragrance->created_at->format('d/M/y')}}</p>

                                <br>

                        </div>

                    </div>

                    @if($allow_edit)
                        <div class="form-group row mb-0 center">
                            <button type="submit" class="btn btn-outline-dark"  onclick="window.location='{{ url('fragrance_edit/'.$fragrance->id) }}'">
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
    document.querySelectorAll(".hsl-color").forEach(function(e){
        let s = e.innerText;
        let n = s.substring(s.indexOf(":")+1).trim();
        console.log(n);
        e.style.color= "hsl("+n+",100%,39%)";
        // e.style.backgroundColor= "hsl("+n+",50%,50%)";
    })
</script>

{{-- Longevity --}}
<script>
    function handleLongevity(Longevity) {
        var weights = {!! json_encode($weights) !!};
        $.ajax({
            type:'POST',
            url:'/affecting_factors_data',
            //    data:{"_token": "{{ csrf_token() }}", value: Longevity.value, type: "Longevity"},
            data:{"_token": "{{ csrf_token() }}", value: Longevity.value, type: "Longevity", weights: weights},
            success:function(data){
                alert(data);
            }
        });
    }
</script>

{{-- Suitability --}}
<script>
    function handleSuitability(Suitability) {
        var weights = {!! json_encode($weights) !!};
        $.ajax({
           type:'POST',
           url:'/affecting_factors_data',
        //    data:{"_token": "{{ csrf_token() }}", value: Suitability.value, type: "Suitability"},
           data:{"_token": "{{ csrf_token() }}", value: Suitability.value, type: "Suitability", weights: weights},
           success:function(data){
              alert(data);
           }
        });
    }
</script>

{{-- Sustainability --}}
<script>
    function handleSustainability(Sustainability) {
        var weights = {!! json_encode($weights) !!};
        $.ajax({
           type:'POST',
           url:'/affecting_factors_data',
        //    data:{"_token": "{{ csrf_token() }}", value: Sustainability.value, type: "Sustainability"},
           data:{"_token": "{{ csrf_token() }}", value: Sustainability.value, type: "Sustainability", weights: weights},
           success:function(data){
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