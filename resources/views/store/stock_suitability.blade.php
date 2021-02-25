@extends('layouts.app')

<title>{{('Stock Suitability | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Stylesheet --}}
    <link href="{{ asset('css/stock_suitability.css') }}" rel="stylesheet">

    <style>
        /* .pad-left{
            margin-left: 20px;
        } */
        /* .center{
            display: flex;
            justify-content: center;
            padding-top: 20px;
        } */
      
        /* {{-- .suitability #{{$fragrances->id}} {
            width: {{$fragrances->suitability<100 ? $fragrances->suitability : 100 }}%;
        } --}} */ 
      
    </style>
    
</head>



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    Stock Suitability
                </div>

                <div class="card-body">
                    <br>

                    @if(count($fragrances) == 0)
                        <p>No fragrances Found</p>
                    @else

                        @foreach($fragrances as $fragrance)
                        {{-- Suitability --}}
                    <div class="form-group row">

                        <h5 class="col-md-5 col-from-label text-md-right">
                            <span class="lux-purple">{{$fragrance->fragrance}}</span>
                            by
                            <span class="lux-red">{{$fragrance->brand}}</span>
                        </h5>
                            
                        {{-- <h5 class="hsl-color" data-toggle="tooltip" data-placement="top" data-html="true"
                            title="Depends on season.<br>100 is average.<br>Above 100 is better.">
                            Suitability: <span class="lux-red">{{$fragrance->suitability}}</span></h5> --}}
                        {{-- Bar --}}
                            <div class="col-md-6">
                                <div class="review-bar-cont"> 
                                    <div class="review-bar suitability" id={{$fragrance->id}} style="width: {{$fragrance->suitability<100 ? $fragrance->suitability : 100 }}%;"></div> 
                                </div>
                            </div>

                        </div>
                        @endforeach

                    @endif
                
                    <div class="center">
                        {{-- {{ $fragrances->appends($params)->links() }} --}}
                    </div>

                    <br>

                    {{-- Stock --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/store_home') }}'">
                                Store Dashboard
                            </button>
                        </div>
                    </div><br>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection