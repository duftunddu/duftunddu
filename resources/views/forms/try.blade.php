{{-- @extends('layouts.bar') --}}
{{-- @extends('layouts.nav_bar') --}}

@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
          
        <div class="card">
          <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>

            <div class="card-body">
              <form method="POST" action="{{ url('try')}}">
                @csrf

                  <div class="form-group row">
                    <label for="accord" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                      <div class="col-md-6">

                        <div class="table-responsive">
                          <table class="table" id="dynamic_field">
                                    
                            <tr>
                                      
                              <td>
                                <select id="accord_id" type="accord_id" class="form-control @error('accord_id') is-invalid @enderror" name="accord_id" value="{{ old('')}}" required>
                                  <option value="" selected="selected" disabled="disabled">-- Select Accord --</option>
                                    @foreach($accords as $accord)
                                      <option value="{{$accord->id}}">{{$accord->name}}</option>
                                    @endforeach
                                </select>
  
                              </td>

                              {{-- + / Add Another Button --}}
                              <td><button type="button" name="add" id="add" class="btn btn-success">{{ _('+')}}</button></td>
                                    
                              </tr>
                            </table>

                        </div>
                                
                          {{-- Button: Submit --}}
                        <div class="form-group row">
                          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-7" style="padding-left: 8.1rem">
                              <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                              </button>
                            </div>
                          </div>
                        </div>

                    </div>

                  </div>


              </form>    
            </div>

          </div>

      </div>
    </div>
  </div>

    <script>
      $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
          i++;
          // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
          
          $('#dynamic_field').append('<tr id="row'+i+'"><td><select type="accord_ids" name="accord_ids[]" value="{{ old('')}}" class="form-control" required><option value="" selected="selected" disabled="disabled">-- Select Accord --</option>@foreach($accords as $accord)<option value="{{$accord->id}}">{{$accord->name}}</option>@endforeach</td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        
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