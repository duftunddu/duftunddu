<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{_('About Us | The Fragrance Hub | Duft Und Du')}}</title>
        
        <style>
            .flex-4-placement{
                margin-top: -2%;
            }
        </style>
    </head>

    <body>
        @include('layouts.header')
        
        @include('forms.about_us_content')
        
        <div class="footer-pad">
            @include('layouts.footer')
        </div>

    </body>
</html>