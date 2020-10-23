<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Duft Und Du | The Fragrance Hub</title>

        {{-- Typing Effect --}}
        <link href="{{ asset('css/typing_effect.css') }}" rel="stylesheet">
        <script src="{{ asset('js/typing_effect.js') }}" defer></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        <link href="{{ asset('css/scroll_down_button.css') }}" rel="stylesheet" defer>
        <script src="{{ asset('js/scroll_down_button.js') }}" defer></script>


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
            }

            .full-height {
                height: 100%;
            }

            .flex-1-center {
                background-image: url("../images/fragrance_model/laura-chouette-YGuaaoNnv3c-unsplash_use2.jpg");
                /* background-attachment: fixed; */
                background-size: cover;
                background-repeat: no-repeat;
                background-position: top right;
                /* background-position: -2000px -3450px; */
                background-size: 50%;

                align-items: left;
                display: flex;
                justify-content: left;
                /* padding-top: 7.73vw; */
                padding-left: 10.1vw;
            }

            .flex-2-left {
                background-image: url('../images/fragrance_model/laura-chouette-o7BEFNmuDkU-unsplash_use.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
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
                font-size: 2.3vw;
                font-weight: 100;
                font-variant: small-caps;
                color: #89163f;
                /* color: #571b34; */
                /* color: #220e19; */
            }
            .flex-2-body{
                font-size: 1.3vw;
                font-weight: 100;       
                color: #e8e7ec;
                /* color: #571b34; */
                /* color: #2e1524; */
                /* color: rgb(0, 255, 255);  */
                /* mix-blend-mode/: difference; */
                /* mix-blend-mode:  */
            }

            .flex-3-center {
                
                /* background-image: url('../images/others/luca-bravo-9l_326FISzk-unsplash_use.jpg'); */
                /* background-attachment: fixed; */
                /* background-size: cover; */
                /* background-repeat: no-repeat;
                background-size: 100% 100%; */
                background-color: #FEFFFEEE;

                align-items: left;
                display: flex;
                justify-content: left;
                /* padding-top: 7.73vw; */
                padding-left: 1vw;
            }

            /* .flex-4-right {
                background-image: url('../images/others/laura-chouette-j_qackZwDIU-unsplash-edited-enhanced_use.jpg');
                background-size: cover;
                background-repeat: no-repeat; 
                background-position: left center;
                background-attachment: fixed;
            }
            .flex-4-placement{
                text-align: center;
                align-items: right;
                justify-content: right;
                margin-left: 45%;
                margin-right: 3%;
                padding-top: 3%;
                display: flex;
            }
            .flex-4-heading{
                font-size: 3.5vw;
                font-weight: 100;
                font-variant: small-caps;
                color: #89163f;
            }
            .flex-4-body{
                font-size: 2vw;
                font-weight: 100;
                color: #e8e7ec;
            } */

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
                font-size: 6.1vw;
                letter-spacing: 1px;
                font-family: 'Cinzel', serif;
                /* background:rgba(255,255,255,0.1);  */
            }

            .heading{
                font-size: 1.1vw;
                text-align: center;
                /* font-family: 'Cinzel Decorative', cursive; */
            }

            h1{
                letter-spacing: 0.2vw;
            }

            p{
                font-size: 1.6vw;
                font-weight: bold;
                letter-spacing: 0.06vw;
            }

            .links > a {
                /* padding: 0 1.88vw; */
                font-size: 0.98vw;
                font-weight: 600;
                letter-spacing: 0.12vw;
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
                margin-bottom: 2.26vw;
            }

        </style>

    </head>

    <body>
        
        @include('layouts.header')

        <div class="flex-1-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Duft Und Du
                </div>

                <div class="heading m-b-md">
                    <h1>
                        <div class="wrapper">
 
                            <div data-text></div>
                            <span class="item">The Fragrance Hub</span>
                            <span class="item">AI Powered Genie</span>
                            <span class="item">Smell Good, Feel Good</span>
                      
                        </div>
                    </h1>
                </div>

                <br>

                <div class="links">

                    <a><h2>{{_('Lets grant your wish to smell good ')}}</h2></a>
                    
                    <p>{{_('The only stop you will make today')}}
                        <br>{{_('which you will like based on your preferences')}}
                        <br>{{_('Talk to the Genie and get your wish granted')}}</p>

                    <br>
                    
                    <a href="{{ url('catalog')}}"><h2>{{_('sds')}}</h2>                        
                    <h2> {{_('Browse our Catalog of Services')}}</h2></a>    
                    
                    <p>{{_('Search through all the fragrances and brands with their composition')}}
                        <br>{{_('Apply for Advetisements & Brand Ambassadors')}}</p>
    
                    <br><br>
                    
                    <a><h2 style="color: #636b6f">{{_('PREMIUM FEATURES COMING SOON')}}</h2></a>
                    
                    <br>
                    
                    <a href="{{ url('about_us')}}"><h2>{{_('About Us')}}</h2></a>

                </div>

            </div>

        </div>
        
        <div class="flex-2-left position-ref full-height">
            <div class="flex-2-placement">
                
                <div class="flex-2-heading">
                    Discover
                </div>
                <div class="flex-2-body">
                    Find the fragrance you want on our Search Engine and check similar fragrances.
                    {{-- [add picture on hover] --}}
                </div>

                <div class="flex-2-heading">
                    Smell Your Best
                </div>
                <div class="flex-2-body">
                    ●	Check if a fragrance suits you.<br>
                    ●	Get fragrance suggestions based on your preferences with our Genie (Coming Soon).<br>
                    {{-- [add picture on hover] --}}
                    ●	Find your perfect scent for every occasion (Coming Soon).<br>
                    Always smell your best.
                </div>

                <div class="flex-2-heading">
                    Get Your Loved Ones The Perfect Gift
                </div>
                <div class="flex-2-body">
                    Use Gift Cards [add picture on hover] to get fragrance recommendations for your loved ones. Learn More. 
                </div>
                
                <div class="flex-2-heading">
                    Get Insights
                </div>
                <div class="flex-2-body">
                    Become a Brand Ambassador to see the details of your brand and add your latest fragrances.<br>
                    Registered Brand Ambassadors can also get access to valuable customer insight.[add picture on hover] Learn More.
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