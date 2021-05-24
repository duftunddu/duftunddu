@extends('layouts.app')

<title>Online Store Register Guide | The Fragrance Hub | Duft Und Du</title>
{{-- @section('title', 'Online Store Register Guide | The Fragrance Hub | Duft Und Du') --}}
@section('description', 'Show Fragrance Reviews to the customers in your shop by joining Duft Und Du.')

@push('head_scripts')
<link href="{{ asset('css/button_brand_ambassador.css') }}" rel="stylesheet">
<link href="{{ asset('css/webstore_proposal.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container">

    <h1 class="title-p">Online Stores</h1>
    <div class="top-pic"></div>

    {{-- Accordion --}}
    <div class="flex-1 position-ref full-height">
        @include('features.feature_slider_webstore_proposal')
    </div>

    <div><span id="sb-pos" class="sleek-border"></span></div>

    {{-- Steps --}}
    <div class="flex2 position-ref">
        <div class="content">

            <div class="heading m-b-md">
                <h1>Steps to register your online store</h1>
            </div>

            <div class="links">

                <h2>1. <a href="{{ route('register')}}">
                    Sign Up
                </a> as a User</h2>

                <p>Sign Up as a User and fill all the required Details<br>
                    You will know that you are done once you reach the Dashboard</p>

                <br>

                <h2>2. Click the button below</h2>

                <p>A button will show up right below. You can sign up to become a Brand Ambassador here.<br>
                    If the button doesn't show, reload the page and make sure that you are logged in your account</p>

            </div>
            <br><br>

            <div class="center">
                <a href="/webstore_register" class="animated-button15" style="position: relative; center">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Register Online Store
                </a>
            </div>

            <br><br><br><br>
            <div class="links">

                <h2>3. Verification Period </h2>

                <p>After the signing up process. Our team will then verify your details.<br>
                    And after verificaiton, you can access your <a href="{{ url('/webstore_home')}}">
                        Online Store Dashboard</a><br>

                <br>

                <h2>We welcome you as a member of the Duft Und Du Community</h2>

                <br><br><br>
                <h2>Premium Features Coming Soon</h2>

            </div>

            <br><br><br>

        </div>
    </div>

</div>
@endsection