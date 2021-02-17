@extends('layouts.app')

<title>{{('Add Fragrance To Stock | The Fragrance Hub | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Scripts --}}
    <link href="{{ asset('css/add_to_stock.css') }}" rel="stylesheet" defer>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ url('/add_to_stock')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Add Fragrance To Stock')}}&nbsp;&nbsp; <i class="fas fa-info"
                            data-toggle="tooltip" data-placement="top" data-html="true" title="Only you can see your stock."></i></div>

                    <div class="card-body">

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
                        
                        <br>

                        {{-- Button: Submit --}}
                        <div class="form-group row mb-0">
                            <div class="center">
                                <button type="submit" class="custom">
                                    <span class="before">{{_('Submit')}}</span>
                                    <span class="after">{{_('Submit')}}</span>
                                </button>
                            </div>
                        </div><br>

                        {{--  Button: Add Fragrance --}}
                        <div class="form-group row mb-0">
                            <div class="center">
                                <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/stock') }}'">
                                    Back To Stock
                                </button>                        
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection