<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- jQuery library -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/color/jquery.color-2.2.0.js"></script>
<script src="https://code.jquery.com/qunit/qunit-2.10.0.js"></script>
<script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script>



<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>



{{-- Hover Popover --}}
<link href="{{ asset('css/hover_popover.css') }}" rel="stylesheet">
<script src="{{ asset('js/hover_popover.js') }}" defer></script>
    

<h2>Bootstrap Popover with velocity.js animation</h2>
    <div>
    <ul class="popover-example">
        <li><a data-original-title="Popover on left" data-animation="false" data-easein="slideLeftBigIn" href="#" class="btn btn-primary" rel="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">slideLeftBigIn</a></li>
            <li><a data-original-title="Popover on top" data-animation="false" data-easein="slideRightBigIn" href="#" class="btn btn-primary" rel="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">slideRightBigIn</a></li></ul>
</div>

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
                <div class="modExample">
                    <h2>Bootstrap Modal with velocity.js animation</h2>
                <a href="#myModal18" role="button" class="btn btn-default" data-toggle="modal">slideLeftIn</a>
                    <div id="myModal18" class="modal" data-easein="slideLeftIn"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Modal header</h4>
                          </div>
                          <div class="modal-body">
                            <p>One fine body…</p>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                          </div>
                      </div>
                    </div>
                    </div>
                </div>

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
