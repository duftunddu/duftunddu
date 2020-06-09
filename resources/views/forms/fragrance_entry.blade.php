@extends('layouts.app')


{{-- Professions/Occupations List --}}
{{-- <script src="https://gist.github.com/ag14spirit/fbf877576c9d6b78899e3ad02fe92b50.js"></script> --}}

@section('content')

{{-- Range Slider Function --}}
<link href="{{ asset('css/range_slider_strength.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider_strength.js') }}" defer></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ url('fragrance_entry')}}">
                    @csrf

                    {{-- Fragrance Table --}}
                    <div class="card">
                        <div class="card-header">{{ __('Fragrance Entry')}}</div>

                        <div class="card-body">

                            {{-- Brand --}}
                            <div class="form-group row">
                                <label for="brand_id" class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>

                                <div class="col-md-6">

                                    <select id="brand_id" type="brand_id" class="form-control @error('brand_id') is-invalid @enderror" name="brand_id" value="{{ old('brand_id')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Brand --</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('brand_id')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Fragrance --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Fragrance Name:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Type --}}
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-from-label text-md-right">{{ __('Type:')}}</label>

                                <div class="col-md-6">

                                    <select id="type" type="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type')}}" required autocomplete="Eau de Toilette">
                                        <option value="" selected>-- Select Type --</option>
                                        <option value="1">
                                            {{'Perfume (Parfum)'}}
                                        </option>
                                        <option value="2">
                                            {{'Eau de Parfum'}}
                                        </option>
                                        <option value="3">
                                            {{'Eau de Toilette'}}
                                        </option>
                                        <option value="4">
                                            {{'Eau de Cologne'}}
                                        </option>
                                        <option value="5">
                                            {{'Eau Fraiche'}}
                                        </option>
                                        <option value="6">
                                            {{'Attar'}}
                                        </option>
                                        <option value="7">
                                            {{'Mist'}}
                                        </option>
                                        <option value="8">
                                            {{'Air Freshner'}}
                                        </option>
                                    </select>

                                    @error('type')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Gender --}}
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-from-label text-md-right">{{ __('This Fragrance Suits:')}}</label>

                                <div class="col-md-6">

                                    <select id="gender" type="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender')}}" required>
                                        <option value="" selected>-- Select Gender --</option>
                                        <option value="1">
                                            {{'Male'}}
                                        </option>
                                        <option value="2">
                                            {{'Female'}}
                                        </option>
                                        <option value="3">
                                            {{'Unisex'}}
                                        </option>
                                    </select>

                                    @error('gender')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Cost --}}
                            <div class="form-group row">
                                <label for="cost" class="col-md-4 col-from-label text-md-right">{{ __('Cost:')}}</label>

                                <div class="col-md-6">
                                    <input id="cost" type="cost" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ ('')}}" required>

                                    @error('cost')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                         --}}
                        </div>
                    </div>

                    <br>

                    {{-- Accord Table --}}
                    <div class="card">
                        <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>

                        <div class="card-body">
                            
                            {{-- Accord --}}
                            <div class="form-group row">
                                <label for="accord_id" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                                <div class="col-md-6">

                                    <select id="accord_id" type="accord_id" class="form-control @error('accord_id') is-invalid @enderror" name="accord_id" value="{{ old('')}}" required>
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

                            {{-- Button: Add Another Accord --}}
                            {{-- <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="another" class="btn btn-secondary">
                                        {{ __('Add Another Accord') }}
                                    </button>
                                </div>
                            </div> --}}

                        </div>
                    </div>

                    <br>

                    {{-- Ingredient Table --}}
                    <div class="card">
                        <div class="card-header">{{ __('Fragrance Note Entry')}}</div>

                        <div class="card-body">

                            {{-- Ingredient --}}
                            <div class="form-group row">
                                <label for="ingredient_id" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label>

                                <div class="col-md-6">

                                    <select id="ingredient_id" type="ingredient_id" class="form-control @error('ingredient_id') is-invalid @enderror" name="ingredient" value="{{ old('')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Ingredient --</option>
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                                        @endforeach

                                    </select>

                                    @error('ingredient_id')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Note --}}
                            <div class="form-group row">
                                <label for="note" class="col-md-4 col-from-label text-md-right">{{ __('Note:')}}</label>

                                <div class="col-md-6">

                                    <select id="note" type="note" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('')}}" required autocomplete="Top">
                                        <option value="" selected="selected" disabled="disabled">-- Select Note --</option>
                                        <option value="1">
                                            {{'Top'}}
                                        </option>
                                        <option value="2">
                                            {{'Middle'}}
                                        </option>
                                        <option value="3">
                                            {{'Base'}}
                                        </option>
                                    </select>

                                    @error('note')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Strength --}}
                            <div class="form-group row">
                                <label for="strength" class="col-md-4 col-from-label text-md-right">{{ __('Strength:')}}</label>

                                <div class="col-md-6">
                                   
                                    <input type="range" min="0" max="100" value="0" class="slider" id="strength" name="strength" required>
                                    <label>{{_('Value: ')}}<span id="value"></span></label>
                                        

                                    @error('strength')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Button: Add Another Ingredient --}}
                            {{-- <div class="form-group row mb-0">
                                <div class="col-md-9 offset-md-4">
                                    <button type="another" class="btn btn-secondary">
                                        {{ __('Add Another Ingredient') }}
                                    </button>
                                </div>
                            </div> --}}

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
                </form>
            </div>
        </div>
    </div>
@endsection
