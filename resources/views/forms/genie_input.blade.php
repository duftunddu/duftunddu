@extends('layouts.app')

<link href="{{ asset('css/range_slider.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider.js') }}" defer></script>

@section('content')

{{-- Range Slider Function --}}
<link href="{{ asset('css/range_slider_sweat.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider_sweat.js') }}" defer></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ url('genie_input')}}">
                    @csrf

                {{-- Perceiver Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Perceiver Entry Hope')}}</div>

                    <div class="card-body">
                        

                            {{-- Gender --}}
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-from-label text-md-right">{{ __('Gender:')}}</label>

                                <div class="col-md-6">

                                    <select id="gender" type="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Gender --</option>
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

                            {{-- Profession --}}
                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-from-label text-md-right">{{ __('Profession:')}}</label>

                                <div class="col-md-6">

                                    <select id="profession" type="profession" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ old('profession')}}" required autocomplete="Eau de Toilette">

                                        <option value="" selected="selected" disabled="disabled">-- Select Profession --</option>
                                        <optgroup label="Healthcare Practitioners and Technical Occupations:">
                                            <option value="1">-  Chiropractor</option>
                                            <option value="2">-  Dentist</option>
                                            <option value="3">-  Dietitian or Nutritionist</option>
                                            <option value="4">-  Optometrist</option>
                                            <option value="5">-  Pharmacist</option>
                                            <option value="6">-  Physician</option>
                                            <option value="7">-  Physician Assistant</option>
                                            <option value="8">-  Podiatrist</option>
                                            <option value="9">-  Registered Nurse</option>
                                            <option value="10">-  Therapist</option>
                                            <option value="11">-  Veterinarian</option>
                                            <option value="12">-  Health Technologist or Technician</option>
                                            <option value="13">-  Other Healthcare Practitioners and Technical Occupation</option>
                                        </optgroup>
                                        <optgroup label="Healthcare Support Occupations:">
                                            <option value="14">-  Nursing, Psychiatric, or Home Health Aide</option>
                                            <option value="15">-  Occupational and Physical Therapist Assistant or Aide</option>
                                            <option value="16">-  Other Healthcare Support Occupation</option>
                                        </optgroup>
                                        <optgroup label="Business, Executive, Management, and Financial Occupations:">
                                            <option value="17">-  Chief Executive</option>
                                            <option value="18">-  General and Operations Manager</option>
                                            <option value="19">-  Advertising, Marketing, Promotions, Public Relations, and Sales Manager</option>
                                            <option value="20">-  Operations Specialties Manager (e.g., IT or HR Manager)</option>
                                            <option value="21">-  Construction Manager</option>
                                            <option value="22">-  Engineering Manager</option>
                                            <option value="23">-  Accountant, Auditor</option>
                                            <option value="24">-  Business Operations or Financial Specialist</option>
                                            <option value="25">-  Business Owner</option>
                                            <option value="26">-  Other Business, Executive, Management, Financial Occupation</option>
                                        </optgroup>
                                        <optgroup label="Architecture and Engineering Occupations:">
                                            <option value="27">-  Architect, Surveyor, or Cartographer</option>
                                            <option value="28">-  Engineer</option>
                                            <option value="29">-  Other Architecture and Engineering Occupation</option>
                                        </optgroup>
                                        <optgroup label="Education, Training, and Library Occupations:">
                                            <option value="30">-  Postsecondary Teacher (e.g., College Professor)</option>
                                            <option value="31">-  Primary, Secondary, or Special Education School Teacher</option>
                                            <option value="32">-  Other Teacher or Instructor</option>
                                            <option value="33">-  Other Education, Training, and Library Occupation</option>
                                        </optgroup>
                                        <optgroup label="Other Professional Occupations:">
                                            <option value="34">-  Arts, Design, Entertainment, Sports, and Media Occupations</option>
                                            <option value="35">-  Computer Specialist, Mathematical Science</option>
                                            <option value="36">-  Counselor, Social Worker, or Other Community and Social Service Specialist</option>
                                            <option value="37">-  Lawyer, Judge</option>
                                            <option value="38">-  Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)</option>
                                            <option value="39">-  Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)</option>
                                            <option value="40">-  Religious Worker (e.g., Clergy, Director of Religious Activities or Education)</option>
                                            <option value="41">-  Social Scientist and Related Worker</option>
                                            <option value="42">-  Other Professional Occupation</option>
                                        </optgroup>
                                        <optgroup label="Office and Administrative Support Occupations:">
                                            <option value="43">-  Supervisor of Administrative Support Workers</option>
                                            <option value="44">-  Financial Clerk</option>
                                            <option value="45">-  Secretary or Administrative Assistant</option>
                                            <option value="46">-  Material Recording, Scheduling, and Dispatching Worker</option>
                                            <option value="47">-  Other Office and Administrative Support Occupation</option>
                                        </optgroup>
                                        <optgroup label="Services Occupations:">
                                            <option value="48">-  Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)</option>
                                            <option value="49">-  Chef or Head Cook</option>
                                            <option value="50">-  Cook or Food Preparation Worker</option>
                                            <option value="51">-  Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)</option>
                                            <option value="52">-  Building and Grounds Cleaning and Maintenance</option>
                                            <option value="53">-  Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)</option>
                                            <option value="54">-  Sales Supervisor, Retail Sales</option>
                                            <option value="55">-  Retail Sales Worker</option>
                                            <option value="56">-  Insurance Sales Agent</option>
                                            <option value="57">-  Sales Representative</option>
                                            <option value="58">-  Real Estate Sales Agent</option>
                                            <option value="59">-  Other Services Occupation</option>
                                        </optgroup>
                                        <optgroup label="Agriculture, Maintenance, Repair, and Skilled Crafts Occupations:">
                                            <option value="60">-  Construction and Extraction (e.g., Construction Laborer, Electrician)</option>
                                            <option value="61">-  Farming, Fishing, and Forestry</option>
                                            <option value="62">-  Installation, Maintenance, and Repair</option>
                                            <option value="63">-  Production Occupations</option>
                                            <option value="64">-  Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation</option>
                                        </optgroup>
                                        <optgroup label="Transportation Occupations:">
                                            <option value="65">-  Aircraft Pilot or Flight Engineer</option>
                                            <option value="66">-  Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)</option>
                                            <option value="67">-  Other Transportation Occupation</option>
                                        </optgroup>
                                        <optgroup label="Other Occupations:">
                                            <option value="68">-  Military</option>
                                            <option value="69">-  Homemaker</option>
                                            <option value="70">-  Other Occupation</option>
                                            <option value="71">-  Don't Know</option>
                                            <option value="72">-  Not Applicable</option>
                                        </optgroup>
                                    </select>


                                    @error('type')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Age --}}
                            <div class="form-group row">
                                <label for="age" class="col-md-4 col-from-label text-md-right">{{ __('Age:')}}</label>

                                <div class="col-md-6">
                                    <input id="age" type="age" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age')}}" required>

                                    @error('age')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Skin Type --}}
                            <div class="form-group row">
                                <label for="skin type" class="col-md-4 col-from-label text-md-right">{{ __('Skin Type:')}}</label>

                                <div class="col-md-6">

                                    <select id="skin_type" type="skin_type" class="form-control @error('skin_type') is-invalid @enderror" name="skin_type" value="{{ old('skin_type')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Skin Type --</option>
                                        <option value="1">
                                            {{'Dry'}}
                                        </option>
                                        <option value="2">
                                            {{'Dry & Moisturized'}}
                                        </option>
                                        <option value="3">
                                            {{'Normal'}}
                                        </option>
                                        <option value="4">
                                            {{'Oily'}}
                                        </option>
                                        <option value="5">
                                            {{'Very Oily'}}
                                        </option>
                                    </select>

                                    @error('skin_type')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Sweat --}}
                            <div class="form-group row">
                                <label for="sweat" class="col-md-4 col-from-label text-md-right">{{ __('How much do you sweat:')}}</label>

                                <div class="col-md-6">
                                    
                                    <input type="range" min="0" max="100" value="0" class="slider" id="sweat" name="sweat" required>
                                    <label>{{_('Value: ')}}<span id="value"></span></label>
                                    
                                    {{-- <input id="sweat" type="range" min="-100" max="0" value="0" class="range black" name="sweat" value="{{ old('sweat')}}" /> --}}

                                    @error('sweat')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Height --}}
                            <div class="form-group row">
                                <label for="height" class="col-md-4 col-from-label text-md-right">{{ __('Height (in ft.):')}}</label>

                                <div class="col-md-6">
                                    <input id="height" type="height" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height')}}" required>

                                    @error('height')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Body Shape --}}
                            <div class="form-group row">
                                <label for="body shape" class="col-md-4 col-from-label text-md-right">{{ __('Body Shape:')}}</label>

                                <div class="col-md-6">

                                    <select id="body_shape" type="body_shape" class="form-control @error('body_shape') is-invalid @enderror" name="body_shape" value="{{ old('body_shape')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Body Shape --</option>
                                        <option value="1">
                                            {{'[Picture]'}}
                                        </option>
                                        <option value="2">
                                            {{'[Picture]'}}
                                        </option>
                                        <option value="3">
                                            {{'[Picture]'}}
                                        </option>
                                        <option value="4">
                                            {{'[Picture]'}}
                                        </option>
                                        <option value="5">
                                            {{'[Picture]'}}
                                        </option>
                                    </select>

                                    @error('body_shape')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Weight --}}

                            {{-- Country --}}
                            {{-- City --}}

                            {{-- Climate --}}
                            <div class="form-group row">
                                <label for="climate" class="col-md-4 col-from-label text-md-right">{{ __('Climate:')}}</label>

                                <div class="col-md-6">

                                    <select id="climate" type="climate" class="form-control @error('climate') is-invalid @enderror" name="climate" value="{{ old('climate')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Climate --</option>
                                        <option value="1">
                                            {{'Tropical (Hot & Humid)'}}
                                        </option>
                                        <option value="2">
                                            {{'Dry'}}
                                        </option>
                                        <option value="3">
                                            {{'Temperate (Warm & Mild Winter)'}}
                                        </option>
                                        <option value="4">
                                            {{'Continental (Usually Cold)'}}
                                        </option>
                                        <option value="5">
                                            {{'Polar (Always Cold)'}}
                                        </option>
                                    </select>

                                    @error('climate')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Season --}}
                            <div class="form-group row">
                                <label for="season" class="col-md-4 col-from-label text-md-right">{{ __('Season:')}}</label>

                                <div class="col-md-6">

                                    <select id="season" type="season" class="form-control @error('season') is-invalid @enderror" name="season" value="{{ old('season')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Season --</option>
                                        <option value="1">
                                            {{'Summer'}}
                                        </option>
                                        <option value="2">
                                            {{'Winter'}}
                                        </option>
                                        <option value="3">
                                            {{'Spring'}}
                                        </option>
                                        <option value="4">
                                            {{'Autumn'}}
                                        </option>
                                    </select>

                                    @error('season')
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

                {{-- Fragrance Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Entry')}}</div>

                    <div class="card-body">

                            {{-- Brand --}}
                            <div class="form-group row">
                                <label for="brand" class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>

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
                                <label for="fragrance_id" class="col-md-4 col-from-label text-md-right">{{ __('Fragrance Name:')}}</label>

                                <div class="col-md-6">

                                    <select id="fragrance_id" type="fragrance_id" class="form-control @error('fragrance_id') is-invalid @enderror" name="fragrance_id" value="{{ old('')}}" required>
                                        @foreach($fragrances as $fragrance)
                                            <option value="{{$fragrance->id}}">{{$fragrance->name}}</option>
                                        @endforeach

                                    </select>

                                    @error('fragrance_id')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Like --}}
                            <div class="form-group row">
                                <label for="like" class="col-md-4 col-from-label text-md-right">{{ __('How much do you like it:')}}</label>

                                <div class="col-md-6">

                                    <select id="like" type="like" class="form-control @error('like') is-invalid @enderror" name="like" value="{{ old('')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Like --</option>
                                        <option value="1">
                                            {{'1'}}
                                        </option>
                                        <option value="2">
                                            {{'2'}}
                                        </option>
                                        <option value="3">
                                            {{'3'}}
                                        </option>
                                        <option value="4">
                                            {{'4'}}
                                        </option>
                                        <option value="5">
                                            {{'5'}}
                                        </option>
                                        <option value="6">
                                            {{'6'}}
                                        </option>
                                        <option value="7">
                                            {{'7'}}
                                        </option>
                                        <option value="8">
                                            {{'8'}}
                                        </option>
                                        <option value="9">
                                            {{'9'}}
                                        </option>
                                        <option value="10">
                                            {{'10'}}
                                        </option>

                                    </select>

                                    @error('like')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Comment --}}
                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-from-label text-md-right">{{ __('Comment:')}}</label>

                                <div class="col-md-6">
                                    <input id="comment" type="textarea" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ ('')}}" required>

                                    @error('comment')
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
                                <label for="accord" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

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
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Add Another Accord') }}
                                    </button>
                                </div>
                            </div>

                    </div>
                </div>

                <br>

                {{-- Ingredient Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Notes Entry')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('fragrance_entry')}}">
                            @csrf

                            {{-- Ingredient --}}
                            <div class="form-group row">
                                <label for="ingredient_id" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label>

                                <div class="col-md-6">

                                    <select id="ingredient_id" type="ingredient_id" class="form-control @error('ingredient_id') is-invalid @enderror" name="ingredient_id" value="{{ old('')}}" required>
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

                                    <select id="note_id" type="note_id" class="form-control @error('note_id') is-invalid @enderror" name="note_id" value="{{ old('')}}" required>
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

                                    @error('note_id')
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

                                    <select id="strength_id" type="strength_id" class="form-control @error('strength_id') is-invalid @enderror" name="strength_id" value="{{ old('')}}" required autocomplete="6">
                                        <option value="" selected="selected" disabled="disabled">-- Select Strength --</option>
                                        <option value="1">
                                            {{'1'}}
                                        </option>
                                        <option value="2">
                                            {{'2'}}
                                        </option>
                                        <option value="3">
                                            {{'3'}}
                                        </option>
                                        <option value="4">
                                            {{'4'}}
                                        </option>
                                        <option value="5">
                                            {{'5'}}
                                        </option>
                                        <option value="6">
                                            {{'6'}}
                                        </option>
                                        <option value="7">
                                            {{'7'}}
                                        </option>
                                        <option value="8">
                                            {{'8'}}
                                        </option>
                                        <option value="9">
                                            {{'9'}}
                                        </option>
                                        <option value="10">
                                            {{'10'}}
                                        </option>

                                    </select>

                                    @error('strength_id')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Button: Add Another Ingredient --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Add Another Ingredient') }}
                                    </button>
                                </div>
                            </div>

                    </div>
                </div>

                <br>

                {{-- Button: Submit --}}
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-10">
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
