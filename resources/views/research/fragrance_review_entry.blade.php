@extends('layouts.app')

<title>{{('Fragrance Review Entry | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @section('description', "Participate in the research by adding your favourite fragrance review. We appreciate your participation.")

    {{-- Scripts --}}
    <link href="{{ asset('css/fragrance_review_entry.css') }}" rel="stylesheet" defer>

    {{-- Button: Info --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" defer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/solid.min.css" defer>
</head>

@section('content')

{{-- Range Slider Function --}}
<script src="{{ asset('js/range_slider_spray.js') }}" defer></script>
<script src="{{ asset('js/range_slider_projection.js') }}" defer></script>
<script src="{{ asset('js/range_slider_sillage.js') }}" defer></script>
<script src="{{ asset('js/range_slider_like.js') }}" defer></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ url('/fragrance_review_entry')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Fragrance Review Entry')}}&nbsp;&nbsp; <i class="fas fa-info"
                            data-toggle="tooltip" data-placement="top" data-html="true" title="This information is used in your personal insights.
                            <br>For more information, read Privacy Policy."></i></div>

                    <div class="card-body">

                        {{-- Explanation --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-4">
                                <h5 class="lux-red">We appreciate your participation.</h5>
                                <small class="de-gray">If you don't understand some word, just tap on it.</small>
                            </div>
                        </div>

                        {{-- Brand --}}
                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-from-label text-md-right required">{{ __('Brand:')}}</label>

                            <div class="col-md-6">
                                <input list="brands" id="brand" type="text" placeholder="-- Enter Brand --"
                                    class="form-control @error('brand') is-invalid @enderror" name="brand"
                                    value="{{ old('brand')}}" required />
                                <datalist id="brands">
                                    @foreach($brands as $brand)
                                    <option value="{{$brand}}"></option>
                                    @endforeach
                                </datalist>

                                @error('brand')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Fragrance --}}
                        <div class="form-group row">
                            <label for="fragrance"
                                class="col-md-4 col-from-label text-md-right required">{{ __('Fragrance:')}}</label>

                            <div class="col-md-6">
                                <input list="fragrances" id="fragrance" type="text" placeholder="-- Enter Fragrance --"
                                    class="form-control @error('fragrance') is-invalid @enderror" name="fragrance"
                                    value="{{ old('fragrance')}}" required />
                                <datalist id="fragrances">
                                    @foreach($fragrances as $fragrance)
                                    <option value="{{$fragrance}}"></option>
                                    @endforeach
                                </datalist>

                                @error('fragrance')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Applying Time --}}
                        <div class="form-group row">
                            <label for="apply_time"
                                class="col-md-4 col-from-label text-md-right required">{{ __('When did you apply it:')}}</label>

                            <div class="col-md-6">

                                <input type="time" data-time-open-on-focus="true" id="apply_time"
                                    class="form-control @error('apply_time') is-invalid @enderror" name="apply_time"
                                    value="{{ old('apply_time')}}" required>

                                @error('apply_time')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Wear Off Time --}}
                        <div class="form-group row">
                            <label for="wear_off_time"
                                class="col-md-4 col-from-label text-md-right required">{{ __('When did if wear off:')}}</label>

                            <div class="col-md-6">

                                <input type="time" id="wear_off_time"
                                    class="form-control @error('wear_off_time') is-invalid @enderror"
                                    name="wear_off_time" value="{{ old('wear_off_time')}}" required>

                                @error('wear_off_time')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Indoor / Outdoor --}}
                        <div class="form-group row">
                            <label for="in_out" class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="What percentage of the time did you spend indoors?">{{ __('Indoor Time Percentage:')}}</label>

                            <div class="col-md-6 suffix percentage">

                                <input id="in_out" type="number" min="0" max="100" placeholder="00"
                                    class="form-control @error('in_out') is-invalid @enderror" name="in_out"
                                    value="{{ old('in_out')}}" required>

                                @error('in_out')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Sprays --}}
                        <div class="form-group row">
                            <label for="spray" class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="How many sprays did you apply?">{{ __('No. of Sprays:')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer-spray">
                                    <input type="range" min="1" max="50" step="1" class="slider spray"
                                        class="form-control @error('spray') is-invalid @enderror" id="spray"
                                        name="spray" value="1" value="{{ old('spray')}}" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                </div>

                                @error('spray')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Projection --}}
                        <div class="form-group row">
                            <label for="projection" class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="How far-off can you smell the scent?<br>In Inches.">{{ __('Projection (inches):')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer-projection">
                                    <input type="range" min="0" max="100" step="0.5" class="slider projection"
                                        class="form-control @error('projection') is-invalid @enderror" id="projection"
                                        name="projection" value="0" value="{{ old('projection')}}" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                </div>

                                @error('projection')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Sillage --}}
                        <div class="form-group row">
                            <label for="sillage" class="col-md-4 col-from-label text-md-right required" data-toggle="tooltip"
                                data-placement="top" data-html="true"
                                title="How long does the trail last?<br>In Seconds.">Sillage (seconds):</label>

                            <div class="col-md-6">

                                <div class="slideContainer-sillage">
                                    <input type="range" min="0" max="100" step="0.5" class="slider sillage"
                                        class="form-control @error('sillage') is-invalid @enderror" id="sillage"
                                        name="sillage" value="0" value="{{ old('sillage')}}" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                </div>

                                @error('sillage')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Like --}}
                        <div class="form-group row">
                            <label for="like"
                                class="col-md-4 col-from-label text-md-right required">{{ __('How much do you like it:')}}</label>

                            <div class="col-md-6">

                                <div class="slideContainer-like">
                                    <input type="range" min="0" max="100" step="1" class="slider like"
                                        class="form-control @error('like') is-invalid @enderror" id="like" name="like"
                                        value="0" value="{{ old('like')}}" onmousemove="like_feedback()" required>
                                    <label>{{_('Value: ')}}<span class="value"></span></label>
                                    <label id="like-feedback" class="col-md-9"></label>
                                </div>

                                @error('like')
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <br>

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
<script src="{{ asset('js/fragrance_review_entry.js') }}" defer></script>
@endsection