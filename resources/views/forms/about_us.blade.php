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
        <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

        <title>{{_('About Us | The Fragrance Hub | Duft Und Du')}}</title>
        
        <style>
            .flex-4-placement{
                margin-top: -2%;
            }
        </style>
    </head>

    <body>

        @include('layouts.preloader')

        @include('layouts.header')
        
        @include('forms.about_us_content')
        
        <div class="footer-pad">
            @include('layouts.footer')
        </div>

    </body>

</html>