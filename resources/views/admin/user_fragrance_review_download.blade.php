@extends('layouts.app')

@section('content')
<table class="table table-striped">
  <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Series</th>
    <th>Lead Actor</th>
    <th>Weather Description</th>
  </thead>
  <tbody>
    @foreach($all as $one)
    <tr>
        <td>{{$one->id}}</td>
        <td>{{$one->longevity}}</td>
        <td>{{$one->suitability}}</td>
        <td>{{$one->sustainability}}</td>
        <td>{{$one->weather_description}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<br>
<a href="{{ action('Admin_Controller@user_fragrance_review_export') }}">Export</a>

@endsection