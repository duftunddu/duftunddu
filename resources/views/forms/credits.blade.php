<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

    <title>{{_('About Us | The Fragrance Hub | Duft Und Du')}}</title>

    <style>
        html,
        body {
            background-color: #fff;
            font-weight: 200;
            color: #212529;
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100%;
        }

        .flex-4-right {
            background-image: url('../images/others/laura-chouette-j_qackZwDIU-unsplash-edited-enhanced_use.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: left center;
            background-attachment: fixed;
        }

        .flex-4-placement {
            text-align: center;
            align-items: right;
            justify-content: right;
            margin-left: 45%;
            margin-right: 3%;
            padding-top: 3%;
        }

        .flex-4-heading {
            font-size: 3.5vw;
            font-weight: 100;
            font-variant: small-caps;
            color: #89163f;
        }

        .flex-4-body {
            font-size: 2vw;
            font-weight: 100;
            color: #e8e7ec;
        }

        .flex-4-placement {
            margin-top: -2%;
        }

        @media (max-width: 700px) {
            .flex-4-right {
                background-image: url('../images/others/laura-chouette-j_qackZwDIU-unsplash-edited-enhanced_use.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: 42.5% center;
                background-attachment: scroll;
            }

            .flex-4-placement {
                margin-left: 20%;
                margin-right: 3%;
                padding-top: 9%;
            }

            .flex-4-heading {
                font-size: 2.4rem;
            }

            .flex-4-body {
                /* font-size: 3vh; */
                font-size: 1.3rem;
            }
        }

        @media (max-width: 535px) and (max-height: 740px) {
            .flex-4-heading {
                font-size: 2.2rem;
            }

            .flex-4-body {
                font-size: 1.1rem;
            }
        }
    </style>

</head>

<body>

    @include('layouts.preloader')

    @include('layouts.header')


    <div class="flex-4-right position-ref full-height">
        <div class="flex-4-placement">
            <div class="flex-4-heading">
                Credits to the Open Source Community 
            </div>

            <br>
            <div class="flex-4-heading">
            </div>
            <div class="flex-4-body">
                Gender Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a
                    href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>.

                Gender Symbols from <a href="https://all-free-download.com/free-vector/download/gender-symbols_312155.html">
                    all-free-download.com</a>.
            </div><br>

            <div class="flex-4-heading">
                {{-- Our Vision --}}
            </div>
            <div class="flex-4-body">
                {{-- To be able to suggest you the perfect fragrance for each occasion and gift. --}}
            </div><br>

            <div class="flex-4-heading">
                {{-- Our Mission --}}
            </div>
            <div class="flex-4-body">
                {{-- To help people make informed decisions about fragrances. --}}
            </div>

        </div>
    </div>

    <div class="footer-pad">
        @include('layouts.footer')
    </div>

</body>

</html>