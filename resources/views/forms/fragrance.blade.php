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
        text-align:justify;
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{'Fragrance: '}} {{ __($fragrance->name)}}</div>
                <div class="card-body">

                    <div class="row">
                        <div class="column">
                            <div class="col-md-9">

                                <h4>Type: {{$type->name}}</h4>
                                <h4>Gender: {{$fragrance->gender}}</h4>
                                <h4>Cost: {{$fragrance->cost}} {{$fragrance->currency}}</h4>
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

                        <div class="column">
                            <div class="right">
                                @if($logged_in)
                                    <h4 data-toggle="tooltip" data-placement="top" data-html="true" title="How long the fragrance lasts.<br>100 is max.">Longevity: {{$longevity}}</h4>
                                    <h4 data-toggle="tooltip" data-placement="top" data-html="true" title="Depends on season.<br>100 is average.<br>Above 100 is better.">Suitability: {{$suitability}}</h4>
                                    <h4 data-toggle="tooltip" data-placement="top" data-html="true" title="How much heat affects the longevity of fragrance.<br>100 means unaffected. Below 100 means it will wear off sooner.">Sustainability: {{$sustainability}}</h4>
                                    
                                    <br><p>
                                        These are personalized numbers.<br>
                                        These factors were researched and calculated using your region's weather data and the additional details you provided.<br>
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
        
                                @endif
                            </div>
                        </div>

                    </div>

                    @if($allow_edit)
                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-0">
                                <button type="submit" class="btn btn-outline-dark"  onclick="window.location='{{ url('fragrance_edit/'.$fragrance->id) }}'">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div><br>
                    @endif
                  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
    
@endsection