{{-- @extends('layouts.app') --}}

<title>Feature Slider</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" defer></script>

<link href="{{ asset('css/feature_slider.css') }}" rel="stylesheet">
<script src="{{ asset('js/feature_slider.js') }}"></script>

<div id="tabs">
  <ul id="accordion">
    <li>
      <a class="active" href="#tabs-1">   <div class="tag">
          <div class="icon">
            <div class="block">
              <div class="circle"></div>
            </div>
          </div>
          <span class="heading">Feature One</span>
        </div>
      </a>
        <div class="addon fadein">
          <span>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
          </span>
          <a class="para-a" href="#">Learn More</a>
        </div>
    </li>
    <li>
      <a href="#tabs-2">   <div class="tag">
          <div class="icon">
            <div class="block">
              <div class="circle"></div>
            </div>
          </div>
          <span class="heading">Feature Two</span>
        </div>
      </a>
        <div class="addon">
          <span>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
          </span>
          <a class="para-a" href="#">Learn More</a>
        </div>
    </li>
    <li>
      <a href="#tabs-3">   <div class="tag">
          <div class="icon">
            <div class="block">
              <div class="circle"></div>
            </div>
          </div>
          <span class="heading">Feature Three</span>
        </div>
      </a>
        <div class="addon">
          <span>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
          </span>
          <a class="para-a" href="#">Learn More</a>
        </div>
    </li>
  </ul>
  <div class="browser">
    <div class="top-bar">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
    <div id="tabs-1"></div>
    <div id="tabs-2"></div>
    <div id="tabs-3"></div>
  </div>
</div>