@push('head_scripts')
{{-- Uses jqeury too. Currently, the jquery comes from the preloader. --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" defer></script>

<link href="{{ asset('css/feature_slider_brand_ambassador.css') }}" rel="stylesheet">
<script src="{{ asset('js/feature_slider_brand_ambassador.js') }}"></script>
@endpush

<div id="tabs">
    <ul id="accordion">
        <li>
            <a class="active" href="#tabs-1">
                <div class="tag">
                    <div class="icon" id="icon-1">
                    </div>
                    <span class="heading">Add your Brand to Duft Und Du</span>
                </div>
            </a>
            <div class="addon fadein">
                <span>
                    Add and update all your fragrances to Duft Und Du for increase in sales.
                </span>
            </div>
        </li>
        <li>
            <a href="#tabs-2">
                <div class="tag">
                    <div class="icon" id="icon-2">
                    </div>
                    <span class="heading">Track your Brand</span>
                </div>
            </a>
            <div class="addon">
                <span>
                    See how many people have searched for your brand in the past week.
                </span>
            </div>
        </li>
        <li>
            <a href="#tabs-3">
                <div class="tag">
                    <div class="icon" id="icon-3">
                    </div>
                    <span class="heading">Advertise</span>
                </div>
            </a>
            <div class="addon">
                <span>
                    You can also opt to advertise on Duft Und Du.
                </span>
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