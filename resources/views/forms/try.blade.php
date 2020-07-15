{{-- @extends('layouts.app') --}}

<title>Try</title>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

{{-- <script src="https://rawgit.com/alvarotrigo/fullPage.js/dev/src/fullpage.js"></script> --}}

{{-- <script src="{{ asset('js/fullpage.js') }}" defer></script> --}}


{{-- <link href="{{ asset('css/onepage-scroll.css') }}" rel="stylesheet"> --}}
{{-- <script src="{{ asset('js/onepage-scroll.js') }}" defer></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script> --}}
{{-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/MorphSVGPlugin3.min.js"></script> --}}
{{-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/Draggable3.min.js"></script> --}}
<script src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon="{&quot;rayId&quot;:&quot;5b21a520dd7fc60d&quot;,&quot;version&quot;:&quot;2020.6.0&quot;,&quot;si&quot;:10}"></script>

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

<button class="button-hold">
  <div>
      <svg class="icon" viewBox="0 0 16 16">
          <polygon points="1.3,6.7 2.7,8.1 7,3.8 7,16 9,16 9,3.8 13.3,8.1 14.7,6.7 8,0"></polygon>
      </svg>
      <svg class="progress" viewBox="0 0 32 32">
          <circle r="8" cx="16" cy="16" />
      </svg>
      <svg class="tick" viewBox="0 0 24 24">
          <polyline points="18,7 11,16 6,12" />
      </svg>
  </div>
  Publish
</button>

<!-- dribbble -->
<a class="dribbble" href="https://dribbble.com/shots/8445173-Press-button-to-confirm" target="_blank"><img src="https://cdn.dribbble.com/assets/dribbble-ball-mark-2bd45f09c2fb58dbbfb44766d5d1d07c5a12972d602ef8b32204d28fa3dda554.svg" alt=""></a>
<a class="twitter" target="_blank" href="https://twitter.com/aaroniker_me"><svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72"><path d="M67.812 16.141a26.246 26.246 0 0 1-7.519 2.06 13.134 13.134 0 0 0 5.756-7.244 26.127 26.127 0 0 1-8.313 3.176A13.075 13.075 0 0 0 48.182 10c-7.229 0-13.092 5.861-13.092 13.093 0 1.026.118 2.021.338 2.981-10.885-.548-20.528-5.757-26.987-13.679a13.048 13.048 0 0 0-1.771 6.581c0 4.542 2.312 8.551 5.824 10.898a13.048 13.048 0 0 1-5.93-1.638c-.002.055-.002.11-.002.162 0 6.345 4.513 11.638 10.504 12.84a13.177 13.177 0 0 1-3.449.457c-.846 0-1.667-.078-2.465-.231 1.667 5.2 6.499 8.986 12.23 9.09a26.276 26.276 0 0 1-16.26 5.606A26.21 26.21 0 0 1 4 55.976a37.036 37.036 0 0 0 20.067 5.882c24.083 0 37.251-19.949 37.251-37.249 0-.566-.014-1.134-.039-1.694a26.597 26.597 0 0 0 6.533-6.774z"></path></svg></a>