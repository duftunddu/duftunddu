@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin_request_feature_view.css') }}" rel="stylesheet">

<title>{{_('Admin Panel: Request Feature | Duft Und Du')}}</title>

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h2>{{ __('Admin Panel: Request Feature')}}</h2> <br>
           
                @if($features->isNotEmpty())
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
                        @foreach($features as $feature) 
                            <tr>
                                <td data-label="Brand Name">{{$feature->name}}</td>
                                <td data-label="Votes">{{$feature->votes}}</td>
                                <td data-label="Request Status">{{$feature->status}}</td>
                                @if($feature->status == "Queued")
                                <td data-label="Change Status" ><a href="/request_feature_panel/{{$feature->id}}/In Progess">To In Progess</a></td>
                                @elseif($feature->status == "In Progess")
                                <td data-label="Change Status To" ><a href="/request_feature_panel/{{$feature->id}}/Experimental">To Experimental</a></td>
                                @elseif($feature->status == "Experimental")
                                <td data-label="Change Status" ><a href="/request_feature_panel/{{$feature->id}}/Added">To Added</a></td>
                                @else    
                                <td data-label="Change Status" ><a href="/request_feature_panel/{{$feature->id}}/Experimental">To Experimental</a></td>
                                @endif
                                <td data-label="Added On">{{$feature->created_at->format('d/M/y')}}</td>
                                <td data-label="Added by">{{$feature->user}}</td>
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
