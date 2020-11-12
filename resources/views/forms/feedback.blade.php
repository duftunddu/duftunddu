@extends('layouts.app')

<title>{{_('Feedback | The Fragrance Hub | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

{{-- Slider --}}
<link href="{{ asset('css/feedback_slider.css') }}" rel="stylesheet">

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" defer>
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ url('feedback')}}">
                @csrf

                <div class="center small-caps">
                    <h1>Feedback</h1>
                </div><br><br>

                <div class="row">

                    {{-- Left --}}
                    <div class="column">

                        {{-- User Interface --}}
                        <div class="form-group row">
                            <div class="slider">
                                <div class="ui-slider-handle">
                                    <div class="smiley">
                                        <svg viewBox="0 0 34 10" version="1.1">
                                            <path d=""></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text">
                                    <span>User Interface</span>
                                    <strong id="first" name="first">-</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Functionality --}}
                        <div class="form-group row">
                            <div class="slider">
                                <div class="ui-slider-handle">
                                    <div class="smiley">
                                        <svg viewBox="0 0 34 10" version="1.1">
                                            <path d=""></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text">
                                    <span>Functionality</span>
                                    <strong id="first" name="first">-</strong>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Right --}}
                    <div class="column">

                        {{-- Friend Recommend--}}
                        <div class="form-group row">
                            <div class="slider">
                                <div class="ui-slider-handle">
                                    <div class="smiley">
                                        <svg viewBox="0 0 34 10" version="1.1">
                                            <path d=""></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text">
                                    <span>How likey are you to recommend it to a friend?</span>
                                    <strong id="first" name="first">-</strong>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- Button: Submit --}}
                <div class="center">
                    <button type="submit" class="custom">
                        <span class="before">{{_('Submit')}}</span>
                        <span class="after">{{_('Submit')}}</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/feedback_slider.js') }}" defer></script>

{{-- Suitability --}}
{{-- <script>
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
</script> --}}


@endsection