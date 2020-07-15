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

        <title>{{('Catalog - Duft Und Du')}}</title>

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
                height: 115vh;
            }

            .flex-left {
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 70px;
                padding-left: 100px;
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
                text-align: left;
            }

            .title {
                font-size: 75px;
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

            h2{
                color:#905969;
            }
        </style>
    </head>
    
    <body>
        <div class="flex-left position-ref full-height">
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
                <div class="title">
                    {{_('Catalog')}}
                </div>

                <div class="heading">
                    <h1>{{_('The AI Powered Fragrance Genie')}}</h1>
                </div>
                
                <br>
                
                <div class="links">

                    <a href="{{ url('catalog')}}"><h2>{{_('All Active Reigons')}}</h2></a>
                    <a href="{{ url('catalog')}}"><h2>{{_('All Fragrances')}}</h2></a>
                    <a href="{{ url('catalog')}}"><h2>{{_('All Brands')}}</h2></a>
                    {{-- <a href="{{ url('catalog')}}"><h2>{{_('Users')}}</h2></a> --}}
                    
                    <br>

                    <a href="{{ url('search_engine')}}"><h2>{{_('Search Engine')}}</h2></a>


                    <br>

                    <a href="{{ url('catalog')}}"><h2>{{_('Advertise on Duft Und Du')}}</h2></a>
                    <a href="{{ url('catalog')}}"><h2>{{_('Become a brand ambassador')}}</h2></a>
                    
                    <br>
                    
                    <a><h2 style="color:#636b6f">{{_('PREMIUM FEATURES COMING SOON')}}</h2></a>
                    
                    <br>
                    
                    <a href="{{ url('about_us')}}"><h2>{{_('About Us')}}</h2></a>
                    
                </div>

                </div>

            </div>
        </div>
        
    </body>
</html>
