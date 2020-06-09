@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ingredient for Note Entry')}}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ url('note_entry')}}">
                        @csrf

                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('') }}" required autofocus>

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Button: Add Another --}}
                        {{-- <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="add another" class="btn btn-secondary">
                                    {{ __('Add Another') }}
                                </button>
                            </div>
                        </div> --}}

                        {{-- Button: Submit --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-8">
                                <button type="submit" class="btn btn-primary" onclick="formProcess()">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection