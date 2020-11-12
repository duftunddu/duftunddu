@extends('layouts.app')

<title>{{('Add Details | The AI Powered Fragrance Genie')}}</title>

@section('content')

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ url('request_brand')}}">
                @csrf
                
                <div class="card">
                    <div class="card-header">{{ __('Request Brand')}}</div>
                    <div class="card-body">
                        
                        {{-- Explanation --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-2">
                                We contact the brand after votes reach a certain threshold.<br>
                                {{-- <small>Any suspicious behaviour may result in suspension or terminaton of account.</small> --}}
                            </div>
                        </div><br>

                        {{-- Brand Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Brand Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required>
                            
                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ "This Brand Already Exists" }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Brand Website --}}
                        <div class="form-group row" >
                            <label for="website" class="col-md-4 col-from-label text-md-right">{{ __('Brand Website:')}} </label>
                            
                            <div class="col-md-6">
                                <input id="website" type="url" pattern="https?://.*" placeholder="https://www.chanel.com" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website')}}" required>
                            
                                @error('website')
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
                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection