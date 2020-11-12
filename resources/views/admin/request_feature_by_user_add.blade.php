@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">

<title>{{_('Admin Panel: Approving Feature Request By User | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

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
        <div class="col-md-9">
            
            <h2>{{ __('Admin Panel: Feature Request By User')}}</h2> <br>
            
            <table>

                    {{-- Headings --}}
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Implementation</th>
                            <th scope="col">Added On</th>
                            <th scope="col">Added by</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Data --}}
                        <tr>
                            <td data-label="Name">{{$feature->name}}</td>
                            <td data-label="Description">{{$feature->description}}</td>
                            <td data-label="Implementation">{{$feature->mplementation}}</td>
                            <td data-label="Added On">{{$feature->created_at->format('d/M/y')}}</td>
                            <td data-label="Added by">{{$feature->user->name}}</td>
                        </tr>
                    </tbody>
            </table>

            <br><br>
            
            <div class="card">
                <div class="card-header">{{ __('Request Feature')}}</div>
                <form method="POST" action="{{ url('request_feature_user_add')}}">
                    @csrf
    
                <div class="card-body">

                    {{-- Hidden fields --}}
                    <input type="hidden" id="users_id" name="users_id" value="{{$feature->users_id}}">
                    <input type="hidden" id="feature_id" name="feature_id" value="{{$feature->id}}">

                    {{-- Feature Name --}}
                    <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-from-label text-md-right">{{ __('Feature Name:')}}</label>
                            <div class="col-md-6">

                                <input id="name" type="text" maxlength="40"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{$feature->name}}" required autofocus>

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>
            
                    {{-- Description --}}
                    <div class="form-group row">
                        <label for="description"
                            class="col-md-4 col-from-label text-md-right">{{ __('Description:')}}</label>
                        <div class="col-md-6">

                            <input id="description" type="text" maxlength="256"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{$feature->description}}" required>
                            
                                @error('description')
                            <span class="invalid-feeback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
            
                    {{-- Button: Submit --}}
                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-7">
                                <button type="submit" class="custom">
                                    <span class="before">{{_('Submit')}}</span>
                                    <span class="after">{{_('Submit')}}</span>
                                </button>
                            </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection