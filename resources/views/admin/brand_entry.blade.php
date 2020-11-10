@extends('layouts.app')

<title>{{('Brand Entry | The AI Powered Fragrance Genie')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

@section('content')

{{-- Button: Add Another --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Brand Entry')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('brand_entry_admin')}}">
                            @csrf

                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" placeholder="Chanel" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tier --}}
                            <div class="form-group row">
                                <label for="tier_id" class="col-md-4 col-from-label text-md-right">{{ __('Tier:')}}</label>

                                <div class="col-md-6">
                                    <select id="tier_id" type="number" class="form-control @error('tier_id') is-invalid @enderror" name="tier_id" value="{{ old('tier_id')}}" required>
                                          <option value="" selected="selected" disabled="disabled">-- Select Tier --</option>
                                          
                                          @foreach($tiers as $tier)
                                              <option value="{{$tier->id}}">{{$tier->name}}</option>
                                          @endforeach
                                     
                                      </select>
                
                                  @if($errors->has('tier_id'))
                                      <div class="invalid-feedback">
                                          {{ $errors->first('tier_id')}}
                                      </div>
                                  @endif
                                    
                                </div>
                            </div>

                            {{-- Origin --}}
                            <div class="form-group row">
                                <label for="location_id" class="col-md-4 col-from-label text-md-right">{{ __('Origin:')}}</label>

                                <div class="col-md-6">
                                    
                                    <select id="location_id" type="number" class="form-control @error('location_id') is-invalid @enderror" name="location_id" value="{{ old('location_id')}}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                    @endforeach

                                </select>
                                
                                @if($errors->has('location_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('location_id')}}
                                    </div>
                                @endif
                                </div>
                            </div>

                            {{-- Availability --}}
                            <div id="dynamic_field">

                                <div class="form-group row">
                                  <label for="availability" class="col-md-4 col-from-label text-md-right">{{ __('Availability of Stores:')}}</label>
                
                                  <div class="col-md-6">
                                      
                                      <select id="availability" type="number" class="form-control @error('availability') is-invalid @enderror" name="availability" value="{{ old('availability')}}" required>
                                          <option value="" selected="selected" disabled="disabled">-- Select Country --</option>
                                          
                                            @foreach($countries as $country)
                                                <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endforeach

                                      </select>
                
                                  @if($errors->has('availability'))
                                      <div class="invalid-feedback">
                                          {{ $errors->first('availability')}}
                                      </div>
                                  @endif
                                  
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

                            <br>

                            {{-- Submit --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
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
        </div>
    </div>

    {{-- Script: Availability --}}
    <script>
        $(document).ready(function(){
          var a=1;
          $('#add_a').click(function(){
            a++;
            $('#dynamic_field').append('<div id="row'+a+'"><div class="form-group row"><label for="availabilities" class="col-md-4 col-from-label text-md-right">{{ __('Availability:')}}</label><div class="col-md-6"><select id="availabilities[]" type="number" class="form-control @error('availabilities[]') is-invalid @enderror" name="availabilities[]" value="{{ old('availabilities[]')}}" required><option value="" selected="selected" disabled="disabled">-- Select Country --</option>@foreach($countries as $country)<option value="{{$country->country_name}}">{{$country->country_name}}</option>@endforeach</select>@if($errors->has('availabilities[]'))<div class="invalid-feedback">{{ $errors->first('availabilities')}}</div>@endif</div><div class="col-md-2 button-right-align"><button type="button" name="remove_a" id="'+a+'" class="btn btn-danger btn_remove_a">X</button></div></div>');
          });
          
          $(document).on('click', '.btn_remove_a', function(){
            var button_id = $(this).attr("id");
            
            $('#row'+button_id+'').remove();
          });
          
          $('#submit').click(function(){		
            $.ajax({
              url:"name.php",
              method:"POST",
              data:$('#availabilities_ids').serialize(),
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
