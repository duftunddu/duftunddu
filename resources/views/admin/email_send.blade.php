@extends('layouts.app')

<title>{{_('Send Email | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

{{-- Button --}}
<link href="{{ asset('css/custom_button.css') }}" rel="stylesheet">

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ url('/send_mail')}}">
                    @csrf

                <div class="card">
                    <div class="card-header">{{ __('Send Email')}}</div>
                    
                    <div class="card-body">
                        
                        
                    </div>
                </div>
                
                {{-- Button: Submit --}}
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="custom">
                            <span class="before">{{_('Submit')}}</span>
                            <span class="after">{{_('Submit')}}</span>
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>

@endsection
