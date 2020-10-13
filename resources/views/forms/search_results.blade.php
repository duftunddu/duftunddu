@extends('layouts.app')

<title>{{('Search Results for "')}}{{($query)}}{{('" | Duft Und Du')}}</title>

<style>
    .pad-left{
        margin-left: 20px;
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
                
                <div class="card-header">
                    <div class="pad-left">
                        {{ __('Search Results')}}
                    </div>
                </div>

                <div class="card-body">

                    <div class="pad-left">
                        @if(count($results) == 0)
                            <p>{{_('No Results Found')}}</p>
                        @else

                            @foreach($results as $result)
                                <h5><a href="/fragrance/{{$result->f_id}}">{{$result->f_name}}</a></h5>
                                <small>by <a href="/brand/{{$result->b_id}}">{{$result->b_name}}</a></small>
                                <br><br>
                            @endforeach

                        @endif
                    </div>
                
                    <div class="center">
                        {{ $results->appends($params)->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection