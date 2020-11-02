@extends('layouts.app')

<title>{{_('Note Entry | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

@section('content')

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ingredient for Note Entry')}}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ url('note_entry')}}">
                        @csrf

                        {{-- Accord --}}
                        <div class="form-group row">
                            <label for="accord_id" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>
                            <div class="col-md-6">
                            
                                <select id="accord_id" type="number" class="form-control @error('accord_id') is-invalid @enderror" name="accord_id" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Accord --</option>
                                    
                                    @foreach($accords as $accord)
                                        <option value="{{$accord->id}}">{{$accord->name}}</option>
                                    @endforeach
                                
                                </select>
                            
                                @error('accord_id')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{"This Ingredient already exists"}}</strong>
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
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection