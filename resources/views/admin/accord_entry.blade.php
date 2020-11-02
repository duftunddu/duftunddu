@extends('layouts.app')

<title>{{_('Accord Entry | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Accord Entry')}}</div>
                    <form method="POST" action="{{ url('accord_entry')}}">
                        @csrf
    
                    <div class="card-body">

                        {{-- Accord Family --}}
                        <div class="form-group row">
                            <label for="accord_family" class="col-md-4 col-from-label text-md-right">{{ __('Accord Family Name:')}}</label>
                            <div class="col-md-6">

                                <select id="accord_family_id" type="accord_family_id" class="form-control @error('accord_family_id') is-invalid @enderror" name="accord_family_id" value="{{ old('accord_family_id')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Accord Family --</option>
                                    
                                    @foreach($accord_families as $af)
                                        <option value="{{$af->id}}">{{$af->name}}</option>
                                    @endforeach

                                </select>

                                @error('accord_family_id')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="form-group row">
                                <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{" This Accord already exists"}}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>
                        
                        {{-- Button: Submit --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="custom">
                                    {{-- onclick="formProcess()" --}}
                                    <span class="before">{{_('Submit')}}</span>
                                    <span class="after">{{_('Submit')}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
