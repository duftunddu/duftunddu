@extends('layouts.app')

<title>{{_('Brand Ambassador Sign Up Procedure | The Fragrance Hub | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    

    <!-- Styles -->
    <link href="{{ asset('css/button_brand_ambassador.css') }}" rel="stylesheet">
    <link href="{{ asset('css/brand_ambassador_proposal.css') }}" rel="stylesheet">
</head>

@section('content')

<div class="container">
    {{-- Accordion --}}
    <div class="flex-center1 position-ref full-height">
        @include('features.feature_slider_brand_ambassador')
    </div>

    {{-- Steps --}}
    <div class="flex2 position-ref ">
        <div class="content">

            <div class="heading m-b-md">
                <h1>{{_('Steps to become a Brand Ambassador')}}</h1>
            </div>

            {{-- <br> --}}

            <div class="links">

                <h2>1. </h2><a href="{{ route('register')}}">
                    <h2>Sign Up</h2>
                </a>
                <h2> as a User</h2>

                <p>Sign Up as a User and fill all the required Details<br>
                    You will know that you are done once you reach the Dashboard</p>

                <br>

                <h2>2. Come back to </h2><a href="{{ url('#')}}">
                    <h2>Brand Ambassador</h2>
                </a>

                <p>A button will show up right below. You can sign up to become a Brand Ambassador here.<br>
                    If the button doesn't show, reload the page and make sure that you are logged in your account</p>

            </div>
            <br><br>

            @unlessrole('brand_ambassador|premium_brand_ambassador')
            @hasrole('user|premium_user|super-admin')
            <div class="center">
                <a href="/brand_ambassador_register" class="animated-button15" style="position: relative; center">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Brand Ambassador
                </a>
            </div>
            @endhasrole
            @endunlessrole

            <br><br><br><br>
            <div class="links">

                <h2>3. Verification Period </h2>

                <p>After the signing up process. Our team will then verify your details.<br>
                    And after verificaiton, you can access your <a href="{{ url('ambassador_home')}}">Ambassador
                        Dashboard</a><br>
                    Instructions to use Ambassador Dashboard are provided <a
                        href="{{ url('ambassador_guide')}}">here.</a></p>

                <br>

                <h2>We welcome you as a member of the Duft Und Du Community</h2>

                <br><br><br>
                <a>
                    <h2 style="">{{_('Premium Features Coming Soon')}}</h2>
                </a>

            </div>

            <br><br><br>

        </div>
    </div>

</div>
@endsection