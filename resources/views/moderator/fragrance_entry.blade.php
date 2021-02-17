@extends('layouts.app')

<title>{{('Fragrance Entry | Moderator | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Scripts --}}
    <link href="{{ asset('css/fragrance_entry_moderator.css') }}" rel="stylesheet" defer>

    {{-- Button: Info --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" defer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/solid.min.css" defer>
</head>

@section('content')

{{-- Range Slider Function --}}
<script src="{{ asset('js/range_slider_projection.js') }}" defer></script>
<script src="{{ asset('js/range_slider_sillage.js') }}" defer></script>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('/add_fragrance_mod')}}">
                @csrf

                {{-- Fragrance Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Entry | Moderator')}} &thinsp;
                        <i class="fas fa-info" data-toggle="tooltip"
                        data-placement="right" data-html="true"
                        title="Tap the fields below to reveal best practices and insights.  
                        <br>Entering incorrect data will mislead your audience.
                        <br>For more info, read FAQ."></i>
                    </div>

                    <div class="card-body">

                        {{-- Instructions --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 de-gray">
                                If Brand doesn't exist, add <a href="{{ url('/add_brand_mod/brand_name') }}">brand</a> first.
                            </div>
                        </div>
                        <br>

                        {{-- Brand Name --}}
                        <div class="form-group row">
                            <label for="brand_id" class="col-md-4 col-from-label text-md-right required">{{ __('Brand Name:')}}</label>

                            <div class="col-md-6">
                                <select id="brand_id" type="number" class="form-control @error('brand_id') is-invalid @enderror" name="brand_id" value="{{ old('brand_id')}}" required>
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

                        {{-- Fragrance Name --}}
                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="Name of your fragrance."> {{ __('Fragrance Name:')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Mon Paris"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $fragrance_name }}" required>

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{" This Fragrance already exists"}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Type --}}
                        <div class="form-group row">
                            {{-- Tooltip & Label --}}
                            <label for="type_id"
                            class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                            data-placement="top" data-html="true"
                            title="Contributes to Longevity."> {{ __('Type:')}} </label>

                            <div class="col-md-6">

                                <select id="type_id" type="number"
                                    class="form-control @error('type_id') is-invalid @enderror" name="type_id"
                                    value="{{ old('')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Tier --</option>
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

                        {{-- Gender --}}
                        <div class="form-group row">
                            <label for="gender"
                                class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="Gender suitability.">{{ __('This Fragrance Suits:')}}</label>

                            <div class="col-md-6">

                                <select id="gender" type="text"
                                    class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    value="{{ old('gender')}}" required>
                                    <option value="" selected>-- Select Gender --</option>
                                    <option value="Male">
                                        {{'Male'}}
                                    </option>
                                    <option value="Female">
                                        {{'Female'}}
                                    </option>
                                    <option value="Unisex">
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

                        {{-- Projection --}}
                        <div class="form-group row">
                            <label for="projection" class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="How far-off can you smell the scent?<br>In Inches.">{{ __('Projection (inches):')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer-projection">
                                    <input type="range" min="0" max="100" step="0.5" class="slider projection"
                                        class="form-control @error('projection') is-invalid @enderror" id="projection"
                                        name="projection" value="0" value="{{ old('projection')}}" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                </div>

                                @error('projection')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Sillage --}}
                        <div class="form-group row">
                            <label for="sillage" class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                            data-placement="top" data-html="true"
                            title="Contributes to Indoor/Outdoor.">{{ __('Sillage:')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer-sillage">
                                    <input type="range" min="0" max="100" class="slider sillage" class="form-control @error('sillage') is-invalid @enderror" id="sillage" name="sillage" value="0" value="{{ old('sillage')}}" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                  </div>
                                
                                @error('sillage')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            
                            </div>
                        </div>

                        {{-- Cost --}}
                        <div class="form-group row">
                            <label for="cost" 
                            class="col-md-4 col-from-label text-md-right" data-toggle="tooltip"
                            data-placement="top" data-html="true"
                            title="Cost of Fragrance.">{{ __('Cost:')}}</label>

                            <div class="col-md-6">
                                <input id="cost" type="number" placeholder="1000" min="1" max="4294967295"
                                    class="form-control @error('cost') is-invalid @enderror" name="cost"
                                    value="{{ ('cost')}}">

                                @error('cost')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Currency --}}
                        <div class="form-group row">
                            <label for="currency"
                                class="col-md-4 col-from-label text-md-right"data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="Select your preferred currency.
                                <br>Don't worry, we'll show the audience the cost in
                                thier preferred currency.">{{ __('Currency:')}}</label>

                            <div class="col-md-6">

                                <select id="currency" type="currency"
                                    class="form-control @error('currency') is-invalid @enderror" name="currency"
                                    value="{{ old('currency')}}">
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

                    </div>
                </div>

                <br>

                {{-- Accord Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>

                    <div class="card-body">

                        <div id="dynamic_field_a">

                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="accord_id"
                                    class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                    data-placement="top" data-html="true"
                                    title="Contributes to Suitability.">{{ __('Accord:')}}</label>

                                <div class="col-md-6">

                                    <select id="accord_id" type="number"
                                        class="form-control @error('accord_id') is-invalid @enderror" name="accord_id"
                                        value="{{ old('accord_id')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Accord --
                                        </option>

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

                        </div>

                        {{-- Button: + / Add Another --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" name="add_a" id="add_a" class="btn btn-success">
                                    {{ _('+')}}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <br>

                {{-- Ingredient Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Note Entry')}}</div>

                    <div class="card-body">

                        <div id="dynamic_field_i">

                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="ingredient_id"
                                    class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                    data-placement="top" data-html="true"
                                    title="Contributes to Suitability.">{{ __('Ingredient:')}}</label>

                                <div class="col-md-6">

                                    <select id="ingredient_id" type="number"
                                        class="form-control @error('ingredient_id') is-invalid @enderror"
                                        name="ingredient_id" value="{{ old('ingredient_id')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Ingredient --
                                        </option>
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
                                <label for="note" 
                                class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="Contributes to Genie.
                                <br>Function under development.">{{ __('Note:')}}</label>

                                <div class="col-md-6">

                                    <select id="note" type="text"
                                        class="form-control @error('note') is-invalid @enderror" name="note"
                                        value="{{ old('note')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Note --
                                        </option>
                                        <option value="Top">
                                            {{'Top'}}
                                        </option>
                                        <option value="Middle">
                                            {{'Middle'}}
                                        </option>
                                        <option value="Base">
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

                            {{-- Intensity --}}
                            <div class="form-group row">
                                <label for="intensity"
                                    class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                    data-placement="top" data-html="true"
                                    title="Contributes to Sillage.">{{ __('Intensity:')}}</label>

                                <div class="col-md-6">

                                    <select id="intensity" type="number"
                                        class="form-control @error('intensity') is-invalid @enderror" name="intensity"
                                        value="{{ old('intensity')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Intensity --
                                        </option>
                                        <option value="1">{{'1'}}</option>
                                        <option value="2">{{'2'}}</option>
                                        <option value="3">{{'3'}}</option>
                                        <option value="4">{{'4'}}</option>
                                        <option value="5">{{'5'}}</option>
                                        <option value="6">{{'6'}}</option>
                                        <option value="7">{{'7'}}</option>
                                        <option value="8">{{'8'}}</option>
                                        <option value="9">{{'9'}}</option>
                                        <option value="10">{{'10'}}</option>
                                    </select>

                                    @error('intensity')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>

                        {{-- Button: + / Add Another --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" name="add_i" id="add_i" class="btn btn-success">
                                    {{ _('+')}}
                                </button>
                            </div>
                        </div>

                        <br>
                        <br>

                    </div>
                </div>

                <br>

                {{-- Button: Submit --}}
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-9">
                        <button type="submit" class="custom">
                            <span class="before">{{_('Submit')}}</span>
                            <span class="after">{{_('Submit')}}</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Accord Script --}}
<script>
    $(document).ready(function () {
        var a = 1;
        $('#add_a').click(function () {
            a++;
            $('#dynamic_field_a').append('<div id="row' + a +'"><div class="form-group row"><label for="accord_ids" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label><div class="col-md-6"><select id="accord_ids" type="number" class="form-control @error('accord_ids ') is-invalid @enderror"name="accord_ids[]" required><option value="" selected="selected" disabled="disabled">-- Select Accord --</option>@foreach($accords as $accord)<option value="{{$accord->id}}">{{$accord->name}}</option>@endforeach</select>@error('accord_ids ')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div><div class="col-md-2 button-right-align"><button type="button" name="remove_a" id="' +a + '" class="btn btn-danger btn_remove_a">X</button></div></div>');
        });

        $(document).on('click', '.btn_remove_a', function () {
            var button_id = $(this).attr("id");

            $('#row' + button_id + '').remove();
        });

        $('#submit').click(function () {
            $.ajax({
                url: "name.php",
                method: "POST",
                data: $('#accord_ids').serialize(),
                success: function (data) {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });

    });
</script>

{{-- Ingredient Script --}}
<script>
    $(document).ready(function () {
        var i = 1;
        var j = 1;
        var k = 1;
        $('#add_i').click(function () {
            i++;
            j++;
            k++;
            // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

            $('#dynamic_field_i').append('<div id="row' + i +'"><br><div class="form-group row"><label for="ingredient_ids" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label><div class="col-md-6"><select id="ingredient_ids" type="number" class="form-control @error('ingredient_ids ') is-invalid @enderror" name="ingredient_ids[]" required><option value="" selected="selected" disabled="disabled">-- Select Ingredient --</option>@foreach($ingredients as $ingredient)<option value="{{$ingredient->id}}">{{$ingredient->name}}</option>@endforeach</select>@error('ingredient_ids ')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div>');
            $('#dynamic_field_i').append('<div id="row' + j +'"><div class="form-group row"><label for="notes" class="col-md-4 col-from-label text-md-right">{{ __('Note:')}}</label><div class="col-md-6"><select id="notes" type="number" class="form-control @error('notes ') is-invalid @enderror" name="notes[]" required><option value="" selected="selected" disabled="disabled">-- Select Note --</option><option value="1">{{'Top '}}</option><option value="2">{{'Middle '}}</option><option value="3">{{'Base '}}</option></select>@error('notes ')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div>');
            $('#dynamic_field_i').append('<div id="row' + k +'"><div class="form-group row"><label for="intensities" class="col-md-4 col-from-label text-md-right">{{ __('Intensity:')}}</label><div class="col-md-6"><select id="intensities" type="number" class="form-control @error('intensities ') is-invalid @enderror" name="intensities[]" required><option value="" selected="selected" disabled="disabled">-- Select Intensity --</option><option value="1">{{'1 '}}</option><option value="2">{{'2 '}}</option><option value="3">{{'3 '}}</option><option value="4">{{'4 '}}</option><option value="5">{{'5 '}}</option><option value="6">{{'6 '}}</option><option value="7">{{'7 '}}</option><option value="8">{{'8 '}}</option><option value="9">{{'9 '}}</option><option value="10">{{'10 '}}</option></select>@error('intensities ')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div><div class="col-md-2 button-right-align"><button type="button" name="remove_i" id="' +i + '" id2="' + j + '" id3="' + k +'" class="btn btn-danger btn_remove_i">X</button></div></div>');
        });

        $(document).on('click', '.btn_remove_i', function () {
            var button_id = $(this).attr("id");
            var button_id2 = $(this).attr("id2");
            var button_id3 = $(this).attr("id3");

            $('#row' + button_id + '').remove();
            $('#row' + button_id2 + '').remove();
            $('#row' + button_id3 + '').remove();
        });

        $('#submit').click(function () {
            $.ajax({
                url: "name.php",
                method: "POST",
                data: $('#ingredient_ids').serialize(),
                data: $('#notes').serialize(),
                data: $('#intensities').serialize(),
                success: function (data) {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });

    });
</script>

@endsection