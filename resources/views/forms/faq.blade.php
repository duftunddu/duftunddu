@extends('layouts.app')

<title>{{_('FAQ | The AI Powered Fragrance Genie | Duft Und Du')}}</title>

<link href="{{ asset('css/faq.css') }}" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

@section('content')

<div class="faq_fetch" id="faq_fetch">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pt-4">Frequently Asked Questions</h1>
                
                <form action="">
                    <div class="form-group">
                        <label for="" class="mt-4">Filter:</label>
                        <input type="text" class="form-control mb-4 p-3" v-model="filterWord" placeholder="Type here">
                    </div>
                </form>

                    <h3 class="p-2 pt-3">
                        About
                    </h3>
                    <div class="toggle" v-for="topic in filteredTopics" v-on:click="disparo">
                        <div class="toggle-title">
                            <h3>
                                <span class="title-name">@{{ topic.title }}</span>
                                <i class="fa"></i>
                            </h3>
                        </div>
                        <div class="toggle-inner">
                            <p>
                                @{{ topic.description }}
                            </p>
                        </div>
                    </div>
            
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/faq.js') }}"></script>

@endsection

