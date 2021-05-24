@extends('layouts.app')

@section('meta')
<title>{{('Search Fragarance | Shop | Duft Und Du')}}</title>
@endsection

@push('head_scripts')

    {{-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" defer></script>

    {{-- Requirement already satisfied --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> --}}
@endpush


@section('content')
<div class="container">

    <input class="typeahead">

</div>
@endsection

@section('foot_scripts')
{{-- <script>
var path = "{{ url('/try_api') }}";
$('input.typeahead').typeahead({
    source:  function (to_search, process) {
    return $.get(path, { to_search: to_search }, function (data) {
            return process(data);
        });
    }
});
</script> --}}

<script src="{{ asset('js/try.js') }}" defer></script>
@endsection
