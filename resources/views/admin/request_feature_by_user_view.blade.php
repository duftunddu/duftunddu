@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin_request_feature_by_user_view.css') }}" rel="stylesheet">

<title>{{_('Admin Panel: Feature Request By User | Duft Und Du')}}</title>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2>{{ __('Admin Panel: Feature Request By User')}}</h2> <br>

            @if($requests->isNotEmpty())
            <table>

                {{-- Headings --}}
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Implementation</th>
                        <th scope="col">Approve/Delete</th>
                        <th scope="col">Added On</th>
                        <th scope="col">Added by</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- Data --}}
                    @foreach($requests as $request)
                    <tr>
                        <td data-label="Name">{{$request->name}}</td>
                        <td data-label="Description">{{$request->description}}</td>
                        <td data-label="Implementation">{{$request->mplementation}}</td>
                        <td data-label="Approve/Delete"><a
                                href="/request_feature_user_review/{{$request->id}}/approve">Approve</a> / <a
                                href="/request_feature_user_review/{{$request->id}}/delete">Delete</a></td>
                        <td data-label="Added On">{{$request->created_at->format('d/M/y')}}</td>
                        <td data-label="Added by">{{$request->user->name}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @else
            Nothing in Queue.
            @endif<br><br>

        </div>
    </div>
</div>
@endsection