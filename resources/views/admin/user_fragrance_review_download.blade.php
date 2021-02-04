@extends('layouts.app')

@section('content')
<table class="table table-striped">
  <thead>
    <th>ID</th>
    <th>review Name</th>
    <th>Series</th>
    <th>Lead Actor</th>
    <th>Weather Description</th>
  </thead>
  <tbody>
    @foreach($reviews as $review)
    <tr>
        <td>{{$review->id}}</td>
        <td>{{$review->longevity}}</td>
        <td>{{$review->suitability}}</td>
        <td>{{$review->sustainability}}</td>
        <td>{{$review->weather_description}}</td>
        {{-- <td><a href="{{action('DisneyplusController@export')}}">Export</a></td> --}}
    </tr>
    @endforeach
  </tbody>
</table>
<br>
<a href="{{ action('Admin_Controller@user_fragrance_review_export') }}">Export</a>

@endsection