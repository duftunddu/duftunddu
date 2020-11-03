@extends('layouts.app')

<title>{{__($fragrance->name)}} {{(' | Duft Und Du')}}</title>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{'Fragrance: '}} {{ __($fragrance->name)}}</div>
                <div class="card-body">

                    <div class="col-md-9">

                        <h4>Type: {{$type->name}}</h4>
                        <h4>Gender: {{$fragrance->gender}}</h4>
                        <h4>Cost: {{$fragrance->cost}} {{$fragrance->currency}}</h4>
                        <br>
                        <h4>Accords:</h4>

                        @foreach($accords as $accord)
                            <h5>{{$accord->name}}</h5>
                        @endforeach
                        
                        <br>

                        <h4>Notes:</h4>
                        @foreach($notes as $note)
                            <h5>{{$note->name}}</h5>
                        @endforeach
                        
                        <br>

                        <p>Added on {{$fragrance->created_at->format('d/M/y')}}</p>
                        
                        
                        @if($allow_edit)
                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-0">
                                <button type="submit" class="btn btn-outline-dark"  onclick="window.location='{{ url('fragrance_edit/'.$fragrance->id) }}'">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                        @endif

                        @if($logged_in)

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection