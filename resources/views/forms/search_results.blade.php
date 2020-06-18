@extends('layouts.app')

<title>{{('Brands - Duft Und Du')}}</title>

<style>
    h3{
        color:#ce3953;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{ __('Search Results')}}</div>

                        <div class="card-body">
                                
                            @if(count($brands) == 0 and count($fragrances) == 0)
                            <p>{{_('No Results Found')}}</p>
                            
                            @else
                            
                                @if(count($brands) > 0)

                                    <h2>{{_('Brands')}}</h2>
                                    <br>
                                
                                    @foreach($brands as $brand)
                                        <div class="well">
                                            <a href="/brand_output/{{$brand->id}}"><h3>{{$brand->name}}</h3></a>
                                            <small>Added on {{$brand->created_at}}</small>
                                        </div>
                                    @endforeach
                                <br><br>
                                @else
                                @endif

                            
                                @if(count($fragrances) > 0)
                                    
                                    <h2>{{_('Fragrances')}}</h2>
                                    <br>

                                    @foreach($fragrances as $fragrance)
                                        <div class="well">
                                            <h3><a href="/brand_output/{{$fragrance->id}}">{{$fragrance->name}}</a></h3>
                                            <small>Added on {{$fragrance->created_at}}</small>
                                        </div>
                                    @endforeach
                                @else
                                    <p>{{_('No Fragrances Found')}}</p>
                                @endif
                            
                                @if(count($brands) == 0)
                                    <p>{{_('No Brands Found')}}</p>
                                @else
                                @endif
                
                        @endif
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection