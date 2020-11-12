<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Duft Und Du | The Fragrance Hub</title>

        {{-- Typing Effect --}}
        <link href="{{ asset('css/typing_effect.css') }}" rel="stylesheet">
        <script src="{{ asset('js/typing_effect.js') }}" defer></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
        
        {{-- <link href="{{ asset('css/scroll_down_button.css') }}" rel="stylesheet" defer>
        <script src="{{ asset('js/scroll_down_button.js') }}" defer></script> --}}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" defer>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                /* font-family: 'Nunito', sans-serif; */
                font-weight: 200;
                color: #212529;
                height: 100%;
                margin: 0;
                font-size:100%;
            }

            .full-height {
                height: 100%;
            }

            .flex-1-center {
                height: 86.5%;
                
                background-image: url("../images/fragrance_model/laura-chouette-YGuaaoNnv3c-unsplash_desktop_usable_use.jpg");
                background-image: url("../images/fragrance_model/laura-chouette-YGuaaoNnv3c-unsplash_desktop_usable_use.webp");
                background-size: cover;
                background-repeat: no-repeat;
                background-position: top right;
                /* background-attachment: fixed; */
                /* background-position: -2000px -3450px; */
                /* background-size: 50%; */

                display: flex;
                align-items: left;
                justify-content: left;
                text-align: center;
                /* padding-top: 7.73vw; */
                /* padding-left: 10.1vw; */
                padding-left: 7.0rem;
            }
            .flex-1-center .heading{
                /* font-size: 3.2vw; */
                font-size: 2.64rem;
                font-weight: 100;
                font-variant: small-caps;
                color: #89163f;
                text-align: center;
                /* color: #571b34; */
                /* color: #220e19; */
            }
            .flex-1-center h2{
                /* font-size: 1.9vw; */
                /* font-size: 25px; */
                font-size: 1.56rem;
            }
            

            .flex-2-left {
                background-image: url('../images/fragrance_model/laura-chouette-o7BEFNmuDkU-unsplash_desktop_big_use.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                /* background-position: center center; */
                background-attachment: fixed;
            }
            .flex-2-placement{
                text-align: left;
                align-items: left;
                justify-content: left;
                margin-right: 55%;
                padding-left: 4%;
                padding-top: 4%;
                padding-bottom:4%;
                /* display: flex; */
                /* padding-top: 7.73vw; */
            }
            .flex-2-heading{
                /* font-size: 2.3vw; */
                font-size: 1.85rem;
                font-weight: 100;
                font-variant: small-caps;
                color: #89163f;
                /* color: #571b34; */
                /* color: #220e19; */
            }
            .flex-2-body{
                /* font-size: 1.4vw; */
                /* font-size: 1.056rem; */
                font-size: 1.15rem;
                font-weight: 100;       
                color: rgb(255, 250, 255);
                /* color: #e8e7ec; */
                /* color: #571b34; */
                /* color: #2e1524; */
                /* color: rgb(0, 255, 255);  */
            }
            .flex-2-body a{
                color: #f7527c;
            }


            .flex-3-center {
                background-color: #FEFFFEEE;
                /* font-size: 1.4vw; */
                font-size: 1.156rem;
                align-items: left;
                display: flex;
                justify-content: left;
                /* padding-left: 1vw; */
                padding-left: 0.83rem;
            }
            .headings  {
                /* font-weight: 100 !important; */
                /* color: #89163f !important; */
                color: #f7527c !important;

            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 0.75vw;
                top: 1.36vw;
            }

            .content {
                text-align: center;
                font-variant: small-caps;
            }

            .title {
                /* font-size: 6.0vw; */
                font-size: 4.96rem;
                letter-spacing: 1px;
                font-family: 'Cinzel', serif;
                /* background:rgba(255,255,255,0.1);  */
            }

            .heading{
                font-size: 0.9rem;
                display: flex;
                justify-content: center;
            }

            h1, h2 {
                /* letter-spacing: 0.2vw; */
                letter-spacing: 3px;
            }

            p{
                /* font-size: 2vw; */
                font-size: 1.65rem;
                font-weight: bold;
                /* letter-spacing: 0.06vw; */
                letter-spacing: 1px;
            }

            .like-links, 
            .links > a {
                /* padding: 0 1.88vw; */
                /* font-size: 0.98vw; */
                font-size: 0.81rem;
                font-weight: 300;
                /* letter-spacing: 0.12vw; */
                letter-spacing: 2px;
                text-decoration: none;
                text-transform: uppercase;
                color: #f7527c;
                /* color: #89163f; */
                /* color:#905969; */
            }

            a:hover {
                color: #905969 !important;
                text-decoration: none !important;
            }

            .m-b-md {
                /* margin-bottom: 2.26vw; */
                margin-bottom: 1.3rem;
            }

            @media (max-width: 535px) {
                .flex-1-center {
                    height: 91%;
                    background-image: url("../images/fragrance_model/laura-chouette-YGuaaoNnv3c-unsplash_use.jpg");
                    background-size: contain;
                    background-position: bottom;
                    background-color: #fafbfb;
                    margin-top: -1.4rem;

                    display: flex;
                    align-items: left;
                    justify-content: left;
                    text-align: center;
                    padding-left: 0;
                    padding: 10px;
                    padding-bottom: 0;
                }
                .flex-1-center .heading{
                    font-size: 2.25rem;
                    font-weight: 100;
                    font-variant: small-caps;
                    color: #89163f;
                    text-align: center;
                }
                .flex-1-center h2{
                    font-size: 1.56rem;
                }
                

                .flex-2-left {
                    background-image: url('../images/fragrance_model/laura-chouette-o7BEFNmuDkU-unsplash_desktop_usable_use.jpg');
                    background-image: url('../images/fragrance_model/laura-chouette-o7BEFNmuDkU-unsplash_desktop_usable_use.webp');
                    /* background-size: cover; */
                    background-repeat: no-repeat;
                    background-attachment: fixed;             
                    background-position: bottom center;
                }
                .flex-2-placement{
                    text-align: left;
                    align-items: left;
                    justify-content: left;
                    margin-right: 20%;
                    padding-left: 4%;
                    padding-top: 12%;
                    padding-bottom:4%;
                    /* display: flex; */
                    /* padding-top: 7.73vw; */
                }
                .flex-2-heading{
                    font-size: 1.7rem;
                }
                .flex-2-body{
                    font-size: 1rem;
                }
                

                .flex-3-center {
                    font-size: 1.076rem;
                    align-items: left;
                    display: flex;
                    justify-content: left;
                    padding-left: 0;
                }

                .title {
                    padding-top: 1.5rem;
                    font-size: 3.4rem;
                }

                .heading{
                    /* font-size: 1.1vw; */
                    font-size: 0.9rem;
                    text-align: center;
                }

                p{
                    /* font-size: 2vw; */
                    font-size: 1.65rem;
                    font-weight: bold;
                    /* letter-spacing: 0.06vw; */
                    letter-spacing: 1px;
                }

                .links > a {
                    font-size: 0.81rem;
                    font-weight: 600;
                    letter-spacing: 2px;
                    text-decoration: none;
                    text-transform: uppercase;
                    color: #f7527c;
                }
            }

        </style>

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

                    <a href="search_engine"><h2>{{_('Fragrance Search')}}</h2></a><br>
                    <h2 class="like-links">{{_('Fragrance Genie')}}</h2>
                    <h2 class="like-links">{{_('Coming Soon')}}</h2>

                    <br><br>
                    
                    <h2 class="like-links" style="color: #636b6f">{{_('PREMIUM FEATURES COMING SOON')}}</h2>
                    
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