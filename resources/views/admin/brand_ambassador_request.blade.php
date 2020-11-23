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

                                    @if($ambassador->status == "new_brand_request")
                                        <h4>Candidate</h4>
                                    @elseif($ambassador->status == "new_brand_details_request")
                                        <h4>New, Brand Not Yet Added</h4>                                    
                                    @elseif($ambassador->status == "existing_brand_request")
                                        <h4>New, Brand Added</h4>                                    
                                    @elseif($ambassador->status == "rejected")
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
                                    <small>Added on {{$ambassador->updated_at->format('d/M/y')}}</small>

                                    @if($ambassador->status == 'new_brand_request')
                                    {{-- New Candidate: Candidate Profile has been filled, is Candidate_Brand Ambassador --}}
                                    {{-- Approve Profile to convert to New_Brand_Ambassador --}}
                                        <h4><a href="/brand_ambassador_requests/new_brand_details_request/{{$ambassador->id}}">Promote to New_Brand_Ambassador</a></h4>
                                    @elseif($ambassador->status == 'new_brand_details_request')
                                    {{-- New Brand: Allow to Add or Select Brand, is New_Brand_Ambassador --}}
                                        {{-- <h4><a href="/brand_ambassador_requests/existing_brand_request/{{$ambassador->id}}">Approve</a></h4> --}}
                                        <h4>Waiting for them to Pick Brand or to Add one</h4>
                                    @elseif($ambassador->status == 'existing_brand_request')
                                    {{-- New Brand: Brand has been added --}}
                                    {{-- Approve to convert to Brand_Ambassador --}}
                                        <h4><a href="/brand/{{$ambassador->brand_id}}">Check Brand</a></h4>
                                        <h4><a href="/brand_ambassador_requests/brand_ambassador/{{$ambassador->id}}">Approve</a></h4>
                                    @elseif($ambassador->status == 'rejected')
                                    {{-- Rejected: Insufficient Information --}}
                                    {{-- Approve to convert to Brand_Ambassador --}}
                                        <h4><a href="/brand_ambassador_requests/new_brand_details_request/{{$ambassador->id}}">Rejected - Approve</a></h4>
                                    @endif
                                    {{-- <h4><a href="/brand_ambassador_requests/brand_ambassador/{{$ambassador->id}}">Approve</a></h4> --}}
                                    <h4><a href="/brand_ambassador_requests/rejected/{{$ambassador->id}}">Reject</a></h4>

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