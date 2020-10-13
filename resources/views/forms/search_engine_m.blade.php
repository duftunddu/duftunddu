<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<link href="{{ asset('css/searchbar_m.css') }}" rel="stylesheet">
<script src="{{ asset('js/searchbar.js') }}" defer></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js" defer></script>

    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{('Search Engine - Duft Und Du')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>

            html, body {

                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                font-size: 3vw;
                color: #212529;
                height: 100%;
                /* height: 100vh; */
                margin: 0;
            }

            .full-height {
                /* height: 70vh; */
                height: 90% !important;
            }

            .background{

                @if($random > 0)
                background-image: url('../images/fragrance_model/applying_fragrance/person-holding-clear-glass-bottle-4659793_use.jpg');
                @elif($random < 0)
                background-image: url('../images/fragrance_model/laura-chouette-2H_8WbVPRxM-unsplash_search_use.jpg');
                @else
                background-image: url('../images/fragrance_model/applying_fragrance/person-holding-clear-glass-round-mirror-4659792_use.jpg');
                @endif

                height: 89%;
                width: 100%;
                position: absolute;
                
                background-size: cover;
                background-repeat: no-repeat;

                transition: all 1s ease-in;
                -webkit-transition: all 1s ease-in;
                -o-transition: all 1s ease-in;
                -moz-transition: all 1s ease-in;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                /* margin-top: -30%; */
                /* padding-top: 15vh; */
                /* padding-top: 15vh; */
                /* padding-left: 10.9vw; */
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
                opacity: 0;
                transition: all 1s ease-in;
                -webkit-transition: all 1s ease-in;
                -o-transition: all 1s ease-in;
                -moz-transition: all 1s ease-in;

            }

            .title {
                font-family: 'Cinzel', serif;
                font-variant: small-caps;
                font-size: 14vw;
                letter-spacing: 1px;
                /* font-size: 12vw; */
            }

            .heading{
                font-size: 10vw;
            }
            
            .m-b-md {
                margin-bottom: 2.26vw;
            }

            .top-pad{
                font-family: 'Nunito', serif;
                padding-top: 18vh;
                font-size: 4.5vw;
                font-weight: 600;
                letter-spacing: .25vw;
                text-transform: uppercase;
            }
            
            /* .links > a { */
                /* padding: 0 1.88px; */
                /* font-size: 1.2vh; */
                /* font-size: 2.8vw;
                font-weight: 600;
                letter-spacing: .2vw;
                text-decoration: none;
                text-transform: uppercase;
                color: #636b6f; */
            /* } */

            /* .searchbox {
                line-height: 3.78vh;
                height: 3.78vh;
                width: 3vh;
            } */

        </style>
    </head>
    
    <body>
        
        @include('layouts.header')

        <div class="background"></div>

        <div class="flex-center position-ref full-height">
          
            <div class="content">

                <div class="title m-b-md">
                    {{_('Duft Und Du')}}
                </div>

                <div class="heading m-b-md">
                    {{_('Explore')}}
                </div><br><br>

                <form class="search" method="POST" action="{{ url('search_engine')}}">
                    @csrf

                    <input id="search-input" class="search__input" maxlength="40" name="searchbox" type="text" placeholder="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="font-family: 'Nunito'; color: #636b6f; font-size: 4.5vw; font-weight: bold; width:70vw" required>
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
                    <span class="search__feedback" style="color:rgba(144, 89, 105, 0.6)">{{_('type here')}}</span>
                </form>

                <div class= "top-pad">        
                    Premium Features Coming Soon
                </div>


            </div>
        </div>
        
        <div class="footer-pad">
            @include('layouts.footer')
        </div>

    </body>

    <script>

        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function(){
                $(".background").css("filter","blur(5px)");
				setTimeout(function(){
						$(".content").css("opacity","1");
				},1000);
            }, 1000);
        });
        
    </script>

</html>
