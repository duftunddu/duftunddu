@extends('layouts.app')

<title>Search Fragarance | Shop | Duft Und Du</title>
{{-- @section('title', 'Search Fragarance | Shop | Duft Und Du') --}}

@push('head_scripts')
{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" defer></script>
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        
            <form method="POST" action="{{ url('/store_search_fragrance')}}">
                @csrf

                <div class="card">
                    <div class="card-header">Search Fragrance</div>
                    <div class="card-body">

                        {{-- Brand Name --}}
                        <div class="form-group row">
                            <label for="brand name" class="col-md-4 col-from-label text-md-right required">Brand Name:</label>

                            <div class="col-md-6">
                                <input type="text" minlength="2" maxlength="50" id="b_name"  placeholder="Brand Name" class="form-control @error('b_name') 
                                is-invalid @enderror" name="b_name" value="{{ old('b_name')}}" required>

                                @error('b_name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Fragrance Name --}}
                        <div class="form-group row">
                            <label for="fragrance name" class="col-md-4 col-from-label text-md-right required">Fragrance Name:</label>

                            <div class="col-md-6">
                                <input type="text" minlength="2" maxlength="50" id="f_name"  placeholder="Fragrance Name" class="form-control typeahead @error('f_name') 
                                is-invalid @enderror" name="f_name" value="{{ old('f_name')}}" required>

                                @error('f_name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- Fragrance Type --}}
                        <div class="form-group row">
                            <label for="fragrance type" class="col-md-4 col-from-label text-md-right required">Fragrance Type:</label>

                            <div class="col-md-6">
                                <input type="text" minlength="3" maxlength="50" id="f_type"  placeholder="Fragrance Type" class="form-control @error('f_type') 
                                is-invalid @enderror" name="f_type" value="{{ old('f_type')}}" required>

                                @error('f_type')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- Button: Submit --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-7">
                                <button type="submit" class="custom">
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

@section('foot_scripts')

{{-- <script>
    var path = "{{ url('/try_api') }}";
    $('input.frag_ahead').typeahead({
        source:  function (to_search, process) {
        return $.get(path, { to_search: to_search }, function (data) {
                return process(data);
            });
        }
    });
</script> --}}
<script src="{{ asset('js/store_fragrance.js') }}" defer></script>
@endsection

@endsection