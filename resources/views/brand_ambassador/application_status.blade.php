@extends('layouts.app')

<title>{{_('Application Status | The Fragrance Hub | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

<style>
    .center{
        display: block;
        margin:0 auto;
    }
</style>


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Application Status')}}</div>

                <div class="card-body">

                    {{-- Status = 0 --}}
                    @if($ambassador->status == 0)
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Status:')}}</label>

                        <div class="col-md-6">
                            {{__('Your profile is under the verificaiton process.')}}
                        </div>
                    </div>

                    {{-- Status = 1 --}}
                    @elseif($ambassador->status == 1)
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Status:')}}</label>

                        <div class="col-md-6">
                            {{__('Your profile is verified.')}}
                        </div>
                    </div>

                    @hasrole('new_brand_ambassador')
                    <div class="form-group row">
                        <div class="center">
                            <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('brand_entry' ) }}'">
                                {{ __('Add Brand') }}
                            </button>
                        </div>
                    </div>
                    @endhasrole

                    {{-- Status = 2 --}}
                    @elseif($ambassador->status == 2)
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Status:')}}</label>

                        <div class="col-md-6">
                            {{__('Your Brand is under the reviewing process.')}}
                        </div>
                    </div>

                    @else
                    {{-- Status = 3 --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Status:')}}</label>

                        <div class="col-md-6">
                            {{__('Your application is Rejected.')}}
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    @endsection