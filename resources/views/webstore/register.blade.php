@extends('layouts.app')

<title>{{('Shop Registration | The AI Powered Fragrance Genie')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ url('store_register')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Shop Details')}}</div>
                    <div class="card-body">

                        {{-- Explanation --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-2">
                                <h4>Guidelines</h4>
                                The store name and its website link will be public.<br>
                                Providing full information supports your applicaton for approval.<br>
                                <small>Any suspicious behaviour may result in suspension or terminaton of
                                    account.</small>
                            </div>
                        </div><br>

                        {{-- Store Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Store Name:')}}</label>

                            <div class="col-md-6">
                                <input type="text" maxlength="50" id="name"  placeholder="Store Name" class="form-control @error('name') 
                                is-invalid @enderror" name="name" value="{{ old('name')}}" required>

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Website --}}
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-from-label text-md-right">{{ __('Website Link:')}}</label>
                            <div class="col-md-6">
                                <input id="website" type="url" placeholder="https://www.xyz.com" pattern="https?://*.*.*"
                                    class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website')}}" required>

                                @error('website')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Contact Number --}}
                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-from-label text-md-right">{{ __('Contact Number:')}}</label>

                            <div class="col-md-6">
                                <input type="tel" maxlength="20" id="contact_number"  placeholder="+xx xxx xxxxxxx" class="form-control @error('contact_number') 
                                is-invalid @enderror" name="contact_number" value="{{ old('contact_number')}}" required>

                                @error('contact_number')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Facebook or Instagram Link --}}
                        <div class="form-group row">
                            <label for="social" class="col-md-4 col-from-label text-md-right">{{ __('FB or Insta Link:')}}</label>
                            <div class="col-md-6">
                                <input id="social" type="url" placeholder="https://www.facebook.com/xyz"
                                    class="form-control @error('social') is-invalid @enderror" name="social" value="{{ old('social')}}" >

                                @error('social')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Terms & Conditions --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms_conditions" id="terms_conditions" required>

                                    <label class="form-check-label" for="terms_conditions">
                                        {{-- I agree to the Terms & Conditions --}}
                                        I have read the <a href="{{ url('/terms_and_conditions') }}">Terms & Conditions</a> and I agree to them.
                                    </label>
                                
                                </div>
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

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection