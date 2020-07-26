{{-- @extends('layouts.app') --}}

<title>Try</title>

{{-- @section('content')
//   <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="{{ url('try')}}">
          @csrf --}}
    
          {{-- Accord Table --}}
          {{-- <div class="card">
            <div class="card-header">{{ __('Fragrance Accord Entry')}}</div>

            <div class="card-body">
                
                  <div class="form-group row">
                    <label for="availability" class="col-md-4 col-from-label text-md-right">{{ __('Availability:')}}</label>

                    <div class="col-md-6">
                        
                        <select id="availability" type="number" class="form-control @error('availability') is-invalid @enderror" name="availability" value="{{ old('availability')}}" required>
                            <option value="" selected="selected" disabled="disabled">-- Select Country --</option>
                            
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                      
                        </select>

                    @if($errors->has('availability'))
                        <div class="invalid-feedback">
                            {{ $errors->first('availability')}}
                        </div>
                    @endif
                    
                    </div>
                  </div> --}}

                {{-- Button: Submit --}}
                {{-- <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="noselect custom">
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

@endsection --}}


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

{{-- <link href="{{ asset('css/onepage-scroll.css') }}" rel="stylesheet"> --}}
{{-- <script src="{{ asset('js/onepage-scroll.js') }}" defer></script> --}}


<link href="{{ asset('css/try.css') }}" rel="stylesheet">
{{-- <script src="{{ asset('js/try.js') }}"></script> --}}


<div class="button__holder">
  <h2>Hover me &rarr;</h2>
  <button class="plus"></button>
</div>

{{-- <script src="{{ asset('js/try.js') }}"></script> --}}