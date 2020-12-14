@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">
<link href="{{ asset('css/forms_request_feature_view.css') }}" rel="stylesheet">

<title>{{_('Request a Feature | Duft Und Du')}}</title>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2>{{ __('Request A Feature')}}</h2>

            <p>
                You can submit a request here by either
                voting for the features if it is already in the list or submitting it.
            </p><br>

            {{-- Informing Guests that Voting Rights are only given to users --}}
            @guest
            <p>
                <a href="login">Login</a> or <a href="register">Sign Up</a> to Request or Vote for A features.
            </p><br>
            @endguest

            @if($features->isNotEmpty())
            <table>

                {{-- Headings --}}
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Request Status</th>
                        <th scope="col">Votes</th>
                        @auth
                        <th scope="col">Vote</th>
                        @endauth
                        <th scope="col">Added On</th>
                        <th scope="col">Added by</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- Data --}}
                    @for ($i = 0; $i < $features->count(); $i++)
                    
                    {{-- If not Brand Ambassador then don't show Brand Ambassador Features  --}}
                    @if($features[$i]->for_brand_ambassador == 1)
                        @hasrole('brand_ambassador')
                        @else
                            @continue
                        @endhasrole
                    @endif
                    <tr>
                        <td data-label="features Name">{{$features[$i]->name}}</td>
                        <td data-label="Description">{{$features[$i]->description}}</td>
                        <td data-label="Request Status">{{$features[$i]->status}}</td>
                        <td data-label="Votes">{{$features[$i]->votes}}</td>
                        @auth
                        <td data-label="Vote">
                            <button type="button" class="btn btn-outline-dark" name="{{$features[$i]->id}}"
                                id="{{$features[$i]->id}}" onclick="handleVote(this.id);">
                                {{ __('Vote') }}
                            </button>
                        </td>
                        @endauth
                        <td data-label="Added On">{{$features[$i]->created_at->format('d/M/y')}}</td>
                        @if($from[$i] == 'staff')
                        <td data-label="Suggested By">Duft Und Du <img 
                            src="{{ asset('images/vector_graphics/verified_black_tick.svg') }}" 
                            src="{{ asset('images/vector_graphics/verified_black_tick.png') }}" 
                            alt="verified tick"
                            height="15"
                            width="15" style="padding-bottom:3px;"/></td>
                        @else
                        <td data-label="Suggested By">{{$features[$i]->user}}</td>
                        @endif
                    </tr>
                    
                    @endfor

                </tbody>
            </table>
            @else
            Nothing in Queue.
            @endif
            <br><br>

            @auth
            {{--  Button: Add features --}}
            <div class="form-group row">
                <div class="center">
                    <button type="button" class="btn btn-outline-dark"
                        onclick="window.location='{{ url('/request_feature_user/') }}'">
                        {{ __('Add New features') }}
                    </button>
                </div>
            </div>
            @endauth

        </div>
    </div>
</div>

{{-- CSRF Token for Ajax --}}
<div id="csrf">
    @csrf
</div>


{{-- Vote --}}
<script>
    function handleVote(features) {
        $.ajax({
            type: 'POST',
            url: '/vote_feature',
            data: {
                "_token": "{{ csrf_token() }}",
                value: 1,
                feature_id: features
            },
            success: function (data) {
                alert(data);
            }
        });
    }
</script>

@endsection