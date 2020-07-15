@extends('layouts.app')

<title>{{('Brands | Duft Und Du')}}</title>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{ __('Brands')}}</div>

                    <div class="card-body">

                        <div class="col-md-4">
                        @if(count($fragrance_Brand) > 0)
                            @foreach($fragrance_Brand as $brand)
                                
                                <h4><a href="/brands/{{$brand->id}}">{{$brand->name}}</a></h4>
                                <small>Added on {{$brand->created_at->format('d/m/Y')}}</small>
                                <br>
                                <br>

                            @endforeach

                        @else
                            <p>No Brands</p>
                        @endif
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection