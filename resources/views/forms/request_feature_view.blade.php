@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">

<title>{{_('Request A features | Duft Und Du')}}</title>

<style>
    .center {
        display: block;
        margin: 0 auto;
    }

    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5rem;
        margin: .5rem 0 .75rem;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35rem;
    }

    table th,
    table td {
        padding: .625rem;
        text-align: center;
    }

    table th {
        font-size: .85rem;
        letter-spacing: .1rem;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {

        table {
            border: 0;
        }

        table caption {
            font-size: 1.3rem;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625rem;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8rem;
            text-align: right;
        }

        table td::before {
            /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }

    .boxes {
        margin: auto;
        padding: 50px;
        background: #484848;
    }

    /*Checkboxes styles*/
    input[type="checkbox"] {
        display: none;
    }

    input[type="checkbox"]+label {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 20px;
        font: 14px/20px 'Open Sans', Arial, sans-serif;
        color: #ddd;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    input[type="checkbox"]+label:last-child {
        margin-bottom: 0;
    }

    input[type="checkbox"]+label:before {
        content: '';
        display: block;
        width: 20px;
        height: 20px;
        border: 1px solid #6cc0e5;
        position: absolute;
        left: 0;
        top: 0;
        opacity: .6;
        -webkit-transition: all .12s, border-color .08s;
        transition: all .12s, border-color .08s;
    }

    input[type="checkbox"]:checked+label:before {
        width: 10px;
        top: -5px;
        left: 5px;
        border-radius: 0;
        opacity: 1;
        border-top-color: transparent;
        border-left-color: transparent;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2>{{ __('Request A features')}}</h2>

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