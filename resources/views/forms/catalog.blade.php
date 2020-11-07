@extends('layouts.app')

<title>{{('Catalog | The Fragrance Hub')}}</title>

<style>
    .flex-2-left {
            background-image: url('../images/fragrance_model/laura-chouette-o7BEFNmuDkU-unsplash_desktop_big_use.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            /* background-position: center center; */
            background-attachment: fixed;
        }
        .flex-2-placement{
            text-align: left;
            align-items: left;
            justify-content: left;
            margin-right: 55%;
            padding-left: 4%;
            /* padding-top: 4%; */
            padding-bottom:4%;
            /* display: flex; */
            /* padding-top: 7.73vw; */
        }
        .flex-2-heading{
            /* font-size: 2.3vw; */
            font-size: 1.8rem;
            font-weight: 100;
            font-variant: small-caps;
            color: #89163f;
            /* color: #571b34; */
            /* color: #220e19; */
        }
        .flex-2-body{
            /* font-size: 1.4vw; */
            font-size: 1.056rem;
            font-weight: 100;       
            color: rgb(255, 250, 255);
            /* color: #e8e7ec; */
            /* color: #571b34; */
            /* color: #2e1524; */
            /* color: rgb(0, 255, 255);  */
        }
        .flex-2-body a{
            color: #f7527c;
        }
</style>

@section('content')

{{-- <div class="container"> --}}
    <div class="flex-2-left position-ref full-height">
        <div class="flex-2-placement">
            
            <div class="flex-2-heading">
                Discover
            </div>
            <div class="flex-2-body">
                Find the fragrance you want on our <a href="search_engine">Search Engine</a> and check similar fragrances.
                {{-- [add picture on hover] --}}
                {{-- Find the fragrance you want on our Search Engine and check similar fragrances. --}}
            </div>

            <div class="flex-2-heading">
                Smell Your Best
            </div>
            <div class="flex-2-body">
                ●	Check if a fragrance suits you on the <a href="search_engine">Search Engine</a><br>
                ●	Get fragrance suggestions based on your preferences with our Genie | Coming Soon.<br>
                {{-- [add picture on hover] --}}
                ●	Find your perfect scent for every occasion | Coming Soon.<br>
                Always smell your best.
            </div>

            <div class="flex-2-heading">
                Get Your Loved Ones The Perfect Gift
            </div>
            <div class="flex-2-body">
                Use Genie Gift Cards to get fragrance recommendations for your loved ones | Coming Soon.
                {{-- [add picture on hover] --}}
            </div>
            
            <div class="flex-2-heading">
                Get Insights
            </div>
            <div class="flex-2-body">
                Become a Brand Ambassador to see the details of your brand and add your latest fragrances.<br>
                Registered Brand Ambassadors can also get access to valuable customer insight. <a href="brand_ambassador_proposal">Learn More</a>.
                {{-- [add picture on hover] --}}
            </div>

        </div>
    </div>

{{-- </div> --}}

@endsection
