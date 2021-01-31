@extends('layouts.app')

<title>{{('Stores Requests | Admin Panel | Duft Und Du')}}</title>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Stores Requests Panel')}}</div>

                <div class="card-body">

                    {{-- Shops --}}
                    <div class="form-group row">
                        <h4>Shops</h4>
                    </div>

                    @foreach($store_requests as $store_request)
                    {{-- Name --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">Store Name:</label>
                        <div class="col-md-6"> {{ $store_request->name }}</div>
                    </div>

                    {{-- Address --}}
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-from-label text-md-right">Address:</label>
                        <div class="col-md-6"> {{ $store_request->address }}</div>
                    </div>

                    {{-- Social Link --}}
                    <div class="form-group row">
                        <label for="social" class="col-md-4 col-from-label text-md-right">Social:</label>
                        <div class="col-md-6"> <a href="{{ $store_request->social }}">{{ $store_request->social }}</div>
                    </div>

                    {{-- Approve / Reject--}}
                    <div class="form-group row">
                        <label for="approval" class="col-md-4 col-from-label text-md-right">Action:</label>
                        <div class="col-md-6">
                            <a href="{{ url("/stores_requests/store/{{$store_request->id}}/approved" ) }}">Approve</a> /
                            <a href="{{ url("/stores_requests/store/{{$store_request->id}}/rejected" ) }}">Reject</a>
                        </div>
                    </div>
                    @endforeach

                    <br>

                    {{-- Online Stores --}}
                    <div class="form-group row">
                        <h4>Online Stores</h4>
                    </div>

                    @foreach($webstore_requests as $webstore_request)
                    {{-- Name --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">Store Name:</label>
                        <div class="col-md-6"> {{ $webstore_request->name }}</div>
                    </div>

                    {{-- Address --}}
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-from-label text-md-right">Address:</label>
                        <div class="col-md-6"> {{ $webstore_request->address }}</div>
                    </div>

                    {{-- Website --}}
                    <div class="form-group row">
                        <label for="website" class="col-md-4 col-from-label text-md-right">Website:</label>
                        <div class="col-md-6"> <a href="{{ $webstore_request->website }}">{{ $store_request->website }}
                        </div>
                    </div>

                    {{-- Social Link --}}
                    <div class="form-group row">
                        <label for="social" class="col-md-4 col-from-label text-md-right">Social:</label>
                        <div class="col-md-6"> <a href="{{ $webstore_request->social }}">{{ $store_requests->social }}
                        </div>
                    </div>

                    {{-- Approve / Reject--}}
                    <div class="form-group row">
                        <label for="approval" class="col-md-4 col-from-label text-md-right">Action:</label>
                        <div class="col-md-6">
                            <a href="{{ url("/stores_requests/webstore/{{$webstore_request->id}}/approved" )
                                }}">Approve</a> /
                            <a href="{{ url("/stores_requests/webstore/{{$webstore_request->id}}/rejected" )
                                }}">Reject</a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection