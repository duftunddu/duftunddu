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
                <input type="hidden" id="email_template" name="email_template" value="" />

            </form>
            <form method="POST" id="email_send" action="{{ url('/email_send')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Send Email')}}</div>

                    <div class="card-body">

                        {{-- Email Template Name --}}
                        <div class="form-group row">
                            <label for="email_template_name"
                                class="col-md-4 col-from-label text-md-right">{{ __('Email Template Name:')}}</label>

                            <div class="col-md-6">

                                <select id="email_template_name" type="text"
                                    class="form-control @error('email_template_name') is-invalid @enderror"
                                    name="email_template_name" required form="email_send" onblur="blurFunction()">
                                    <option value="" selected="selected" disabled="disabled">-- Select Email Template
                                        Name --
                                    </option>
                                    <option value="hello">Hello</option>
                                    <option value="change_in_terms_and_conditions">Change In Terms & Conditions</option>
                                    <option value="order_shipped">Order Shipped</option>
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

                        {{-- Address From --}}
                        <div class="form-group row">
                            <label for="address_from"
                                class="col-md-4 col-from-label text-md-right">{{ __('Send From:')}}</label>

                            <div class="col-md-6">

                                <select id="address_from" type="text"
                                    class="form-control @error('address_from') is-invalid @enderror"
                                    name="address_from" onblur="blurFunction()" required>
                                    <option value="" selected="selected" disabled="disabled">-- Select Sender Address --
                                    </option>
                                    <option value="haise@duftunddu.com">Haise</option>
                                    <option value="customer_support@duftunddu.com">Customer Support</option>
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

                        {{-- Address To --}}
                        <div class="form-group row">
                            <label for="address_to"
                                class="col-md-4 col-from-label text-md-right">{{ __('Send To:')}}</label>

                            <div class="col-md-6">

                                <select id="address_to" type="text"
                                    class="form-control @error('address_to') is-invalid @enderror"
                                    name="address_to" required form="email_send" onblur="blurFunction()">
                                    <option value="" selected="selected" disabled="disabled">-- Select Receiver Address
                                        Name --
                                    </option>
                                    <option value="newsletter_users">Users Subscribed To Newsletter </option>
                                    <option value="all_users">All Users</option>
                                    {{-- <option value="all_users">All Users</option> --}}
                                </select>

                                @error('address_to')
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