@extends('layouts.app')
{{-- @extends('layouts.nav_bar') --}}
<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">

<title>{{_('Whitepaper | The AI Powered Fragrance Genie | Duft Und Du')}}</title>


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <br>

                <h2>{{ __('Whitepaper')}}</h2>

                <br>

                <p>
                    {{ __('
                    Duft Und Du came into being when a nosy undergrad student thought about
                    putting an end to the endless suffering of going through random fragrances in
                    the pursuit of the One.
                    ')}}
                </p>

                <br>

                <p>{{ __('The undergrad had always found the idea of using AI to solve practical problems fascinating.')}}</p>

                <br>

                <p>
                    {{ __('And when the fascination and nose met... Lets be real, that does not make any sense.')}}
                </p>

                <br>

                <p>
                    {{ __('Scratch that!')}}
                </p>

                <br>

                <p>
                    {{ __('So, while wandering in the greenhouse, ugh, I mean the cave obviously, the undergrad found a lamp...')}}
                </p><p>
                    {{ __('And the rest is, as they say, artificial intelligence.')}}
                </p>

            </div>
        </div>
    </div>
@endsection
