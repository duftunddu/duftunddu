{{-- @extends('layouts.bar') --}}
{{-- @extends('layouts.nav_bar') --}}

@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ url('genie_input')}}">
                    @csrf

                  <div class="card">
                    <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>

                    <div class="card-body">

                            {{-- Accord --}}
                            {{-- <div class="form-group row">
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
                            </div> --}}

                            <div class="form-group row">
                              <label for="accord" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                              <form name="add_name" id="add_name">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                      <td>
                                        <select id="accord_id" type="accord_id" class="form-control @error('accord_id') is-invalid @enderror" name="accord_id" value="{{ old('')}}" required>
                                          <option value="" selected="selected" disabled="disabled">-- Select Accord --</option>
                                          {{-- @foreach($accords as $accord) --}}
                                              {{-- <option value="{{$accord->id}}">{{$accord->name}}</option> --}}
                                          {{-- @endforeach --}}
                                          <option value="1"> Frag</option>
                                      </select>
  
                                      </td>
                                      <td><button type="button" name="add" id="add" class="btn btn-success">{{ __('Add Another')}}</button></td>
                                    </tr>
                                  </table>
                                </div>
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
            </form>
          </div>
        </div>
    </div>

    <script>
      $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
          i++;
          $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
          $('#dynamic_field').append('<tr id="row'+i+'"><td><select type="accord_id" class="form-control name="accord_id[]" value="{{ old('')}}" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        
        $(document).on('click', '.btn_remove', function(){
          var button_id = $(this).attr("id"); 
          $('#row'+button_id+'').remove();
        });
        
        $('#submit').click(function(){		
          $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#add_name').serialize(),
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