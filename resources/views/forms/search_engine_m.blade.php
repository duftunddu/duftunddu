<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    {{-- Searchbar Scripts --}}
    <link href="{{ asset('css/searchbar_m.css') }}" rel="stylesheet">
    <script src="{{ asset('js/searchbar.js') }}" defer></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/TweenMax.min.js') }}" defer></script>


    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-G1D0YSC2FS"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-G1D0YSC2FS');
        </script>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The Fragrance Hub. Get Personalized Fragrance Insights.">
        <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

        <title>{{('Search Engine - Duft Und Du')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            .background{
                @if($random > 0) background-image: url('../images/fragrance_model/applying_fragrance/person-holding-clear-glass-bottle-4659793_small_use.jpg');
                background-image: url('../images/fragrance_model/applying_fragrance/person-holding-clear-glass-bottle-4659793_small_use.webp');
                @elseif($random < 0) background-image: url('../images/fragrance_model/laura-chouette-2H_8WbVPRxM-unsplash_search_use.jpg');
                background-image: url('../images/fragrance_model/laura-chouette-2H_8WbVPRxM-unsplash_search_use.webp');
                @else background-image: url('../images/fragrance_model/applying_fragrance/person-holding-clear-glass-round-mirror-4659792_small_use.jpg');
                background-image: url('../images/fragrance_model/applying_fragrance/person-holding-clear-glass-round-mirror-4659792_small_use.webp');
                @endif 
            }
        </style>
        <link href="{{ asset('css/search_engine_m.css') }}" rel="stylesheet">
    </head>
    
    <body>
        
        @include('layouts.preloader_for_phone_search')
        
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

                <form class="search" method="GET" action="{{ url('search_results')}}">
                    @csrf

                    <input id="search-input" class="search__input" maxlength="40" name="searchbox" type="text" placeholder="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                    {{-- <input id="search-input" aria-placeholder="type here" placeholder="type here" class="search__input" maxlength="40" name="searchbox" type="text" placeholder="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required> --}}
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
                    {{-- <span class="search__feedback" >{{_('')}}</span> --}}
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

    {{-- <script>
        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function(){
                $(".background").css("filter","blur(5px)");
				setTimeout(function(){
						$(".content").css("opacity","1");
				},1000);
            }, 1000);
        });
    </script> --}}

</html>
