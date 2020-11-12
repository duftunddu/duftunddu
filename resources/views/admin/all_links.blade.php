@extends('layouts.app')

<style>
    .flex-left{
        background-image: url('https://cdn.shopify.com/s/files/1/1600/9217/products/Gem-Cut-Decanter-Detail.jpg?v=1498771896');
        background-attachment: fixed;
        /* background-size: cover; */
        /* background-repeat: no-repeat;
        background-size: 100% 100%; */
    }
</style>

@section('content')
    <div class="container">
        <div class="flex-left position-ref full-height">

            <div class="content">

                <h1>Catalog</h1><br>
                
                <div class="links">

                    <a href="{{ url('brand_ambassador_requests')}}"><h2>{{_('Brand Ambassador Requests')}}</h2></a>
                    <br>
                    
                    <a href="{{ url('request_feature_panel')}}"><h2>{{_('Feature Request Panel')}}</h2></a>
                    <a href="{{ url('request_feature_user_review')}}"><h2>{{_('Feature User Request Panel')}}</h2></a>
                    <br>

                    <a href="{{ url('request_brand_panel')}}"><h2>{{_('Brand Request Panel')}}</h2></a>
                    <br>

                    <a href="{{ url('brand_entry_admin')}}"><h2>{{_('Brand Entry Admin')}}</h2></a>
                    <br>
                    
                    <a href="{{ url('accord_entry')}}"><h2>{{_('Accord Entry')}}</h2></a>
                    <a href="{{ url('note_entry')}}"><h2>{{_('Note Entry')}}</h2></a>
                    
                </div>
            </div>
        </div>
    </div>
@endsection   
