{{-- @extends('layouts.app') --}}

<title>Try</title>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

{{-- <script src="https://rawgit.com/alvarotrigo/fullPage.js/dev/src/fullpage.js"></script> --}}

{{-- <script src="{{ asset('js/fullpage.js') }}" defer></script> --}}


{{-- <link href="{{ asset('css/onepage-scroll.css') }}" rel="stylesheet"> --}}
{{-- <script src="{{ asset('js/onepage-scroll.js') }}" defer></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<link href="{{ asset('css/try.css') }}" rel="stylesheet">
<script src="{{ asset('js/try.js') }}"></script>

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

<div id="tabs">
  <ul id="accordion">
    <li>
      <a class="active" href="#tabs-1">   <div class="tag">
          <div class="icon">
            <div class="block">
              <div class="circle"></div>
            </div>
          </div>
          <span class="title">Feature One</span>
        </div>
      </a>
        <div class="addon fadein">
          <span>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
          </span>
          <a class="para-a" href="#">Learn More</a>
        </div>
    </li>
    <li>
      <a href="#tabs-2">   <div class="tag">
          <div class="icon">
            <div class="block">
              <div class="circle"></div>
            </div>
          </div>
          <span class="title">Feature Two</span>
        </div>
      </a>
        <div class="addon">
          <span>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
          </span>
          <a class="para-a" href="#">Learn More</a>
        </div>
    </li>
    <li>
      <a href="#tabs-3">   <div class="tag">
          <div class="icon">
            <div class="block">
              <div class="circle"></div>
            </div>
          </div>
          <span class="title">Feature Three</span>
        </div>
      </a>
        <div class="addon">
          <span>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
          </span>
          <a class="para-a" href="#">Learn More</a>
        </div>
    </li>
  </ul>
  <div class="browser">
    <div class="top-bar">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
    <div id="tabs-1"></div>
    <div id="tabs-2"></div>
    <div id="tabs-3"></div>
  </div>
</div>