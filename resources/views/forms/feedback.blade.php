@extends('layouts.app')

<title>{{_('Feedback | The Fragrance Hub | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

{{-- Slider --}}
<link href="{{ asset('css/feedback_slider.css') }}" rel="stylesheet">

@section('content')
{{-- JQuery for Ajax And Feedback Slider --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" defer>
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ url('feedback')}}" onsubmit="extract_values_helper()">
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
                                <div class="text" name="ui_js" id="ui_js">
                                    <span>User Interface</span>
                                    <strong>-</strong>
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
                                <div class="text" name="function_js" id="function_js">
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
                                <div class="text" id="recommend_js" name="recommend_js">
                                    <span>How likey are you to recommend it to a friend?</span>
                                    <strong>-</strong>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                
                <input type="hidden" name="ui" id="ui" value="">
                <input type="hidden" name="function" id="function" value="">
                <input type="hidden" name="recommend" id="recommend" value="">
                
                {{-- Button: Submit --}}
                <div class="center">
                    <button type="submit" class="custom">
                        <span class="before">{{_('Submit')}}</span>
                        <span class="after">{{_('Submit')}}</span>
                    </button>
                </div><br>

            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/feedback_slider.js') }}" defer></script>

<script>
    function extract_values_helper() {
        // ui
        var first = $("#ui_js").find("strong").html();
        document.getElementById("ui").value = first;

        // function
        var first = $("#function_js").find("strong").html();
        document.getElementById("function").value = first;

        // function
        var first = $("#recommend_js").find("strong").html();
        document.getElementById("recommend").value = first;
    }
</script>

@endsection