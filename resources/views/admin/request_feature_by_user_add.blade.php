@extends('layouts.app')

<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin_request_feature_by_user_add.css') }}" rel="stylesheet">

<title>{{_('Admin Panel: Approving Feature Request By User | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

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

                        {{-- For Brand Ambassador --}}
                        <div class="form-group row">
                            <label for="for_brand_ambassador"
                                class="col-md-4 col-from-label text-md-right">{{ __('Check if it is for Brand Ambassador:')}}</label>
                            <div class="col-md-6">

                                <input type="checkbox" name="for_brand_ambassador" id="for_brand_ambassador" class="form-control @error('for_brand_ambassador') is-invalid @enderror" />

                                @error('for_brand_ambassador')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Acknowledgement of BA Checkbox --}}
                        <div class="form-group row">
                            <label for="ack_ba_check"
                                class="col-md-4 col-from-label text-md-right">{{ __('Acknowledge that the value in the above checkbox is correct:')}}</label>
                            <div class="col-md-6">

                                <input type="checkbox" name="ack_ba_check" id="ack_ba_check" class="form-control @error('ack_ba_check') is-invalid @enderror" required />

                                @error('ack_ba_check')
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