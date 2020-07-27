{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
@extends('layouts.app')

<title>{{_('Catalog | The Fragrance Hub | Duft Und Du')}}</title>

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{('Catalog | The Fragrance Hub | Duft Und Du')}}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 115vh;
        }
        .flex-left {
            /* background-image: url('https://cdn.shopify.com/s/files/1/1600/9217/products/Gem-Cut-Decanter-Detail.jpg?v=1498771896'); */
            /* background-attachment: fixed; */
            /* background-size: cover; */
            /* background-repeat: no-repeat;
            background-size: 100% 100%; */
            align-items: left;
            display: flex;
            justify-content: left;
            padding-top: 70px;
            padding-left: 100px;
        }
        .title {
            font-size: 75px;
        }
        .links > a {
            color: #636b6f;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        
    </style>
</head>
    
{{-- <body> --}}
    <div class="flex-left position-ref full-height">
        <div class="content">
            @include('forms.feature_slider_brand_ambassador')
        </div>
    </div>    
{{-- </body> --}}

@endsection