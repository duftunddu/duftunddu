@extends('layouts.app')

<title>{{('Brands | Duft Und Du')}}</title>

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

    /* small transition */
    small{
        /* margin: 0; */
        opacity: 1;
        transform: translate(0);
        transition: all 250ms linear;
        transition-delay: 1000ms;
    }
    body.hero-anime small{
        opacity: 0;
        transform: translateY(50px);
        transition-delay: 1000ms;
    }

    .center{
        display: flex;
        justify-content: center;
        padding-top: 20px;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{ __('Brands')}}</div>

                    <div class="card-body">

                        <div class="col-md-9">
                            
                            @if(count($brands) > 0)
                                
                                @foreach($brands as $brand)
                                    
                                    <h4><a href="/brand/{{$brand->id}}">{{$brand->name}}</a></h4>
                                    <small>Added on {{$brand->created_at->format('d/M/y')}}</small>
                                    <br><br>

                                @endforeach
                                
                                <div class="center">
                                    {{-- {{ $brands->appends($params)->links() }} --}}
                                    {{ $brands->links() }}
                                </div>

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