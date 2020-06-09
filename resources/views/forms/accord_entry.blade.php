@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ url('accord_entry')}}">
                    @csrf

                    <div class="card">
                        <div class="card-header">{{ __('Accord Entry')}}</div>

                        <div class="card-body">

                            {{-- Name --}}
                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        


                            {{-- Button: Add Another --}}
                            {{-- <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="add another" class="btn btn-secondary">
                                        {{ __('Add Another') }}
                                    </button>
                                </div>
                            </div> --}}


                            {{-- Button: Add Another --}}
                            {{-- <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="wrapper">
                                        <button onclick = "createDiv()" type="add another" >
                                            class="btn btn-secondary"
                                            {{ __('Add Another') }}
                                            <button onclick="createDiv()" style="margin:auto">Add Room +</button>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}

                            <br>

                            {{-- Button: Submit --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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

{{-- <script>
    function createDiv() {
        var div = document.createElement('div');
        div.setAttribute('class', 'form-group row');
        div.innerHTML = document.getElementById('name').innerHTML;
        document.getElementById("form").appendChild(div);
    }
</script> --}}

{{-- Name --}}
{{-- <div class="form-group row" style:"display:none;" >
<label for="name" class="col-md-4 col-from-label text-md-right">{{ __('Accord:')}}</label>

<div class="col-md-6">
    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autofocus>

    @error('name')
    <span class="invalid-feeback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div> --}}
