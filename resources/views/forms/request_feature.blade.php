@extends('layouts.app')
{{-- @extends('layouts.nav_bar') --}}
<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">

<title>{{_('Request A Feature | Duft Und Du')}}</title>

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h1>{{ __('Request A Feature')}}</h1>
                
                <p>
                    {{ __('
                    Duft Und Du came into being when a nosy undergrad student thought about
                    putting an end to the endless suffering of going through random fragrances in
                    the pursuit of the One.
                    ')}}
                </p>

                <br>

            </div>
        </div>
    </div>
@endsection
