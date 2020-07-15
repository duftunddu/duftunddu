@extends('layouts.app')

<title>{{__($brand->name)}} {{(' | Duft Und Du')}}</title>

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{'Brand: '}} {{ __($brand->name)}}</div>

                    <div class="card-body">

                        <div class="col-md-4">

                            <h4>Tier: {{$tier->name}}</h4>
                            <br>
                            <h4>Origin: {{$origin->name}}</h4>
                            <br>

                            <h4>Available in:</h4>
                            @foreach($countries as $country)
                                <h5>{{$country->name}}</h5>     
                            @endforeach
                            
                            <br>

                            <p>Added on {{$brand->created_at->format('d/m/Y')}}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection