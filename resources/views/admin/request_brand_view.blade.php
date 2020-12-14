@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin_request_brand_view.css') }}" rel="stylesheet">

<title>{{_('Request A Brand | Duft Und Du')}}</title>

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h2>{{ __('Admin Request Brand Panel')}}</h2> <br>
           
                @if($brands->isNotEmpty())
                <table>

                    {{-- Headings --}}
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Votes</th>
                        <th scope="col">Request Status</th>
                        <th scope="col">Change Status</th>
                        <th scope="col">Added On</th>
                        <th scope="col">Added by</th>
                      </tr>
                    </thead>
                    <tbody>

                        {{-- Data --}}
                        @foreach($brands as $brand) 
                            <tr>
                                <td data-label="Brand Name">{{$brand->name}}</td>
                                <td data-label="Votes">{{$brand->votes}}</td>
                                <td data-label="Request Status">{{$brand->status}}</td>
                                @if($brand->status == "Queued")
                                <td data-label="Change Status" ><a href="/request_brand_panel/{{$brand->name}}/Informed">To Informed</a></td>
                                @elseif($brand->status == "Informed")
                                <td data-label="Change Status To" ><a href="/request_brand_panel/{{$brand->name}}/Processing">To Processing</a></td>
                                @elseif($brand->status == "Processing")
                                <td data-label="Change Status" ><a href="/request_brand_panel/{{$brand->name}}/Added">To Added</a></td>
                                @else    
                                <td data-label="Change Status" ><a href="/request_brand_panel/{{$brand->name}}/Processing">To Processing</a></td>
                                @endif
                                <td data-label="Added On">{{$brand->created_at->format('d/M/y')}}</td>
                                <td data-label="Added by">{{$brand->user}}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                @else
                Nothing in Queue.
                @endif
                
            </div>
        </div>
    </div>
@endsection
