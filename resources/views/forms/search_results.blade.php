@extends('layouts.app')

<title>{{('Brands - Duft Und Du')}}</title>

<style>
    h3 {
        color: #ce3953;
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

                        <h4>{{_('Brands')}}</h4>
                        <br>

                            @foreach($brands as $brand)
                            <div class="well">
                                <a href="/brand/{{$brand->id}}">
                                    <h5>{{$brand->name}}</h5>
                                </a>
                                <small>Added on {{$brand->created_at}}</small>
                            </div>
                            @endforeach
                        
                        <br><br>
                        @endif

                        @if(count($fragrances) > 0)

                        <h4>{{_('Fragrances')}}</h4>

                            @foreach($fragrances as $fragrance)
                            <div class="well">
                                <h5><a href="/brand/{{$fragrance->id}}">{{$fragrance->name}}</a></h5>
                                <small>Added on {{$fragrance->created_at}}</small>
                            </div>
                            @endforeach
                            <br>
                        @else
                            <p>{{_('No Fragrances Found')}}</p>
                        @endif

                        @if(count($brands) == 0)
                            <p>{{_('No Brands Found')}}</p>
                        @endif

                    @endif

                    {{-- {{ $fragrances->links() }} --}}
                    {{ $fragrances->onEachSide(10)->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection