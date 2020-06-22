@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<link href="{{ asset('css/range_slider_strength.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider_strength.js') }}" defer></script>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ url('try')}}">
          @csrf
    
        <div class="card">
          <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>

            <div class="card-body">
              
                  <div class="form-group row">
                    <label for="ingredient" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                      <div class="col-md-6">

                        {{-- Name --}}
                        <div class="table-responsive">
                          <table class="table" id="dynamic_field">
                                    
                            <tr>
                                      
                              <td>
                                <select id="ingredient_id" type="ingredient_id" class="form-control @error('ingredient_id') is-invalid @enderror" name="ingredient_id" value="{{ old('')}}" required>
                                  <option value="" selected="selected" disabled="disabled">-- Select Ingredient --</option>
                                    @foreach($accords as $accord)
                                      <option value="{{$accord->id}}">{{$accord->name}}</option>
                                    @endforeach
                                </select>
  
                              </td>

                              {{-- + / Add Another Button --}}
                              {{-- <td><button type="button" name="add" id="add" class="btn btn-success">{{ _('+')}}</button></td> --}}
                                    
                              </tr>
                            {{-- </table> --}}
                        {{-- </div> --}}

                        {{-- Note --}}
                        {{-- <div class="table-responsive"> --}}
                          {{-- <table class="table" id="dynamic_field"> --}}
                                    
                            <tr>
                                      
                              <td>
                                <select id="note" type="note" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('')}}" required>
                                  <option value="" selected="selected" disabled="disabled">-- Select Note --</option>
                                    @foreach($accords as $accord)
                                      <option value="{{$accord->id}}">{{$accord->name}}</option>
                                    @endforeach
                                </select>
  
                              </td>

                              {{-- + / Add Another Button --}}
                              {{-- <td><button type="button" name="add" id="add" class="btn btn-success">{{ _('+')}}</button></td> --}}
                                    
                              </tr>
                            {{-- </table> --}}
                        {{-- </div> --}}

                        {{-- Intensity --}}
                        {{-- <div class="table-responsive"> --}}
                          {{-- <table class="table" id="dynamic_field"> --}}
                                    
                            <tr>
                                      
                              <td>
                                <select id="strength" type="strength" class="form-control @error('strength') is-invalid @enderror" name="strength" value="{{ old('')}}" required>
                                  <option value="" selected="selected" disabled="disabled">-- Select Intensity --</option>
                                    @foreach($accords as $accord)
                                      <option value="{{$accord->id}}">{{$accord->name}}</option>
                                    @endforeach
                                </select>
  
                              </td>

                              {{-- + / Add Another Button --}}
                            <tr >
                              <td ><button type="button" name="add" id="add" class="btn btn-success">{{ _('+')}}</button></td>
                            </tr>
                                    
                              </tr>
                            </table>
                        </div>
                                
                          {{-- Button: Submit --}}
                        <div class="form-group row">
                          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-7">
                              <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                              </button>
                            </div>
                          </div>
                        </div>

                    </div>

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
        var j=1;
        var k=1;
        $('#add').click(function(){
          i++; j++; k++;
          // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
          
          $('#dynamic_field').append('<tr id="row'+i+'"><td><select type="text" name="ingedient_ids[]" value="{{ old('')}}" class="form-control" required><option value="" selected="selected" disabled="disabled">-- Select Ingredient --</option>@foreach($accords as $accord)<option value="{{$accord->id}}">{{$accord->name}}</option>@endforeach</td></tr>');
          $('#dynamic_field').append('<tr id="row'+j+'"><td><select type="number" name="note_ids[]" value="{{ old('')}}" class="form-control" required><option value="" selected="selected" disabled="disabled">-- Select Note --</option><option value="1">{{'Top'}}</option><option value="2">{{'Middle'}}</option><option value="3">{{'Base'}}</option></td></tr>');
          $('#dynamic_field').append('<tr id="row'+k+'"><td><input type="range" min="0" max="100" value="0" class="slider" id="strength" name="strength_ids[]" required><label>{{_('Value: ')}}<span id="value"></span></label></td><td></td></tr>');
          $('#dynamic_field').append('<tr id="row'+k+'"><td><input type="range" min="0" max="100" value="0" class="slider" id="strength" name="strength_ids[]" required><label>{{_('Value: ')}}<span id="value"></span></label></td><td><button type="button" name="remove" id="'+i+'" id2="'+j+'" id3="'+k+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        
        });
        
        $(document).on('click', '.btn_remove', function(){
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