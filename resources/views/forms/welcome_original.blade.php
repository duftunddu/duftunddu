<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<style>

    div{
        background-image: url('https://cdn.shopify.com/s/files/1/1600/9217/products/Gem-Cut-Decanter-Detail.jpg?v=1498771896');
        background-attachment: fixed;
        /* background-size: cover; */
        /* background-repeat: no-repeat;
        background-size: 100% 100%; */
    }

</style>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{('Home - Duft Und Du')}}</title>

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
                height: 120vh;
            }

            .flex-center {
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 100px;
                padding-left: 135px;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                /* padding: 0 25px; */
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    
    <body>
        <div class="flex-center position-ref full-height">
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

                    <a href="{{ url('genie_input')}}"><h2 style="color:#905969">{{_('Lets grant your wish to smell good')}}</h2></a>
                    
                    <p>{{_('The AI Powered Fragrance Genie tells you other fragrances')}}
                        <br>{{_('which you will like based on your preferences')}}
                        <br>{{_('Talk to the Genie and get your wish granted')}}</p>

                    <br>
                    
                    <a href="{{ url('catalog')}}"><h2>{{_('')}}</h2>                        
                    <h2 style="color:#905969"> {{_('Browse our Catalog of Services')}}</h2></a>    
                    
                    <p>{{_('Search through all the fragrances and brands with their composition')}}
                        <br>{{_('Apply for Advetisements & Brand Ambassadors')}}</p>
    
                    <br><br>
                    
                    <a><h2>{{_('PREMIUM FEATURES COMING SOON')}}</h2></a>
                    
                    <br>
                    
                    <a href="{{ url('about_us')}}"><h2 style="color:#905969">{{_('About Us')}}</h2></a>

                </div>

            </div>
        </div>
        
    </body>

</html>
