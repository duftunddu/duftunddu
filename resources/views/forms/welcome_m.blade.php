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
        
        <link href="{{ asset('css/scroll_down_button.css') }}" rel="stylesheet">
        <script src="{{ asset('js/scroll_down_button.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                color: #212529;
                height: 100%;
                margin: 0;
            }

            .full-height {
                height: 100%;
            }

            .flex-center1 {
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
                padding-left: 10.1vh;
            }

            /* .flex-center2 {
                background-image: url('../images/others/guilherme-stecanella-SZ80v2lmhSY-unsplash_genie_use.jpg');
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
                background-size: 100% 100%;
                background-position: center center;
                
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.73vw;
                padding-left: 10.1vw;
            } */
            
            .flex-center3 {
                background-image: url('../images/fragrance_model/laura-chouette-o7BEFNmuDkU-unsplash_use.jpg');
                /* background-attachment: fixed; */
                background-size: cover;
                /* background-repeat: no-repeat; */
                /* background-size: 100% 100%; */
                background-position: center center;

                align-items: left;
                display: flex;
                justify-content: left;
                /* padding-top: 7.73vw; */
                padding-left: 10.1vh;
            }

            .flex-center4 {
                
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
                padding-left: 1vh;
            }

            .flex-center5 {
                background-image: url('../images/others/laura-chouette-j_qackZwDIU-unsplash-edited-enhanced_use.jpg');
                /* background-attachment: fixed; */
                background-size: cover;
                background-repeat: no-repeat; 
                /* background-size: 100% auto;  */
                background-position: left center;

                align-items: left;
                display: flex;
                justify-content: left;
                /* padding-top: 7.73vw; */
                padding-left: 10.1vh;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 0.75vh;
                top: 1.36vh;
            }

            .content {
                text-align: center;
                font-variant: small-caps;
            }

            .title {
                font-size: 6.3vh;
                letter-spacing: 1px;
                font-family: 'Cinzel', serif;
                /* background:rgba(255,255,255,0.1);  */
            }

            .heading{
                font-size: 1.3vh;
                text-align: center;
                /* font-family: 'Cinzel Decorative', cursive; */
            }

            h1{
                letter-spacing: 0.2vh;
            }

            p{
                font-size: 1.45vh;
                font-weight: bold;
                letter-spacing: 0.06vh;
            }

            .links > a {
                /* padding: 0 1.88vw; */
                font-size: 0.98vh;
                font-weight: 600;
                letter-spacing: 0.12vh;
                text-decoration: none;
                text-transform: uppercase;
                color:#905969;
            }

            a:hover {
                color: #905969 !important;
                text-decoration: none !important;
            }


            .m-b-md {
                margin-bottom: 2.26vh;
            }

            /* html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 70vh;
            }

            .flex-center1 {
                background-image: url("../images/welcome_div1.jpg");
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: -8vh -13.2vh;

                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 8.1vh;
                padding-left: 4.7vh;
            }

            .flex-center2 {
                background-image: url('https://industry.ehl.edu/hubfs/HI_Blog%20Header%20Pictures/AI_in_recruitment.jpg');
                background-attachment: fixed;
                /* background-size: cover; */
                /* background-repeat: no-repeat; */
                /* background-size: 100% 100%; */

                /* align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.73vh;
                padding-left: 10.1vh;
            }
            
            .flex-center3 {
                background-image: url('https://cdn.shopify.com/s/files/1/1600/9217/products/Gem-Cut-Decanter-Detail.jpg?v=1498771896');
                background-attachment: fixed;
                /* background-size: cover; */
                /* background-repeat: no-repeat;
                background-size: 100% 100%; */

                /* align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.73vh;
                padding-left: 10.1vh;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 0.75vh;
                top: 1.36vh;
            }

            .content {
                text-align: center;
                font-variant: small-caps;
            }

            .title {
                font-size: 6.3vh;   
            }

            .links > a { */
                /* padding: 0 1.88vh; */
                /* font-size: 0.98vh;
                font-weight: 600;
                letter-spacing: 0.12vh;
                text-decoration: none;
                text-transform: uppercase;
                color:#905969;
            }

            .heading{
                font-size: 1.3vh;
            }

            h1{
                letter-spacing: 0.2vh;
            }

            p{
                font-size: 1.45vh;
                font-weight: bold;
                letter-spacing: 0.06vh;
            }

            .m-b-md {
                margin-bottom: 2.26vh;
            } */

        </style>

    </head>
    <body>
        
        @include('layouts.header')

        <div class="flex-center1 position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{_('Duft Und Du')}}
                </div>

                <div class="heading m-b-md">
                    <h1>
                        <div class="wrapper">
 
                            <div data-text></div>
                            <span class="item">{{_('The Fragrance Hub')}}</span>
                            <span class="item" style="font-family:Cinzel Decorative; color:blue;">{{_('AI Powered Genie')}}</span>
                            <span class="item">{{_('Smell Good, Feel Good')}}</span>
                      
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
        
        {{-- <div class="flex-center2 position-ref full-height">
            <h1>Lol</h1>
        </div> --}}

        <div class="flex-center3 position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{_('Duft Und Du')}}
                </div>

                <div class="heading m-b-md">
                <h1>{{_('The AI Powered Fragrance Genie')}}</h1>
                </div>

                <br>

                <div class="links">

                    <a href="{{ url('genie_input')}}"><h2>{{_('Lets grant your wish to smell good')}}</h2></a>
                    
                    <p>{{_('The AI Powered Fragrance Genie tells you other fragrances')}}
                        <br>{{_('which you will like based on your preferences')}}
                        <br>{{_('Talk to the Genie and get your wish granted')}}</p>

                    <br>
                    
                    <a href="{{ url('catalog')}}"><h2>{{_('')}}</h2>                        
                    <h2> {{_('Browse our Catalog of Services')}}</h2></a>    
                    
                    <p>{{_('Search through all the fragrances and brands with their composition')}}
                        <br>{{_('Apply for Advetisements & Brand Ambassadors')}}</p>
    
                    <br><br>
                    
                
                    <a><h2 style="color: #636b6f;">{{_('PREMIUM FEATURES COMING SOON')}}</h2></a>
                    
                    <br>
                    
                    <a href="{{ url('about_us')}}"><h2>{{_('About Us')}}</h2></a>

                </div>

            </div>
        </div>

        <div class="flex-center4 position-ref full-height">
            @include('features.feature_slider')
        </div>

        <div class="flex-center5 position-ref full-height">
            <h1>Lol</h1>
        </div>

        <div class="footer-pad">
            @include('layouts.footer')
        </div>

    </body>

</html>
