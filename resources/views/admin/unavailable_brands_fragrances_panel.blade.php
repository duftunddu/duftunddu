@extends('layouts.app')

<title>{{('Unavailable Brand & Fragrances Panel | Admin Panel | Duft Und Du')}}</title>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Unavailable Brand & Fragrances')}}</div>

                <div class="card-body">

                    {{-- @foreach($store_requests as $store_request) --}}

                    {{-- Name --}}
                    <div class="row h5">
                        {{-- <label for="name" class="col-md-4 col-from-label text-md-right"> {{ $loop->iteration }}  --}}
                        {{-- @if( $store_request->store )
                            Store
                        @endif
                        @if( $store_request->webstore )
                            Webstore 
                        @endif --}}
                            Name:</label>
                        {{-- <div class="col-md-6">  {{ $store_request->name }} </div> --}}
                    </div>

                    {{-- Address --}}
                    {{-- @if( $store_request->store )
                    <div class="row">
                        <label for="address" class="col-md-4 col-from-label text-md-right">Address:</label>
                        <div class="col-md-6"> {{ $store_request->address }}</div>
                    </div>
                    @endif --}}

                    {{-- Website --}}
                    {{-- @if( $store_request->webstore )
                    <div class="row">
                        <label for="website" class="col-md-4 col-from-label text-md-right">Website:</label>
                        <div class="col-md-6">
                            <a href="{{ $store_request->website }}">{{ $store_request->website }}</a>
                        </div>
                    </div>
                    @endif --}}

                    {{-- Social Link --}}
                    <div class="row">
                        <label for="social" class="col-md-4 col-from-label text-md-right">Social:</label>
                        <div class="col-md-6">
                            {{-- <a href="{{ $store_request->social_link }}">{{ $store_request->social_link }}</a> --}}
                        </div>
                    </div>

                    {{-- Approve / Reject--}}
                    <div class="row">
                        <label for="approval" class="col-md-4 col-from-label text-md-right">Action:</label>
                        <div class="col-md-6">
                            {{-- <a href="{{ url("/stores_requests_response/" . $store_request->id . "/approved") }}">Approve</a> / --}}
                            {{-- <a href="{{ url("/stores_requests_response/" . $store_request->id . "/rejected") }}">Reject</a> --}}
                        </div>
                    </div>
                    
                    <br>
                    {{-- @endforeach --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection