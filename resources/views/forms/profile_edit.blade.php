@extends('layouts.app')

<title>{{('Add Details | The AI Powered Fragrance Genie')}}</title>

@section('content')

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

{{-- Range Slider Function --}}
<link href="{{ asset('css/range_slider_sweat.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider_sweat.js') }}" defer></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ url('profile')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('User Details')}}</div>

                    <div class="card-body">

                        {{-- Gender --}}
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-from-label text-md-right">{{ __('Gender:')}}</label>

                            <div class="col-md-6">

                                <select id="gender" type="text"
                                    class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    value="{{ old('gender')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Gender --
                                    </option>
                                    <option value="Male">
                                        {{'Male'}}
                                    </option>
                                    <option value="Female">
                                        {{'Female'}}
                                    </option>
                                    <option value="Other">
                                        {{'Other'}}
                                    </option>
                                </select>

                                @error('gender')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- DOB --}}
                        <div class="form-group row">
                            <label for="dob"
                                class="col-md-4 col-from-label text-md-right">{{ __('Date of Birth:')}}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" min="1900-01-01"
                                    class="form-control @error('dob') is-invalid @enderror" name="dob"
                                    value="{{ old('dob')}}" required>

                                @error('dob')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Profession --}}
                        <div class="form-group row">
                            <label for="profession_id"
                                class="col-md-4 col-from-label text-md-right">{{ __('Profession:')}}</label>

                            <div class="col-md-6">

                                <select id="profession_id" type="number"
                                    class="form-control @error('profession_id') is-invalid @enderror"
                                    name="profession_id" value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Profession --
                                    </option>
                                    @foreach($professions as $profession)
                                    <option value="{{$profession->id}}">{{$profession->name}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('profession_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('profession_id')}}
                                </div>
                                @endif

                            </div>
                        </div>

                        {{-- Skin Type --}}
                        <div class="form-group row">
                            <label for="skin_type_id"
                                class="col-md-4 col-from-label text-md-right">{{ __('Skin Type:')}}</label>

                            <div class="col-md-6">

                                <select id="skin_type_id" type="number"
                                    class="form-control @error('skin_type_id') is-invalid @enderror" name="skin_type_id"
                                    value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Skin Type --
                                    </option>
                                    @foreach($skin_types as $skin_type)
                                    <option value="{{$skin_type->id}}">{{$skin_type->name}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('skin_type_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('skin_type_id')}}
                                </div>
                                @endif

                            </div>
                        </div>

                        {{-- Sweat --}}
                        <div class="form-group row">
                            <label for="sweat"
                                class="col-md-4 col-from-label text-md-right">{{ __('How much do you sweat:')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer">
                                    <input type="range" min="0" max="100" value="0" class="slider myRange" id="myRange"
                                        name="sweat" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                </div>

                                @error('sweat')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Height --}}
                        <div class="form-group row">
                            <label for="height"
                                class="col-md-4 col-from-label text-md-right">{{ __('Height (in inches):')}}</label>

                            <div class="col-md-6">
                                <input id="height" type="number" step="0.01" min="12" max="110" placeholder="65 inch"
                                    class="form-control @error('height') is-invalid @enderror" name="height"
                                    value="{{ old('height')}}" required>

                                @error('height')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Weight --}}
                        <div class="form-group row">
                            <label for="weight"
                                class="col-md-4 col-from-label text-md-right">{{ __('Weight (in kg.):')}}</label>

                            <div class="col-md-6">
                                <input id="weight" type="number" step="0.01" min="15" max="500" placeholder="55 kg"
                                    class="form-control @error('weight') is-invalid @enderror" name="weight"
                                    value="{{ old('weight')}}" required>

                                @error('weight')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Country --}}
                        {{-- <div class="form-group row">
                            <label for="country_id"
                                class="col-md-4 col-from-label text-md-right">{{ __('Country:')}}</label>

                            <div class="col-md-6">

                                <select id="country_id" type="number"
                                    class="form-control @error('country_id') is-invalid @enderror" name="country_id"
                                    value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Country --
                                    </option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('country_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country_id')}}
                                </div>
                                @endif
                            </div>
                        </div> --}}

                        {{-- City --}}
                        {{-- <div class="form-group row">
                            <label for="city_id" class="col-md-4 col-from-label text-md-right">{{ __('City:')}}</label>

                            <div class="col-md-6">

                                <select id="city_id" type="city_id"
                                    class="form-control @error('city_id') is-invalid @enderror" name="city_id"
                                    value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select City --</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city_id')}}
                                </div>
                                @endif
                            </div>
                        </div> --}}

                        {{-- Climate --}}
                        <div class="form-group row">
                            <label for="climate_id"
                                class="col-md-4 col-from-label text-md-right">{{ __('Climate:')}}</label>

                            <div class="col-md-6">

                                <select id="climate_id" type="number"
                                    class="form-control @error('climate_id') is-invalid @enderror" name="climate_id"
                                    value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Climate --
                                    </option>
                                    @foreach($climates as $climate)
                                    <option value="{{$climate->id}}">{{$climate->name}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('climate_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('climate_id')}}
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Season --}}
                        <div class="form-group row">
                            <label for="season_id"
                                class="col-md-4 col-from-label text-md-right">{{ __('Season:')}}</label>

                            <div class="col-md-6">

                                <select id="season_id" type="number"
                                    class="form-control @error('season_id') is-invalid @enderror" name="season_id"
                                    value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Season --
                                    </option>
                                    @foreach($seasons as $season)
                                    <option value="{{$season->id}}">{{$season->name}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('season_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('season_id')}}
                                </div>
                                @endif

                            </div>
                        </div>

                        {{-- Currency --}}
                        <div class="form-group row">
                            <label for="currency"
                                class="col-md-4 col-from-label text-md-right">{{ __('Preferred Currency:')}}</label>

                            <div class="col-md-6">

                                <select id="currency" type="currency"
                                    class="form-control @error('currency') is-invalid @enderror" name="currency"
                                    value="{{ old('currency')}}" required>
                                    <option selected="selected" disabled="disabled" value="" selected>-- Select Currency
                                        --</option>
                                    @foreach($currencies as $currency)
                                    <option value="{{$currency}}">{{$currency}}</option>
                                    @endforeach
                                </select>

                                @error('currency')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="form-group row">
                            <label for="details"
                                class="col-md-4 col-from-label text-md-right">{{ __('Details:')}}</label>

                            <div class="col-md-6">
                                <input id="details" type="textarea" placeholder="Unique identifier for the person"
                                    class="form-control @error('details') is-invalid @enderror" name="details"
                                    value="{{ old('details')}}" required>

                                @error('details')
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