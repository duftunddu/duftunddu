@extends('layouts.app')

<title>{{_('Brand Ambassador Sign Up Procedure | The Fragrance Hub | Duft Und Du')}}</title>

<head>    
    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}

    <link href="{{ asset('css/button_brand_ambassador.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            /* color: #212529; */
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 90% !important;
        }

        .flex-center1 {
            /* background-image: url("../images/abstract/pawel-czerwinski-tMbQpdguDVQ-unsplash_use.jpg");
            background-attachment: fixed;
            background-size: cover; */
            /* background-repeat: no-repeat; */
            /* background-position: top right; */
            /* background-size: 50%; */
        }
        
        .flex2 {
            /* background-image: url('../images/progress/stairs-918735_use.jpg'); */
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
            /* background-size: 100% 100%; */
            background-position: center center;
            
            align-items: left;
            display: flex;
            justify-content: center;
        }
        
        .position-ref {
            position: relative;
        }
        
        .content {
            font-variant: small-caps;
        }

        .title {
            font-size: 6.3vw;
        }

        .heading{
            font-size: 1.3vw;
        }

        .links > a {
            font-size: 1vw;
            font-weight: 600;
            letter-spacing: 0.12vw;
            text-decoration: none;
            /* text-transform: uppercase; */
            color:#8167a9;
        }
        a{
            color:#8167a9;
        }

        h1{
            letter-spacing: 0.2vw;
        }

        h2{
            font-size: 1vw;
            display: inline;
        }

        p{
            font-size: 1.8vw;
            font-weight: bold;
            letter-spacing: 0.09vw;
        }

        .top-pad-fix{
            margin-top: -3rem;
        }

        .m-b-md {
            margin-bottom: 2.26vw;
        }

        .center {
            display: flex;
            justify-content: center;
        }

        /* Header Fix */
        .navigation-wrap{
            /* width: 67% !important; */
            /* margin-left:75px; */
        }

        /* Transitions */
        .icon{
            opacity: 1;
            transform: translate(0);
            transition: all 200ms linear;
            transition-delay: 600ms;
        }
        body.hero-anime .icon{
            opacity: 0;
            transform: translateY(8px);
            transition-delay: 700ms;
        }

        .heading{
            opacity: 1;
            transform: translate(0);
            transition: all 200ms linear;
            transition-delay: 700ms;
        }
        body.hero-anime .heading{
            opacity: 0;
            transform: translateY(8px);
            transition-delay: 700ms;
        }

        span{
            opacity: 1;
            transform: translate(0);
            transition: all 250ms linear;
            transition-delay: 1000ms;
        }
        body.hero-anime span{
            opacity: 0;
            transform: translateY(50px);
            transition-delay: 1000ms;
        }

    </style>
</head>

@section('content')

{{-- Accordion --}}
<div class="flex-center1 position-ref full-height top-pad-fix">
    @include('features.feature_slider_brand_ambassador')
</div>

{{-- Steps --}}
<div class="flex2 position-ref ">
    <div class="content">

        <div class="heading m-b-md">
            <h1>{{_('Steps to become a Brand Ambassador')}}</h1>
        </div>

        <br>

        <div class="links">

            <h2>1. </h2><a href="{{ route('register')}}"><h2>Sign Up</h2></a><h2> as a User</h2>
            
                <p>Sign Up as a User and fill all the required Details<br>
                    You will know that you are done once you reach the Dashboard</p>

            <br>
            
            <h2>2. Come back to </h2><a href="{{ url('#')}}"><h2>Brand Ambassador</h2></a> 
            
                <p>A button will show up right below. You can sign up to become a Brand Ambassador here.<br>
                    If the button doesn't show, reload the page and make sure that you are logged in your account</p>

        </div>
        <br><br>

        @unlessrole('brand_ambassador|premium_brand_ambassador')
        @hasrole('user|premium_user|super-admin')
        <div class="center">
            <a href="brand_ambassador_register" class="animated-button15" style="position: relative; center">
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
                And after verificaiton, you can access your <a href="{{ url('ambassador_home')}}">Ambassador Dashboard</a><br>
                Instructions to use Ambassador Dashboard are provided <a href="{{ url('ambassador_guide')}}">here.</a></p>

            <br>

            <h2>We welcome you as a member of the Duft Und Du Community</h2>
        
            <br><br><br>
            <a><h2 style="">{{_('Premium Features Coming Soon')}}</h2></a>

        </div>

        <br><br><br>

    </div>
</div>

@endsection