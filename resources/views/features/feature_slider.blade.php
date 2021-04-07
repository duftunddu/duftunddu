{{-- Uses Jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" defer></script>

<link href="{{ asset('css/feature_slider.css') }}" rel="stylesheet">
<script src="{{ asset('js/feature_slider.js') }}"></script>

<div id="tabs">
  <ul id="accordion">
    <li>
      <a class="active" href="#tabs-1">   <div class="tag">
          <div class="icon" id="icon-1">
            {{-- <div class="block">
              <div class="circle"></div>
            </div> --}}
          </div>
          <h4>Our Team</h4>
        </div>
      </a>
        <div class="addon fadein">
          <span>
            Comprised of people with diverse backgrounds, our team ensures that you get the best user experience.
          </span>
          {{-- <a class="para-a" href="#">Learn More</a> --}}
        </div>
    </li>
    <li>
      <a href="#tabs-2">   <div class="tag">
          <div class="icon" id="icon-2">
            {{-- <div class="block">
              <div class="circle"></div>
            </div> --}}
          </div>
          <h4>Innovating</h4>
        </div>
      </a>
        <div class="addon">
          <span>
            Our creative team is always collaborating with brands for innovation.
          </span>
          {{-- <a class="para-a" href="#">Learn More</a> --}}
        </div>
    </li>
    <li>
      <a href="#tabs-3">   <div class="tag">
          <div class="icon" id="icon-3">
            {{-- <div class="block">
              <div class="circle"></div>
            </div> --}}
          </div>
          <h4>Maximizing Accuracy</h4>
        </div>
      </a>
        <div class="addon">
          <span>
            {{-- We are always researching and improving our practices of how we approach fragrances to maximize the accuracy of our Genie, who is quite active on Twitter. --}}
            {{-- We are always trying to maximize the accuracy of our Genie, who is quite active on Twitter. --}}
            We are always trying to maximize the accuracy of our Genie.
          </span>
          {{-- <a class="para-a" href="#">Learn More</a> --}}
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