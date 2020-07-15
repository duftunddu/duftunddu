<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{('Duft Und Du')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 130vh;
            }

            .flex-center1 {
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.73vw;
                padding-left: 10.1vw;
            }

            .flex-center2 {
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.73vw;
                padding-left: 10.1vw;
            }
            
            .flex-center3 {
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.73vw;
                padding-left: 10.1vw;
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
                font-size: 6.3vw;
                /* background:rgba(255,255,255,0.1);  */
            }

            .links > a {
                /* padding: 0 1.88vw; */
                font-size: 0.98vw;
                font-weight: 600;
                letter-spacing: 0.12vw;
                text-decoration: none;
                text-transform: uppercase;
                color:#905969;
            }

            .flex-center1{
                background-image: url("../images/welcome_div1.jpg");
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: 0vw -13.2vw;
                /* background-size: 100% 100%; */
                
            }

            .flex-center2{
                background-image: url('https://industry.ehl.edu/hubfs/HI_Blog%20Header%20Pictures/AI_in_recruitment.jpg');
                background-attachment: fixed;
                /* background-size: cover; */
                /* background-repeat: no-repeat; */
                /* background-size: 100% 100%; */
            }

            .flex-center3{
                background-image: url('https://cdn.shopify.com/s/files/1/1600/9217/products/Gem-Cut-Decanter-Detail.jpg?v=1498771896');
                background-attachment: fixed;
                /* background-size: cover; */
                /* background-repeat: no-repeat;
                background-size: 100% 100%; */
            }

            .heading{
                font-size: 1.3vw;
            }

            h1{
                letter-spacing: 0.2vw;
            }

            p{
                font-size: 1.45vw;
                font-weight: bold;
                letter-spacing: 0.06vw;
            }

            .m-b-md {
                margin-bottom: 2.26vw;
            }

        </style>

    </head>
    
    <body>
        <div class="flex-center1 position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{_('Duft Und Du')}}
                </div>

                <div class="heading m-b-md">
                    <h1>{{_('The AI Powered Fragrance Genie')}}</h1>
                </div>

                <br>

                <div class="links">

                    <a><h2>{{_('Lets grant your wish to smell good ')}}
                        <br>{{_('Lets grant your wish to smell good ')}}
                    
                    
                    </h2></a>
                    
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
        
        <div class="flex-center2 position-ref full-height">
            <h1>Lol</h1>
        </div>

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

    </body>

</html>
