@extends('layouts.app')

<title>{{('Brands - Duft Und Du')}}</title>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                
                <div class="card">
                    <div class="card-header">{{ __('Brands')}}</div>

                    <div class="card-body">

                        @if(count($fragrance_Brand) > 0)
                    @foreach($fragrance_Brand as $brand)
                        <div class="well">
                            <h3><a href="/brand_output/{{$brand->id}}">{{$brand->name}}</a></h3>
                            <small>Added on {{$brand->created_at}}</small>
                        </div>
                    @endforeach
                @else
                    <p>No Brands</p>
                @endif
                
                        {{-- <form method="POST" action="{{ url('brand_entry')}}"> --}}
                            {{-- @csrf --}}

                            {{-- Name --}}
                            {{-- <div class="form-group row">
                                <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection