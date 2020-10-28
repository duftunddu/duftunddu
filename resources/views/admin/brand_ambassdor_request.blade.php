@extends('layouts.app')

<title>{{('Brand Ambassdor Requests | Duft Und Du')}}</title>

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
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Brand Ambassdor Requests')}}</div>

                    <div class="card-body">
                        <div class="col-md-9">

                            @if(!empty($ambassadors))
                                Don't forget to check the new brand before approving.
                                <br><br>

                                @foreach($ambassadors as $ambassador)

                                    @if($ambassador->status == 0)
                                        <h4>Candidate</h4>
                                    @elseif($ambassador->status == 1)
                                        <h4>New, Brand Not Yet Added</h4>                                    
                                    @elseif($ambassador->status == 2)
                                        <h4>New, Brand Added</h4>                                    
                                    @elseif($ambassador->status == 3)
                                        <h4>New, Brand Not Yet Added</h4>                                    
                                    @endif


                                    @if(empty($ambassador->brand_id))
                                        <h4>New Brand</h4>
                                    @else
                                        <h4>{{$ambassador->brand_id}}</h4>                                    
                                    @endif

                                    @if(empty($ambassador->brand_name))
                                        <h4>Existing Brand</h4>
                                    @else
                                        <h4>{{$ambassador->brand_name}}</h4>                                    
                                    @endif

                                    <h4>{{$ambassador->linkedin}}</h4>
                                    <h4>{{$ambassador->email_work}}</h4>
                                    <h4>{{$ambassador->website}}</h4>
                                    <small>Added on {{$ambassador->updated_at->format('d/m/Y')}}</small>

                                    @if($ambassador->status == 0)
                                    {{-- New Candidate: Candidate Profile has been filled, is Candidate_Brand Ambassador --}}
                                    {{-- Approve Profile to convert to New_Brand_Ambassador --}}
                                        <h4><a href="/brand_ambassador_requests/1/{{$ambassador->id}}">Promote to New_Brand_Ambassador</a></h4>
                                    @elseif($ambassador->status == 1)
                                    {{-- New Brand: Allow to Add or Select Brand, is New_Brand_Ambassador --}}
                                        {{-- <h4><a href="/brand_ambassador_requests/2/{{$ambassador->id}}">Approve</a></h4> --}}
                                        <h4>Waiting for them to Pick Brand or to Add one</h4>
                                    @elseif($ambassador->status == 2)
                                    {{-- New Brand: Brand has been added --}}
                                    {{-- Approve to convert to Brand_Ambassador --}}
                                        <h4><a href="/brand/{{$ambassador->brand_id}}">Check Brand</a></h4>
                                        <h4><a href="/brand_ambassador_requests/4/{{$ambassador->id}}">Approve</a></h4>
                                    @elseif($ambassador->status == 3)
                                    {{-- Rejected: Insufficient Information --}}
                                    {{-- Approve to convert to Brand_Ambassador --}}
                                        <h4><a href="/brand_ambassador_requests/1/{{$ambassador->id}}">Rejected - Approve</a></h4>
                                    @endif
                                    {{-- <h4><a href="/brand_ambassador_requests/4/{{$ambassador->id}}">Approve</a></h4> --}}
                                    <h4><a href="/brand_ambassador_requests/3/{{$ambassador->id}}">Reject</a></h4>

                                    <br><br>

                                @endforeach

                            @else
                                <p>No Requests</p>
                            @endif
                
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection