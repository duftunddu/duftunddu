@extends('layouts.app')

<title>{{('Sign Up | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right required">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right required">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right required">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right required">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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

                        {{-- Captcha - Google v2 --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-4">
                                <div class="col-md-9">
                                    <div class="g-recaptcha" data-sitekey="6Le4qOsZAAAAAIztp49Lp9JqnOuOSfhx9GcJe1Gd"></div>
                                </div>
                            </div>
                        </div>
                        
                        <br>

                        {{-- Button: Register --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-4">
                                <div class="col-md-9">

                                <button type="submit" class="custom">
                                    <span class="before">{{_('Register')}}</span>
                                    <span class="after">{{_('Register')}}</span>
                                </button>
                                </div>
                            </div>
                        </div>
                        <br>

                        {{-- Login --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <div class="col-md-9">
                                    &nbsp;&nbsp;&nbsp;<a class="btn btn-link" href="{{ url('/login') }}">Login</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
