<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{-- Searchbar Scripts --}}
<link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
<script src="{{ asset('js/searchbar.js') }}" defer></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js" defer></script>

    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{('Search Engine | Duft Und Du')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <style>

            html, body {
                background-image: url('../images/fragrance_model/laura-chouette-5qRgJ8ISEpA-unsplash_use.jpg');
                background-image: url('../images/fragrance_model/laura-chouette-5qRgJ8ISEpA-unsplash_use.webp');
                /* background-attachment: fixed; */
                background-repeat: no-repeat;
                /* background-position: -50px top; */
                background-position: left 77px;
                background-size: cover;
                background-color: #f5f5f3;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                color: #212529;
                height: 100%;
                margin: 0;
                font-size: 100%;
            }

            .full-height {
                height: 100%;
            }

            .flex-center {
                align-items: right;
                display: flex;
                justify-content: right;
                top: 5.0vw;
                padding-left: 55%;
            }
            #search-input{
                font-family: 'Nunito';
                color: #636b6f; 
                font-size: 1rem;
                font-weight: bold;
                width:26.5rem;
                letter-spacing:1px;
            }
            .search__feedback{
                color:rgba(202, 56, 73, 0.7);
                letter-spacing: 0.152rem;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-family: 'Cinzel', serif;
                font-variant: small-caps;
                /* font-size: 6.2vw; */
                font-size: 5.125rem;
                letter-spacing: 1px;
            }

            .heading{
                /* font-size: 2.7vw; */
                font-size: 2.23rem;
                font-weight: 600;
                /* letter-spacing: .25vw; */
                letter-spacing: .2rem;
            }

            /* .links > a {
                padding: 0 1.88px;
                font-size: 0.97vw;
                font-weight: 600;
                letter-spacing: .15vw;
                text-decoration: none;
                text-transform: uppercase;
            } */

            .top-pad{
                font-family: 'Nunito', serif;
                /* padding-top: 18vh; */
                padding-top: 7.8525rem;
                /* font-size: 1.7vw; */
                font-size: 1.4rem;
                font-weight: 600;
                /* letter-spacing: .25vw; */
                letter-spacing: .2rem;
                text-transform: uppercase;
            }

            .m-b-md {
                /* margin-bottom: 2.26vw; */
                margin-bottom: 1.868rem;
            }

            .footer-pad{
                /* margin-top: -3vh; */
                margin-top: -1.3rem;
            }
            
            /* .searchbox {
                line-height: 3.78vw;
                height: 3.78vw;
                width: 3vw;
            } */
        </style>
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
