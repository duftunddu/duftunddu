@extends('layouts.app')

<title>{{_('Report | The Fragrance Hub | Duft Und Du')}}</title>

@section('content')

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Report')}}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ url('report')}}">
                        @csrf

                        {{-- Report Type --}}
                        <div class="form-group row">
                            <label for="type_id" class="col-md-4 col-from-label text-md-right">{{ __('Report Regarding:')}}</label>

                            <div class="col-md-6">
                                <select id="type_id" type="type_id"
                                    class="form-control @error('type_id') is-invalid @enderror" name="type_id"
                                    value="{{ old('type_id')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Report Type --</option>

                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach

                                </select>

                                @if($errors->has('type_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_id')}}
                                </div>
                                @endif

                            </div>
                        </div>


                        {{-- Comment --}}
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-from-label text-md-right">{{ __('Report:')}}</label>

                            <div class="col-md-6">
                                <input id="comment" type="text" maxlength="300" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required>

                                @error('comment')
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