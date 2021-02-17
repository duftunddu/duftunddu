@extends('layouts.app')

<title>{{_('Email Panel | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" id="email_template_show" target="_blank" action="{{ url('/email_template_show')}}">
                @csrf
                <input type="hidden" id="email_template" name="email_template" value=""/>

            </form>
            <form method="POST" id="email_send" action="{{ url('/email_send')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Email Panel')}}</div>

                    <div class="card-body">

                        {{-- Email Template Name --}}
                        <div class="form-group row">
                            <label for="email_template_name"
                                class="col-md-4 col-from-label text-md-right required">{{ __('Email Template Name:')}}</label>

                            <div class="col-md-6">

                                <select id="email_template_name" type="text"
                                    class="form-control @error('email_template_name') is-invalid @enderror"
                                    name="email_template_name" form="email_send" onblur="blurFunction()" value="{{ old('email_template_name') }}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Email Template
                                        Name --
                                    </option>
                                    <option value="hello">Hello</option>
                                    <option value="brand_ambassador_invite">Brand Ambassador Invite</option>
                                    <option value="newsletter">Newsletter</option>
                                    <option value="change_in_terms_and_conditions">Change In Terms & Conditions</option>
                                    <option value="order_shipped">Order Shipped</option>
                                    <option value="feature_request_complete">Feature Request Completion</option>
                                </select>

                                @error('email_template_name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Button: Show --}}
                        <div class="form-group row">
                            <label for="email_template_show"
                                class="col-md-4 col-from-label text-md-right">{{ __('Show Email Template:')}}</label>

                            <div class="col-md-6">
                                <button type="submit" form="email_template_show" class="btn btn-outline-dark">
                                    {{ __('Show') }}
                                </button>
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-from-label text-md-right">{{ __('Subject:')}}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}">

                                @error('subject')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Address From --}}
                        <div class="form-group row">
                            <label for="address_from"
                                class="col-md-4 col-from-label text-md-right required">{{ __('Send From:')}}</label>

                            <div class="col-md-6">

                                <select id="address_from" type="text"
                                    class="form-control @error('address_from') is-invalid @enderror" name="address_from"
                                    onblur="blurFunction()" value="{{ old('address_from') }}" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Sender Address --
                                    </option>
                                    <option value="haise@duftunddu.com">Haise</option>
                                    <option value="no-reply@duftunddu.com">No Reply</option>
                                    <option value="customer_support@duftunddu.com">Customer Support</option>
                                    <option value="test-no-reply@duftunddu.com">Test</option>
                                    <option value="newsletter@duftunddu.com">Newsletter</option>
                                    <option value="ceo-no-reply@duftunddu.com">CEO</option>
                                </select>

                                @error('address_from')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Address To Primary --}}
                        <div class="form-group row">
                            <label for="address_to"
                                class="col-md-4 col-from-label text-md-right">{{ __('Send To:')}}</label>

                            <div class="col-md-6">

                                <select id="address_to" type="text"
                                    class="form-control @error('address_to') is-invalid @enderror" name="address_to"
                                    form="email_send" onblur="blurFunction()" value="{{ old('address_to') }}">
                                    <option value="" selected="selected" disabled="disabled">-- Select Receiver Address
                                        Name --
                                    </option>
                                    <option value="newsletter">Subscribed To Newsletter</option>
                                    <option value="all_users">All Users</option>
                                    <option value="feature_request_complete">Feature Request Complete</option>
                                </select>

                                @error('address_to')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Address To Secondary --}}
                        <div class="form-group row">
                            <label for="address_to_sec" class="col-md-4 col-from-label text-md-right">{{ __('Address To Secondary:')}}</label>

                            <div class="col-md-6">
                                <input id="address_to_sec" type="text" class="form-control @error('address_to_sec') is-invalid @enderror" name="address_to_sec" value="{{ old('address_to_sec') }}">

                                @error('address_to_sec')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="demo" id="demo" name="demo">
                        </div> --}}

                    </div><br>

                    {{-- Button: Submit --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" form="email_send" class="custom">
                                <span class="before">{{_('Submit')}}</span>
                                <span class="after">{{_('Submit')}}</span>
                            </button>
                        </div>
                    </div><br>

                </div>


            </form>
        </div>
    </div>
</div>

{{-- To Show Email Template --}}
<script>
    function blurFunction() {
        var temp = document.getElementById("email_template_name").value;
        document.getElementById("email_template").value = temp;
        document.getElementById("email_template").value;

        // temp2 = document.getElementById("email_template").value;
        // document.getElementById("demo").innerHTML = temp2;
    }
</script>

@endsection