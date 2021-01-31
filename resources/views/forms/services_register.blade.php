@extends('layouts.app')

<title>{{_('Register your Services | The Fragrance Hub | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Styles --}}
    <link href="{{ asset('css/services_register.css') }}" rel="stylesheet">

    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
</head>


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header">{{ __('Register Services')}}</div>
                    <form method="POST" action="{{ url('/services_register')}}">
                        @csrf
    
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="para col-md-9">

                                <h5>Please select one.</h5><br>
                                <h5>I have a...</h5>

                                <div class="align-below">
                                    <input type="checkbox" name="brand" id="brand" />
                                    <label for="brand">Brand</label> 
                                    <a href="{{ url('/brand_ambassador_proposal') }}" class="details">(info)</a>
                                <br>

                                    <input type="checkbox" name="shop" id="shop" />
                                    <label for="shop">Shop</label>
                                <a href="{{ url('/store_proposal') }}" class="details">(info)</a>
                                <br>

                                    <input type="checkbox" name="online_store" id="online_store" />
                                    <label for="online_store">Online Store</label>
                                    <a href="{{ url('/webstore_proposal') }}" class="details">(info)</a>
                                    <br>
                                </div>

                            </div>
                        </div>
                        
                        <br>
                        
                        {{-- Button: Submit --}}
                        <div class="form-group row mb-0">
                            <div class="center">
                                <button type="submit" class="custom">
                                    <span class="before">{{_('Next')}}</span>
                                    <span class="after">{{_('Next')}}</span>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
