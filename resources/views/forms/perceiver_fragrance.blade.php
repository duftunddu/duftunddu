@extends('layouts.app')

<title>{{('Genie | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

@section('content')

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

{{-- Add Another Function --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

{{-- Range Slider Function --}}
<link href="{{ asset('css/range_slider.css') }}" rel="stylesheet">
<link href="{{ asset('css/range_slider_like.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider_like.js') }}" defer></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ url('genie_input/'.$profile_id)}}">
                    @csrf

                <br>

                {{-- Fragrance Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Entry')}}</div>

                    <div class="card-body">

                            {{-- Brand --}}
                            {{-- <div class="form-group row">
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
                            </div> --}}

                            {{-- Fragrance --}}
                            <div class="form-group row">
                                <label for="fragrance_id" class="col-md-4 col-from-label text-md-right">{{ __('Fragrance Name:')}}</label>

                                <div class="col-md-6">

                                    <select id="fragrance_id" type="fragrance_id" class="form-control @error('fragrance_id') is-invalid @enderror" name="fragrance_id" value="{{ old('')}}" required>
                                        <option value ="" selected="selected" disabled="disabled">-- Select Fragrance --</option>
                                        @foreach($fragrances as $fragrance)
                                            <option value="{{$fragrance->f_id}}">{{$fragrance->f_name}} by {{$fragrance->b_name}}</option>
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

                                    <div class="slideContainer-like">
                                            <input type="range" min="0" max="100" class="slider like" class="form-control @error('like') is-invalid @enderror" id="like" name="like" value="0" value="{{ old('like')}}" required>
                                        <label>{{_('Value: ')}}<span class="value"></span></label>
                                      </div>
                                    
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

                    </div>
                </div>

                <br>

                {{-- Accord Table --}}
                <div class="card">
                    <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>
        
                    <div class="card-body">
                        What do you think are the accords?
                        
                        <br><br>
                        
                        <div id="dynamic_field_a">
        
                            {{-- Name --}}
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
                        What do you think are the notes?
                        
                        <br><br>
                        
                        <div id="dynamic_field_i">
        
                            {{-- Name --}}
                            <div class="form-group row">  
                                <label for="ingredient_id" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label>
                                
                                <div class="col-md-6">
                                            
                                    <select id="ingredient_id" type="number" class="form-control @error('ingredient_id') is-invalid @enderror" name="ingredient_id" value="{{ old('')}}" required>
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
            
                                    <select id="note" type="number" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('')}}" required>
                                        <option value="" selected="selected" disabled="disabled">-- Select Note --</option>
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
                                <label for="intensity" class="col-md-4 col-from-label text-md-right">{{ __('Intensity:')}}</label>
                                
                                <div class="col-md-6">
                                    
                                <select id="intensity" type="number" class="form-control @error('intensity') is-invalid @enderror" name="intensity" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Intensity --</option>
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
        $(document).ready(function(){
        var a=1;
        $('#add_a').click(function(){
            a++;
            $('#dynamic_field_a').append('<div id="row'+a+'"><div class="form-group row"><label for="accord_ids" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label><div class="col-md-6"><select id="accord_ids" type="number" class="form-control @error('accord_ids') is-invalid @enderror"name="accord_ids[]" required><option value="" selected="selected" disabled="disabled">-- Select Accord --</option>@foreach($accords as $accord)<option value="{{$accord->id}}">{{$accord->name}}</option>@endforeach</select>@error('accord_ids')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div><div class="col-md-2 button-right-align"><button type="button" name="remove_a" id="'+a+'" class="btn btn-danger btn_remove_a">X</button></div></div>');
        });
        
        $(document).on('click', '.btn_remove_a', function(){
            var button_id = $(this).attr("id");
            
            $('#row'+button_id+'').remove();
        });
        
        $('#submit').click(function(){		
            $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#accord_ids').serialize(),
            success:function(data)
            {
                alert(data);
                $('#add_name')[0].reset();
            }
            });
        });
        
        });
    </script>

    {{-- Ingredient Script --}}
    <script>
        $(document).ready(function(){
        var i=1;  var j=1;  var k=1;
        $('#add_i').click(function(){
            i++; j++; k++;
            // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            
            $('#dynamic_field_i').append('<div id="row'+i+'"><br><div class="form-group row"><label for="ingredient_ids" class="col-md-4 col-from-label text-md-right">{{ __('Ingredient:')}}</label><div class="col-md-6"><select id="ingredient_ids" type="number" class="form-control @error('ingredient_ids') is-invalid @enderror" name="ingredient_ids[]" required><option value="" selected="selected" disabled="disabled">-- Select Ingredient --</option>@foreach($ingredients as $ingredient)<option value="{{$ingredient->id}}">{{$ingredient->name}}</option>@endforeach</select>@error('ingredient_ids')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div>');
            $('#dynamic_field_i').append('<div id="row'+j+'"><div class="form-group row"><label for="notes" class="col-md-4 col-from-label text-md-right">{{ __('Note:')}}</label><div class="col-md-6"><select id="notes" type="number" class="form-control @error('notes') is-invalid @enderror" name="notes[]" required><option value="" selected="selected" disabled="disabled">-- Select Note --</option><option value="1">{{'Top'}}</option><option value="2">{{'Middle'}}</option><option value="3">{{'Base'}}</option></select>@error('notes')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div>');
            $('#dynamic_field_i').append('<div id="row'+k+'"><div class="form-group row"><label for="intensities" class="col-md-4 col-from-label text-md-right">{{ __('Intensity:')}}</label><div class="col-md-6"><select id="intensities" type="number" class="form-control @error('intensities') is-invalid @enderror" name="intensities[]" required><option value="" selected="selected" disabled="disabled">-- Select Intensity --</option><option value="1">{{'1'}}</option><option value="2">{{'2'}}</option><option value="3">{{'3'}}</option><option value="4">{{'4'}}</option><option value="5">{{'5'}}</option><option value="6">{{'6'}}</option><option value="7">{{'7'}}</option><option value="8">{{'8'}}</option><option value="9">{{'9'}}</option><option value="10">{{'10'}}</option></select>@error('intensities')<span class="invalid-feeback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div><div class="col-md-2 button-right-align"><button type="button" name="remove_i" id="'+i+'" id2="'+j+'" id3="'+k+'" class="btn btn-danger btn_remove_i">X</button></div></div>');
        });
        
        $(document).on('click', '.btn_remove_i', function(){
            var button_id = $(this).attr("id");
            var button_id2 = $(this).attr("id2");
            var button_id3 = $(this).attr("id3");

            $('#row'+button_id+'').remove();
            $('#row'+button_id2+'').remove();
            $('#row'+button_id3+'').remove();
        });
        
        $('#submit').click(function(){		
            $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#ingredient_ids').serialize(),
            data:$('#notes').serialize(),
            data:$('#intensities').serialize(),
            success:function(data)
            {
                alert(data);
                $('#add_name')[0].reset();
            }
            });
        });
        
        });
    </script>
    
@endsection