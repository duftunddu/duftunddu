@extends('layouts.app')

<title>{{('Add Details | The AI Powered Fragrance Genie')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Button --}}
    <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ url('brand_ambassador_register')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Brand Ambassador Details')}}</div>
                    <div class="card-body">

                        {{-- Explanation --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-2">
                                All fields can be left empty, except LinkedIn Account and Brand Website.<br>
                                Providing full information supports your applicaton for approval.<br>
                                <small>Any suspicious behaviour may result in suspension or terminaton of
                                    account.</small>
                            </div>
                        </div>

                        <br>

                        {{-- Brands --}}
                        <div class="form-group row">
                            <label for="brand_id"
                                class="col-md-4 col-from-label text-md-right">{{ __('Brand Name:')}}</label>
                            <div class="col-md-6">

                                <select id="brand_id" type="number"
                                    class="form-control @error('brand_id') is-invalid @enderror" name="brand_id"
                                    value="{{ old('brand_id')}}">
                                    <option value="" selected="selected" disabled="disabled">-- Select Brand --</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Brand Not Found Checkbox --}}
                        <div class="form-group row">
                            <label for="brand_not_found"
                                class="col-md-4 col-from-label text-md-right">{{ __('If your brand is not in the list, check this:')}}</label>

                            <div class="col-md-6">
                                <input type="checkbox" name="checkbox" id="checkbox" value="scheckbox" />
                            </div>
                        </div>

                        {{-- New Brand Name --}}
                        <div class="form-group row" id="showthis" name="showthis">
                            <label for="name"
                                class="col-md-4 col-from-label text-md-right">{{ __('New Brand Name:')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Brand Name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name')}}">

                                @error('name')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Work Email --}}
                        <div class="form-group row">
                            <label for="email_work"
                                class="col-md-4 col-form-label text-md-right">{{ __('Add your work email') }}</label>

                            <div class="col-md-6">
                                <input id="email_work" type="email" placeholder="xyz@organization.com"
                                    class="form-control @error('email_work') is-invalid @enderror" name="email_work"
                                    value="{{ old('email_work') }}">
                                @error('email_work')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- LinkedIn --}}
                        <div class="form-group row">
                            <label for="linkedin"
                                class="col-md-4 col-from-label text-md-right">{{ __('LinkedIn Account:')}}</label>
                            <div class="col-md-6">
                                <input id="linkedin" type="url" pattern="https?://www.linkedin.com.*"
                                    placeholder="https://www.linkedin.com/in/xyz"
                                    class="form-control @error('linkedin') is-invalid @enderror" name="linkedin"
                                    value="{{ old('linkedin')}}" required>

                                @error('linkedin')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Brand Website --}}
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-from-label text-md-right">{{ __('Brand Website:')}}
                            </label>

                            <div class="col-md-6">
                                <input id="website" type="url" pattern="https?://.*"
                                    placeholder="https://www.chanel.com"
                                    class="form-control @error('website') is-invalid @enderror" name="website"
                                    value="{{ old('website')}}" required>

                                @error('website')
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
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('div[name="showthis"]').hide();

        //show it when the checkbox is clicked
        $('input[name="checkbox"]').on('click', function () {
            if ($(this).prop('checked')) {
                $('div[name="showthis"]').fadeIn();
            } else {
                $('div[name="showthis"]').fadeOut();
            }
        });
    });
</script>

@endsection