@extends('layouts.app')

<title>{{_('Dashboard - Duft Und Du')}} </title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .full-height {
            height: 75vh;
        }

        .full-width{
            width: 100vw;
        }

        .flex-center1 {
            /* background-image: url("https://www.designisthis.com/blog/images/uploads/2012/08/AnestasiA-Vodka.jpg"); */
            /* background-attachment: fixed; */
            /* background-size: cover; */
            /* background-repeat: no-repeat; */
            /* background-position: center top; */
            /* background-size: 100% 100%; */

            align-items: left;
            display: flex;
            justify-content: left;
            /* padding-top: 7.73vw; */
            /* padding-left: 10.1vw; */

            /* color:slategrey; */
        }

    </style>

</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{_('Dashboard')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Favorite Brand --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Favorite Brand:')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    {{-- All Entered Fragrances --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('All Entered Fragrances:')}}</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>
    
                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    {{-- Add a Fragrance - Button --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-8">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add a Fragrance') }}
                            </button>
                        </div>
                    </div>
                    
                    <br>

                    {{-- Existing Profiles --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Existing Profiles:')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>
        
                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    {{-- Add a Profile - Button --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-8">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add a Profile') }}
                            </button>
                        </div>
                    </div>

                    {{-- <div class="flex-center1 position-ref full-height full-width">
                        <div div class="col-sm-12 col-md-3 col-lg-2">
                            <h1>{{_('Dashboard')}}</h1>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
