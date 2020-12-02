<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

        <title>{{('Search Engine | Duft Und Du')}}</title>

        {{-- Searchbar Scripts --}}
        <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
        <script src="{{ asset('js/searchbar.js') }}" defer></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/TweenMax.min.js') }}" defer></script>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="{{ asset('css/search_engine.css') }}" rel="stylesheet">
    </head>
    
    <body>
        @include('layouts.preloader')

        @include('layouts.header')
        
        <div class="flex-center position-ref full-height">
            
            <div class="content">

                <div class="title m-b-md">
                    {{_('Duft Und Du')}}
                </div>

                <div class="heading m-b-md">
                    {{_('Explore')}}
                </div>

                <br><br>
                
                <form class="search" method="GET" action="{{ url('search_results')}}">
                    @csrf

                    <input id="search-input" class="search__input" maxlength="40" name="searchbox" type="text" placeholder="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required> 
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
                {{-- <span class="search__feedback" style="color:rgba(202, 56, 73, 0.7); letter-spacing: .25vw;">{{_('type here')}}</span> --}}
                <span class="search__feedback">{{_('type here')}}</span>
                
                </form>

                <div class= "top-pad">        
                    {{_('Premium Features Coming Soon')}}
                </div>

            </div>
        </div>
        
        <div class="footer-pad">
            @include('layouts.footer')
        </div>

    </body>

</html>
