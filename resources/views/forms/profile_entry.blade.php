@extends('layouts.app')

<title>{{('Brand Entry | The AI Powered Fragrance Genie')}}</title>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Brand Entry')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('brand_entry')}}">
                            @csrf

                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tier --}}
                            <div class="form-group row">
                                <label for="tier" class="col-md-4 col-from-label text-md-right">{{ __('Tier:')}}</label>

                                <div class="col-md-6">

                                    <select id="tier" type="tier" class="form-control @error('tier') is-invalid @enderror" name="tier" value="{{ old('tier')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Tier --</option>
                                        <option value="1">
                                            {{'Low-End'}}
                                        </option>
                                        <option value="2">
                                            {{'Low'}}
                                        </option>
                                        <option value="3">
                                            {{'Mid'}}
                                        </option>
                                        <option value="4">
                                            {{'High'}}
                                        </option>
                                        <option value="5">
                                            {{'High-End'}}
                                        </option>
                                    </select>

                                    @error('tier')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Origin --}}
                            {{-- Country --}}
                            <div class="form-group row">
                                <label for="origin" class="col-md-4 col-from-label text-md-right">{{ __('Origin:')}}</label>

                                <div class="col-md-6">
                                    
                                    <select id="origin" type="origin" class="form-control @error('origin') is-invalid @enderror" name="origin" value="{{ old('origin')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('origin'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('origin_id')}}
                                    </div>
                                @endif
                                </div>
                            </div>
                            
                            {{-- Submit --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
