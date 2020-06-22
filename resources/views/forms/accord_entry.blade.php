@extends('layouts.app')

<title>{{_('Accord Entry | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ url('accord_entry')}}">
                    @csrf

                    <div class="card">
                        <div class="card-header">{{ __('Accord Entry')}}</div>

                        <div class="card-body">

                            {{-- Name --}}
                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            {{-- Button: Submit --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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