{{-- Uses jqeury too. Currently, the jquery comes from the preloader. --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" defer></script>

<link href="{{ asset('css/feature_slider_store_proposal.css') }}" rel="stylesheet">
<script src="{{ asset('js/feature_slider_brand_ambassador.js') }}"></script>

<div id="tabs">
    <ul id="accordion">
        <li>
            <a class="active" href="#tabs-1">
                <div class="tag">
                    <div class="icon" id="icon-1">
                    </div>
                    <span class="heading">Add your Shop to Duft Und Du</span>
                </div>
            </a>
            <div class="addon fadein">
                <span>
                    Show Personalized Fragrance Reviews to customers right from your shop without having them to sign up.
                </span>
            </div>
        </li>
        <li>
            <a href="#tabs-2">
                <div class="tag">
                    <div class="icon" id="icon-2">
                    </div>
                    <span class="heading">Check Trends</span>
                </div>
            </a>
            <div class="addon">
                <span>
                    See which fragrances are popular and compare with your stock.
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
                    You can also opt to advertise your business on Duft Und Du.
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