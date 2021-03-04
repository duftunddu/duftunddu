@extends('layouts.app')

<style>
    .picture{
        background-image: url("../images/others/maik-jonietz-_yMciiStJyY-unsplash-compressed.jpg");
        background-image: url("../images/others/maik-jonietz-_yMciiStJyY-unsplash-compressed.webp");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        margin-top: -2.5rem;
        /* background-position: -1rem auto; */
    }
    h1, .links a{
        color:whitesmoke !important;
    }
    .links a:hover{
        color: rgb(177, 164, 208) !important;
    }
    .center{
        display: flex;
        justify-content: center;
    }
    .right-align{
        text-align: right;
    }
</style>

@section('content')
<div class="picture">
    <div class="container">
        <div class="flex-left position-ref full-height">

            <div class="content"><br><br>

                <h1 class="center">Moderator Links</h1><br>
                
                <div class="links">


                    <a href="{{ url('/unavailable_brands_fragrances_panel')}}"><h2>{{_('Unavailable Brand & Fragrances Panel')}}</h2></a>
                    <a href="{{ url('/webstore_client')}}"><h2>{{_('Webstore Client')}}</h2></a>
                    

                    {{-- <a href="{{ url('/stores_panel')}}"><h2>{{_('Stores Panel')}}</h2></a>
                    <a href="{{ url('/stores_requests_panel')}}"><h2>{{_('Stores Requests Panel')}}</h2></a> --}}
                    <br>

                    {{-- <a href="{{ url('/email_panel')}}"><h2>{{_('Email Panel')}}</h2></a>
                    <a href="{{ url('/brand_ambassador_requests')}}"><h2>{{_('Brand Ambassador Requests')}}</h2></a> --}}
                    <br>
                    
                    {{-- <div class="right-align">
                        <a href="{{ url('/request_feature_panel')}}"><h2>{{_('Feature Request Panel')}}</h2></a>
                        <a href="{{ url('/request_feature_user_review')}}"><h2>{{_('Feature User Request Panel')}}</h2></a>
                        <br> --}}
                    </div>

                    {{-- <a href="{{ url('/request_brand_panel')}}"><h2>{{_('Brand Request Panel')}}</h2></a> --}}
                    <br>

                    {{-- <a href="{{ url('/brand_entry_admin')}}"><h2>{{_('Brand Entry Admin')}}</h2></a> --}}
                    <br>
                    
                    <div class="right-align">
                        {{-- <a href="{{ url('/accord_entry')}}"><h2>{{_('Accord Entry')}}</h2></a>
                        <a href="{{ url('/note_entry')}}"><h2>{{_('Note Entry')}}</h2></a> --}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection   
