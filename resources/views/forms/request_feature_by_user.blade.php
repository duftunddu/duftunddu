@extends('layouts.app')

<title>{{_('Request Feature By Uuser | Admin Panel | The Fragrance Hub | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<style>
    .para{
        margin:auto 20px;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Request Feature')}}</div>
                    <form method="POST" action="{{ url('request_feature_user')}}">
                        @csrf
    
                    <div class="card-body">

                        @if($allowed)
                        <div class="form-group row">
                            <div class="para">
                                <h5>Instructions:</h5>
                                ○ You can only post one request at one time.<br>
                                ○ We review requests and add the most useful/intersting ones to the <a href="request_feature_view">voting table</a>.<br>
                                ○ There are numerous requests, we can not always provide the reasons in case of unacceptance.<br>
                                ○ If your request is interesting but vague, we will contact you for clarification.
                                <br><br>
                                <h5>Disclaimer:</h5>
                                If your request is accepted, your name will be displayed on the public page.
                            </div>
                        </div><br>

                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Feature Name:')}}</label>
                            <div class="col-md-6">

                                <input id="name" type="text" maxlength="40" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>
                                
                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Description --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-from-label text-md-right">{{ __('Description:')}}</label>
                            <div class="col-md-6">

                                <input id="description" type="text" maxlength="256" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description')}}" required>
                                
                                @error('description')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Implementation --}}
                        <div class="form-group row">
                            <label for="implementation" class="col-md-4 col-from-label text-md-right">{{ __('Implementation:')}}</label>
                            <div class="col-md-6">

                                <input id="implementation" type="text" maxlength="500" class="form-control @error('implementation') is-invalid @enderror" name="implementation" value="{{ old('implementation')}}">
                                
                                @error('implementation')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Button: Submit --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-7">
                                <button type="submit" class="custom">
                                    <span class="before">{{_('Submit')}}</span>
                                    <span class="after">{{_('Submit')}}</span>
                                </button>
                            </div>
                        </div>

                        @else
                        <div class="para">
                            <h5>Requests Limit Reached.</h5>
                            You can only post one request at one time.<br>
                            Your request is under review. You can post your next request after this one is processed.
                        </div>
                        @endif
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
