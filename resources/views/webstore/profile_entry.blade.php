@extends('layouts.app_webstore')

<title>{{('Add Details | The AI Powered Fragrance Genie')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Range Slider Function --}}
    <link href="{{ asset('css/range_slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/range_slider_sweat.css') }}" rel="stylesheet">

    {{-- Button: Submit --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

    {{-- Button: Info --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" defer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/solid.min.css" defer>
</head>

@section('content')

<script src="{{ asset('js/range_slider_sweat.js') }}" defer></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="GET" action="{{ url('/webstore_profile/some')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Profile Details')}}&nbsp;&nbsp; <i class="fas fa-info"
                            data-toggle="tooltip" data-placement="top" data-html="true" title="This information is used for personal review."></i></div>

                    <div class="card-body">

                        {{-- Gender --}}
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-from-label text-md-right required">{{ __('Gender:')}}</label>

                            <div class="col-md-6">

                                <input list="genders" id="gender" type="text" placeholder="-- Select Gender --"
                                    class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    value="{{ old('gender')}}" autocomplete="off" required />
                                <datalist id="genders">
                                    <option value="Male"></option>
                                    <option value="Female"></option>
                                    <option value="Other"></option>
                                </datalist>

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
                                class="col-md-4 col-from-label text-md-right required">{{ __('Date of Birth:')}}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" min="1900-01-01"
                                    class="form-control @error('dob') is-invalid @enderror" name="dob"
                                    value="{{ old('dob')}}" autocomplete="off" required>

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
                                class="col-md-4 col-from-label text-md-right required">{{ __('Profession:')}}</label>

                            <div class="col-md-6">
                                <input list="professions" id="profession" type="text"
                                    placeholder="-- Select Profession --"
                                    class="form-control @error('profession') is-invalid @enderror" name="profession"
                                    value="{{ old('profession')}}" autocomplete="off" required />
                                <datalist id="professions">
                                    @foreach($professions as $profession)
                                    <option value="{{$profession->name}}"></option>
                                    @endforeach
                                </datalist>

                                @error('profession')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Skin Type --}}
                        <div class="form-group row">
                            <label for="skin_type_id"
                                class="col-md-4 col-from-label text-md-right required">{{ __('Skin Type:')}}</label>

                            <div class="col-md-6">
                                <input list="skin_types" id="skin_type" type="text" placeholder="-- Select Skin Type --"
                                    class="form-control @error('skin_type') is-invalid @enderror" name="skin_type"
                                    value="{{ old('skin_type')}}" autocomplete="off" required />
                                <datalist id="skin_types">
                                    @foreach($skin_types as $skin_type)
                                    <option value="{{$skin_type->name}}"></option>
                                    @endforeach
                                </datalist>

                                @error('skin_type')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Sweat --}}
                        <div class="form-group row">
                            <label for="sweat"
                                class="col-md-4 col-from-label text-md-right required">{{ __('How much do you sweat:')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer-sweat">
                                    <input type="range" min="0" max="100" class="slider sweat"
                                        class="form-control @error('sweat') is-invalid @enderror" id="sweat"
                                        name="sweat" value="0" value="{{ old('sweat')}}" autocomplete="off" required>
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
                            <label for="height" id="height" name="height"
                                class="col-md-4 col-from-label text-md-right">{{ __('Height:')}} </label>
                            <div class="col-md-6">
                                Enter height either in ft. & inches or cms.
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="height in feet and inches"
                                class="col-md-4 col-from-label text-md-right">{{ __('Feet & Inches:')}}</label>

                            <div class="col-md-6">
                                <div style="display:flex; flex-direction:row;">
                                    <input id="height_feet" type="number" step="1" min="1" max="9" placeholder="5 feet"
                                        class="form-control @error('height_feet') is-invalid @enderror"
                                        name="height_feet" value="{{ old('height_feet')}}" autocomplete="off" >
                                    <input id="height_inches" type="number" step="0.1" min="0" max="12"
                                        placeholder="7 inch"
                                        class="form-control @error('height_inches') is-invalid @enderror"
                                        name="height_inches" value="{{ old('height_inches')}}" autocomplete="off" >
                                </div>

                                @error('height_feet')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('height_inches')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="height in centimeters"
                                class="col-md-4 col-from-label text-md-right">{{ __('Centimeters:')}}</label>

                            <div class="col-md-6">
                                <input id="height_cent" type="number" step="1" min="20" max="300"
                                    placeholder="150 centimeters"
                                    class="form-control @error('height_cent') is-invalid @enderror" name="height_cent"
                                    value="{{ old('height_cent')}}" autocomplete="off" >

                                @error('height_cent')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Weight --}}
                        <div class="form-group row">
                            <label for="weight" id="weight" name="weight"
                                class="col-md-4 col-from-label text-md-right">{{ __('Weight:')}}</label>

                            <div class="col-md-6">
                                Enter weight either in kgs or lbs:
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weight in kgs"
                                class="col-md-4 col-from-label text-md-right">{{ __('Kgs:')}}</label>

                            <div class="col-md-6">
                                <input id="kgs" type="number" step="0.01" min="15" max="500" placeholder="55 kg"
                                    class="form-control @error('kgs') is-invalid @enderror" name="kgs"
                                    value="{{ old('kgs')}}" autocomplete="off" >

                                @error('kgs')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weight in lbs"
                                class="col-md-4 col-from-label text-md-right">{{ __('Pounds:')}}</label>

                            <div class="col-md-6">
                                <input id="lbs" type="number" step="0.1" min="20" max="1000" placeholder="70 lbs"
                                    class="form-control @error('lbs') is-invalid @enderror" name="lbs"
                                    value="{{ old('lbs')}}" autocomplete="off" >

                                @error('lbs')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Climate --}}
                        <div class="form-group row">
                            <label for="climate_id"
                                class="col-md-4 col-from-label text-md-right required">{{ __('Climate:')}}</label>

                            <div class="col-md-6">

                                <input list="climates" id="climate" type="text" placeholder="-- Select Climate --"
                                    class="form-control @error('climate') is-invalid @enderror" name="climate"
                                    value="{{ old('climate')}}" autocomplete="off" required />
                                <datalist id="climates">
                                    @foreach($climates as $climate)
                                    <option value="{{$climate->name}}"></option>
                                    @endforeach
                                </datalist>

                                @error('climate')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Season --}}
                        <div class="form-group row">
                            <label for="season_id"
                                class="col-md-4 col-from-label text-md-right required">{{ __('Season:')}}</label>

                            <div class="col-md-6">

                                <input list="seasons" id="season" type="text" placeholder="-- Select Season --"
                                    class="form-control @error('season') is-invalid @enderror" name="season"
                                    value="{{ old('season')}}" autocomplete="off" required />
                                <datalist id="seasons">
                                    @foreach($seasons as $season)
                                    <option value="{{$season->name}}"></option>
                                    @endforeach
                                </datalist>

                                @error('season')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Store ID --}}
                        <input type="hidden" id="store_id" name="store_id" value={{ $store_id }}>

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