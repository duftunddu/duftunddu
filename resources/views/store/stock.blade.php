@extends('layouts.app')

<title>{{('Stock | The Fragrance Hub | Duft Und Du')}}</title>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/stock.css') }}" rel="stylesheet" defer>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"
        type="text/css" />

    {{-- Button --}}
    {{-- <link href="{{ asset('css/custom_button.css') }}" rel="stylesheet" defer> --}}
</head>

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.3.0.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Stock Details')}}</div>
                <div class="card-body">

                    <div data-ng-app="table" data-ng-controller="table-controller">
                        
                        {{-- Searchbars --}}

                        {{-- Add New Fragrances --}}
                        {{-- <div class="form-group row offset-md-0 searchbars">
                            <div class="col-md-4">
                                Add Fragrance to Stock:
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control mr-1 search" placeholder="Type Fragrance Name" aria-placeholder="Type Fragrance Name" />
                            </div>
                            us<div class="col-md-1">
                                <button type="button" class="btn btn-outline-dark fit-small" onclick="window.location='{{ url('fragrance_entry/') }}'">
                                    Add Fragrance
                                </button>
                            </div>
                        </div> --}}

                        {{-- Search --}}
                        <div class="form-group row offset-md-0 searchbars">
                            <div class="col-md-4">
                                Search Stock:
                            </div>
                            <div class="col-md-5">
                                <input type="text" data-ng-model="table" class="form-control search" placeholder="Type Fragrance Name" aria-placeholder="Type Fragrance Name" />
                            </div>
                        </div>
                        
                        {{-- Table --}}
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Country</th>
                            </tr>
                            <tr data-ng-repeat="unavailable in array | filter: table">
                                <td><% unavailable.id %> </td>
                                <td><% unavailable.fragrance_brand_name %> </td>
                                <td><% unavailable.fragrance_name %> </td>
                            </tr>
                        </table>    

                        {{-- Pagination Links --}}
                        <div data-pagination="" data-num-pages="numPages()" data-current-page="currentPage"
                            data-max-size="maxSize" data-boundary-links="true"></div>
                        
                    </div>
                    
                    <br>

                    {{--  Button: Add Fragrance --}}
                    <div class="form-group row mb-0">
                        <div class="center">
                            <button type="button" class="btn btn-outline-dark" onclick="window.location='{{ url('/add_to_stock') }}'">
                                Add Fragrance
                            </button>
                        </div>
                    </div><br>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Turn array to json
    {{-- // var $arr_of_unavail = {!! json_encode($stock->toArray(), JSON_HEX_TAG) !!}; --}}

    var $arr_of_unavail = {!! json_encode($stock, JSON_HEX_TAG) !!};

    {{-- var $arr_of_unavail = [{
                "Name": "Alfreds Futterkiste",
                "City": "Berlin",
                "Country": "Germany"
            }]; --}}

    {{--
            var $arr_of_unavail = [{
                "Name": "Alfreds Futterkiste",
                "City": "Berlin",
                "Country": "Germany"
            }, {
                "Name": "Ana Trujillo Emparedados y helados",
                "City": "México D.F.",
                "Country": "Mexico"
            }, {
                "Name": "Antonio Moreno Taquería",
                "City": "México D.F.",
                "Country": "Mexico"
            }, {
                "Name": "Around the Horn",
                "City": "London",
                "Country": "UK"
            }, {
                "Name": "B's Beverages",
                "City": "London",
                "Country": "UK"
            }, {
                "Name": "Berglunds snabbköp",
                "City": "Luleå",
                "Country": "Sweden"
            }, {
                "Name": "Blauer See Delikatessen",
                "City": "Mannheim",
                "Country": "Germany"
            }, {
                "Name": "Blondel père et fils",
                "City": "Strasbourg",
                "Country": "France"
            }, {
                "Name": "Bólido Comidas preparadas",
                "City": "Madrid",
                "Country": "Spain"
            }, {
                "Name": "Bon app'",
                "City": "Marseille",
                "Country": "France"
            }, {
                "Name": "Bottom-Dollar Marketse",
                "City": "Tsawassen",
                "Country": "Canada"
            }, {
                "Name": "Cactus Comidas para llevar",
                "City": "Buenos Aires",
                "Country": "Argentina"
            }, {
                "Name": "Centro comercial Moctezuma",
                "City": "México D.F.",
                "Country": "Mexico"
            }, {
                "Name": "Chop-suey Chinese",
                "City": "Bern",
                "Country": "Switzerland"
            }, {
                "Name": "Comércio Mineiro",
                "City": "São Paulo",
                "Country": "Brazil"
            }];
            --}}
</script>

<script src="{{ asset('js/stock.js') }}"></script>
@endsection