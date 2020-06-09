@extends('layouts.app')

<link href="{{ asset('css/range_slider.css') }}" rel="stylesheet">
<script src="{{ asset('js/range_slider.js') }}" defer></script>

<div class="main">
    <div class="slideContainer">
        <label>Value: <span id="value"></span></label>
            <input type="range" min="0" max="100" value="1" class="slider" id="sweat_id">
    </div>
</div>
  