<link href="{{ asset('css/button_hold_to_confirm.css') }}" rel="stylesheet">

<button class="button-hold">
  <div>
      <svg class="progress" viewBox="0 0 32 32">
          <circle r="8" cx="16" cy="16" />
      </svg>
      <svg class="tick" viewBox="0 0 24 24">
          <polyline points="18,7 11,16 6,12" />
      </svg>
  </div>
  <ul>
      <li>Check Out</li>
      <li>Sure ?</li>
      <li>Done</li>
  </ul>
</button>

<script src="{{ asset('js/button_hold_to_confirm.js') }}"></script>