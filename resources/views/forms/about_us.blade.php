@extends('layouts.app')

<title>{{_('About Us | The Fragrance Hub | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    @section('description', 'About Duft Und Du.')

    <link href="{{ asset('css/about_us_content.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about_us.css') }}" rel="stylesheet">

</head>

@section('content')
        @include('forms.about_us_content')
@endsection