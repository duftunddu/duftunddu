@extends('layouts.app')

<title>Duft Und Du | Fragrance & You | Get Personalized Fragrance Reviews | The AI Fragrance Genie | The Fragrance Hub</title>
{{-- @section('title', '') --}}

@section('description', 'Duft Und Du gives you personalized fragrance reviews for free. Business integrations for
shops and online stores are also available.')

@push('head_scripts')
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
<link href="{{ asset('css/about_us_content.css') }}" rel="stylesheet">

{{-- Typing Effect --}}
<link href="{{ asset('css/typing_effect.css') }}" rel="stylesheet">
<link href="{{ asset('css/scroll_down_button.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="flex-1-center position-ref full-height" id="scroll-section-1">
    <div class="flex-1-content">
        <br>

        {{-- Title --}}
        <div class="title m-b-md">
            <!-- <div data-toggle="tooltip" data-placement="top" title="German For Fragrance And You">Duft Und Du</div> -->
            Duft Und Du
        </div>

        {{-- Typing Effect --}}
        <div class="heading m-b-md lux-black-font">
            <span class="item">&nbsp;</span>
            <div class="wrapper">

                <div data-text></div>
                <span class="item">The Fragrance Hub</span>
                <span class="item">AI Powered Genie</span>
                <span class="item">Smell Good, Feel Good</span>

            </div>
        </div>

        <br>

        {{-- Links --}}
        <div class="para lux-black-font">

            <h2 class="">Lets grant your wish to smell good</h2><br><br>

            <a class="link gold-color" href="/search_engine">
                <h2>Get Personalized Fragrance Review</h2>
            </a><br><br>

            <h2 class="">Fragrance Recommendations<br>Coming Soon</h2>

            <br><br>

            <h2 class="gold-color">{{_('PREMIUM FEATURES COMING SOON')}}</h2>

        </div>
    </div>

    {{-- Button: Scroll Down --}}
    <div class="scroll-down">
        <a id="scroll-link" href="#scroll-section-2"><span></span>Scroll</a>
    </div>

</div>

<div class="flex-2-left position-ref" id="scroll-section-2">
    <div class="flex-2-placement">
        <h1 class="flex-2-title">Genie Services</h1>
        <div class="flex-2-item">
            @include('features.services_accordion')
        </div>
    </div>

    {{-- Button: Scroll Down --}}
    <div class="scroll-down">
        <a class="flex-2-white" id="scroll-link" href="#scroll-section-3"><span></span>Scroll</a>
    </div>

</div>

<div class="flex-3-center position-ref full-height" id="scroll-section-3">

    @include('features.feature_slider')

    {{-- Button: Scroll Down --}}
    <div class="scroll-down">
        <a class="flex-2-white" id="scroll-link" href="#scroll-section-4"><span></span>Scroll</a>
    </div>

</div>

<div class="flex-4-right position-ref full-height" id="scroll-section-4">
    @include('forms.about_us_content')
</div>

<script src="{{ asset('js/typing_effect.js') }}" defer></script>

@endsection