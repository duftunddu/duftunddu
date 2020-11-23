<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The Fragrance Hub. Get Personalized Fragrance Insights.">
        <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
        
        <title>Duft Und Du | The Fragrance Hub</title>

        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

        {{-- Typing Effect --}}
        <link href="{{ asset('css/typing_effect.css') }}" rel="stylesheet">
        <script src="{{ asset('js/typing_effect.js') }}" defer></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
        
        {{-- <link href="{{ asset('css/scroll_down_button.css') }}" rel="stylesheet" defer>
        <script src="{{ asset('js/scroll_down_button.js') }}" defer></script> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" defer>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        
        {{-- <!-- Styles -->
        <style>

        </style> --}}

    </head>

    <body>

        @include('layouts.preloader')
        
        @include('layouts.header')

        <div class="flex-1-center position-ref">

            <div class="content">
                <br>
                
                <div class="title m-b-md">
                    <div data-toggle="tooltip" data-placement="top" title="German For Fragrance And You">Duft Und Du</div>
                </div>

                <div class="heading m-b-md">
                    <span class="item">&nbsp;</span>
                    <div class="wrapper">

                        <div data-text></div>
                        <span class="item">The Fragrance Hub</span>
                        <span class="item">AI Powered Genie</span>
                        <span class="item">Smell Good, Feel Good</span>
                    
                    </div>
                </div>

                <br>

                <div class="links">

                    <h2 class="like-links">{{_('Lets grant your wish to smell good ')}}</h2><br><br>

                    <a href="search_engine"><h2>{{_('Fragrance Search')}}</h2></a><br><br>
                    
                    <h2 class="like-links">Fragrance Genie<br>Coming Soon</h2>

                    <br><br>
                    
                    <h2 class="like-links grey-color">{{_('PREMIUM FEATURES COMING SOON')}}</h2>
                    
                </div>

            </div>

        </div>
        
        <div class="flex-2-left position-ref full-height">
            <div class="flex-2-placement">
                
                <div class="flex-2-heading">
                    Discover
                </div>
                <div class="flex-2-body">
                    Find the fragrance you want on our <a href="search_engine">Search Engine</a> and check similar fragrances.
                    {{-- [add picture on hover] --}}
                    {{-- Find the fragrance you want on our Search Engine and check similar fragrances. --}}
                </div>

                <div class="flex-2-heading">
                    Smell Your Best
                </div>
                <div class="flex-2-body">
                    ●	Check if a fragrance suits you on the <a href="search_engine">Search Engine</a><br>
                    ●	Get fragrance suggestions based on your preferences with our Genie | Coming Soon.<br>
                    {{-- [add picture on hover] --}}
                    ●	Find your perfect scent for every occasion | Coming Soon.<br>
                    Always smell your best.
                </div>

                <div class="flex-2-heading">
                    Get Your Loved Ones The Perfect Gift
                </div>
                <div class="flex-2-body">
                    Use Genie Gift Cards to get fragrance recommendations for your loved ones | Coming Soon.
                    {{-- [add picture on hover] --}}
                </div>
                
                <div class="flex-2-heading">
                    Get Insights
                </div>
                <div class="flex-2-body">
                    Become a Brand Ambassador to see the details of your brand and add your latest fragrances.<br>
                    Registered Brand Ambassadors can also get access to valuable customer insight. <a href="brand_ambassador_proposal">Learn More</a>.
                    {{-- [add picture on hover] --}}
                </div>

            </div>
        </div>

        <div class="flex-3-center position-ref full-height">
            @include('features.feature_slider')
        </div>

        <div class="flex-4-right position-ref full-height">
            @include('forms.about_us_content')
        </div>

        <div class="footer-pad">
            @include('layouts.footer')
        </div>


    </body>

</html>