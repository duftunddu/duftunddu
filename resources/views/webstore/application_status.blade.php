@extends('layouts.app')

<title>{{_('Application Status For Store | The Fragrance Hub | Duft Und Du')}}</title>

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

                    {{-- If Approved, the user is redirected to their Dashboard via the Controller before arriving here --}}

                    {{-- Status = NULL --}}
                    @if( is_null($store->request_status) )
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">Status:</label>

                        <div class="col-md-6">
                            Your request is under the verificaiton process. It will be reviewed shortly.
                        </div>
                    </div>

                    {{-- Status = Rejected --}}
                    @else
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Status:')}}</label>

                        <div class="col-md-6">
                            Your request is Rejected. For possible reasons, read our <a href="{{ url('/faq') }}">FAQ</a>.
                            <br>
                            For further inquiry, you can mail us at <a href="mailto:customer-support@duftunddu.com">customer support</a>.<br>
                            The response might take some time as inquiries take time to process.
                        </div>

                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection