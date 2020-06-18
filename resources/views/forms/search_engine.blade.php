<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
<script src="{{ asset('js/searchbar.js') }}" defer></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js" defer></script>

    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{('Search Engine - Duft Und Du')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>

            html, body {
                background-image: url('https://cdn.shopify.com/s/files/1/1600/9217/products/Gem-Cut-Decanter-Detail.jpg?v=1498771896');
                background-attachment: fixed;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                /* font-size: 20px; */
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 90vh;
            }

            .flex-center {
                align-items: left;
                display: flex;
                justify-content: left;
                padding-top: 7.55vw;
                padding-left: 10.9vw;
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
            }

            .title {
                font-size: 6.4vw;
            }

            .links > a {
                color: #636b6f;
                /* padding: 0 1.88px; */
                font-size: 0.97vw;
                font-weight: 600;
                letter-spacing: .12vw;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 2.26vw;
            }

            /* .searchbox {
                line-height: 3.78vw;
                height: 3.78vw;
                width: 3vw;
            } */

        </style>
    </head>
    
    <body>          
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login &nbsp&nbsp&nbsp&nbsp</a>

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
                    <h1>{{_('Search Engine')}}</h1>
                </div>

                <br><br>
                <form class="search" method="POST" action="{{ url('search_engine')}}">
                    @csrf

                    <input id="search-input" class="search__input" name="searchbox" type="text" placeholder="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="font-family: 'Nunito'; color: #636b6f; font-size: 1.36vw; font-weight: bold; width:32.65vw"> 
                    <button class="btn btn--search">
                        <?xml version="1.0" encoding="iso-8859-1"?>
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
                            s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                            c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
                            s-17-7.626-17-17S14.61,6,23.984,6z"/>
                        </svg>
                        <svg class="icon icon--search">
                            <use xlink:href="#icon-search"></use>
                        </svg>
                    </button>
                    <span class="search__feedback" style="color:rgba(144, 89, 105, 0.6)">{{_('type fragrance or brand name')}}</span>
                </form>


                <br><br><br><br><br><br>

                <div class="links">     
    
                    <a><h2>{{_('PREMIUM FEATURES COMING SOON')}}</h2></a>
                        <br>
                    <a href="{{ url('about_us')}}"><h2>{{_('About Us')}}</h2></a>

                </div>

            </div>
        </div>
        
    </body>

</html>
