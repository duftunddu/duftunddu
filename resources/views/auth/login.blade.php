@extends('layouts.app')

<title>{{('Login | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<style>
    .pass-pad{
        margin-bottom:40px;
    }
    .sign-up-pad{
        margin-top:-10px;
        margin-bottom:-10px;
    }
    .side-pad{
        margin-left: 37px;
    }

    @media (max-width: 767px) {
    .pass-pad{
        margin-bottom:0;
    }
    .sign-up-pad{
        margin-top: 0;
        margin-bottom: 0;
    }
}
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Button: Login --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="custom">
                                    <span class="before">{{_('Login')}}</span>
                                    <span class="after">{{_('Login')}}</span>
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link pass-pad" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Sign Up --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 sign-up-pad" >
                                <a class="btn btn-link side-pad" href="{{ url('/register') }}">Sign Up</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
