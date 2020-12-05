@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div id="app">
                    <layout></layout>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{mix('js/app.js')}}"></script>

@endsection