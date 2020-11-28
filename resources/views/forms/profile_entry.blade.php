@extends('layouts.app')

<title>{{('Add Details | The AI Powered Fragrance Genie')}}</title>

@section('content')

{{-- Range Slider Function --}}
<link href="{{ asset('css/range_slider_sweat.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider_sweat.js') }}" defer></script>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/solid.min.css">

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ url('profile')}}">
                    @csrf

                    <div class="card">
                        <div class="card-header">{{ __('User Details')}}&nbsp;&nbsp; <i class="fas fa-info" data-toggle="tooltip"
                            data-placement="top" data-html="true"
                            title="This information is used in your personal insights.<br>We will never sell your data.
                            <br>For more information, read Privacy Policy."></i></div>

                        <div class="card-body">

                                @hasrole('user|admin')
                                {{-- Name --}}
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Name:')}}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" maxlength="40" placeholder="John" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required>

                                        @error('name')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endhasrole

                                {{-- Gender --}}
                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-from-label text-md-right">{{ __('Gender:')}}</label>

                                    <div class="col-md-6">

                                        <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender')}}" required>
                                            <option value="" selected="selected" disabled="disabled">-- Select Gender --</option>
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
                                    <label for="dob" class="col-md-4 col-from-label text-md-right">{{ __('Date of Birth:')}}</label>

                                    <div class="col-md-6">
                                        <input id="dob" type="date" min="1900-01-01" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob')}}" required>

                                        @error('dob')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Profession --}}
                                <div class="form-group row">
                                    <label for="profession_id" class="col-md-4 col-from-label text-md-right">{{ __('Profession:')}}</label>

                                    <div class="col-md-6">

                                        <select id="profession_id" type="number" class="form-control @error('profession_id') is-invalid @enderror" name="profession_id" value="{{ old('profession_id')}}" required>
                                            <option value="" selected="selected" disabled="disabled">-- Select Profession --</option>
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
                                    <label for="skin_type_id" class="col-md-4 col-from-label text-md-right">{{ __('Skin Type:')}}</label>

                                    <div class="col-md-6">

                                        <select id="skin_type_id" type="number" class="form-control @error('skin_type_id') is-invalid @enderror" name="skin_type_id" value="{{ old('skin_type_id')}}" required>
                                            <option value="" selected="selected" disabled="disabled">-- Select Skin Type --</option>
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
                                    <label for="sweat" class="col-md-4 col-from-label text-md-right">{{ __('How much do you sweat:')}}</label>

                                    <div class="col-md-6">

                                        <div class="slideContainer">
                                            <input type="range" min="0" max="100" class="slider myRange" class="form-control @error('sweat') is-invalid @enderror" id="myRange" name="sweat" value="0" value="{{ old('sweat')}}" required>
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
                                    <label for="height" id ="height" name="height" class="col-md-4 col-from-label text-md-right">{{ __('Height:')}} </label>
                                    <div class="col-md-6">
                                        Enter height either in ft. & inches or cms.
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="height in feet and inches" class="col-md-4 col-from-label text-md-right">{{ __('Feet & Inches:')}}</label>

                                    <div class="col-md-6">
                                        <div style="display:flex; flex-direction:row;">
                                            <input id="height_feet" type="number" step="1" min="1" max="9" placeholder="5 feet" class="form-control @error('height_feet') is-invalid @enderror" name="height_feet" value="{{ old('height_feet')}}">
                                            <input id="height_inches" type="number" step="0.1" min="0" max="12" placeholder="7 inch" class="form-control @error('height_inches') is-invalid @enderror" name="height_inches" value="{{ old('height_inches')}}">
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
                                    <label for="height in centimeters" class="col-md-4 col-from-label text-md-right">{{ __('Centimeters:')}}</label>

                                    <div class="col-md-6">
                                        <input id="height_cent" type="number" step="1" min="20" max="300" placeholder="150 centimeters" class="form-control @error('height_cent') is-invalid @enderror" name="height_cent" value="{{ old('height_cent')}}">
                                        
                                        @error('height_cent')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Weight --}}
                                <div class="form-group row">
                                    <label for="weight" id ="weight" name="weight" class="col-md-4 col-from-label text-md-right">{{ __('Weight:')}}</label>

                                    <div class="col-md-6">
                                        Enter weight either in kgs or lbs:
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="weight in kgs" class="col-md-4 col-from-label text-md-right">{{ __('Kgs:')}}</label>

                                    <div class="col-md-6">
                                        <input id="kgs" type="number" step="0.01" min="15" max="500" placeholder="55 kg" class="form-control @error('kgs') is-invalid @enderror" name="kgs" value="{{ old('kgs')}}">

                                        @error('kgs')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="weight in lbs" class="col-md-4 col-from-label text-md-right">{{ __('Pounds:')}}</label>

                                    <div class="col-md-6">
                                        <input id="lbs" type="number" step="0.1" min="20" max="1000" placeholder="70 lbs" class="form-control @error('lbs') is-invalid @enderror" name="lbs" value="{{ old('lbs')}}">

                                        @error('lbs')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Climate --}}
                                <div class="form-group row">
                                    <label for="climate_id" class="col-md-4 col-from-label text-md-right">{{ __('Climate:')}}</label>

                                    <div class="col-md-6">

                                        <select id="climate_id" type="number" class="form-control @error('climate_id') is-invalid @enderror" name="climate_id" value="{{ old('climate_id')}}" required>
                                            <option value="" selected="selected" disabled="disabled">-- Select Climate --</option>
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
                                    <label for="season_id" class="col-md-4 col-from-label text-md-right">{{ __('Season:')}}</label>

                                    <div class="col-md-6">

                                        <select id="season_id" type="number" class="form-control @error('season_id') is-invalid @enderror" name="season_id" value="{{ old('season_id')}}" required>
                                            <option value="" selected="selected" disabled="disabled">-- Select Season --</option>
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

                                @hasrole('new_user')
                                {{-- Currency --}}
                                <div class="form-group row">
                                    <label for="currency" class="col-md-4 col-from-label text-md-right">{{ __('Preferred Currency:')}}</label>

                                    <div class="col-md-6">

                                        <select id="currency" type="currency" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency')}}" required>
                                            <option selected="selected" disabled="disabled" value="" selected>-- Select Currency --</option>
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
                                @endhasrole

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
    
    {{-- TODO: #1 Hide the fields, Let the user select their input method, and show the selected one. --}}
    {{-- <script>
        $(function () {
            $('div[name="showthis"]').hide();
    
            //show it when the checkbox is clicked
            $('input[name="checkbox"]').on('click', function () {
                if ($(this).prop('checked')) {
                    $('div[name="showthis"]').fadeIn();
                } else {
                    $('div[name="showthis"]').fadeOut();
                }
            });
        });
    </script> --}}
@endsection