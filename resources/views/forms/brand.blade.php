@extends('layouts.app')

<title>{{__($brand->name)}} {{(' | Duft Und Du')}}</title>

<style>
    /* h4 transition */
    h4{
        opacity: 1;
        transform: translate(0);
        transition: all 200ms linear;
        transition-delay: 700ms;
    }
    body.hero-anime h4{
        opacity: 0;
        transform: translateY(8px);
        transition-delay: 700ms;
    }

    /* h5 transition */
    h5{
        opacity: 1;
        transform: translate(0);
        transition: all 200ms linear;
        transition-delay: 800ms;
    }
    body.hero-anime h5{
        opacity: 0;
        transform: translateY(8px);
        transition-delay: 800ms;
    }

    /* p transition */
    p{
        /* margin: 0; */
        opacity: 1;
        transform: translate(0);
        transition: all 225ms linear;
        transition-delay: 900ms;
    }
    body.hero-anime p{
        opacity: 0;
        transform: translateY(12px);
        transition-delay: 900ms;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{'Brand: '}} {{ __($brand->name)}}</div>

                    <div class="card-body">

                        <div class="col-md-9">

                            <a href="/fragrances/{{$brand->id}}"><h4>Fragrances</h4><a><br>
                            <h4>Tier: {{$tier->name}}</h4><br>
                            <h4>Origin: {{$origin->country_name}}</h4><br>

                            <h4>Outlets Available in:</h4>
                            @foreach($countries as $country)
                                <h5>{{$country->country_name}}</h5>     
                            @endforeach
                            
                            <br>

                            <p>Added on {{$brand->created_at->format('d/M/y')}}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection