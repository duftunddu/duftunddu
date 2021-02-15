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

    {{-- Button: Info --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" defer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/solid.min.css" defer>
</head>

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.3.0.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Stock Details &nbsp;&nbsp; <i class="fas fa-info"
                    data-toggle="tooltip" data-placement="top" data-html="true" title="This is your private inventory.
                    You can only get reviews for fragrances that you add here."></i> 

                </div>
                <div class="card-body">
                    
                    <div data-ng-app="table" data-ng-controller="table-controller">

                        {{-- If Stock is Not Empty --}}
                        @if($stock->isNotEmpty())
                        {{-- Search --}}
                        <div class="form-group row offset-md-0 searchbars">
                            <div class="col-md-4">
                                Search Stock:
                            </div>
                            <div class="col-md-5">
                                <input type="text" data-ng-model="table" class="form-control search" placeholder="type here" aria-placeholder="Type Fragrance Name" />
                            </div>
                        </div>
                        
                        {{-- Table --}}
                        <table class="middle">
                            <tr class="tab-head">
                                <th>Brand</th>
                                <th>Fragrance</th>
                                <th>+ / -</th>
                            </tr>
                            <tr data-ng-repeat="unavailable in array | filter: table">
                                <td class="middle"><% unavailable.fragrance_brand_name %></td>
                                <td class="middle"><% unavailable.fragrance_name %></td>
                                <td class="middle"><a href="/remove_from_stock/<% unavailable.id %>">Remove</a></td>
                            </tr>

                            {{-- Move Add To Stock Here, using AJAX --}}
                            {{-- <tr>
                                <td class="middle"><input type="text" data-ng-model="table" class="form-control search" placeholder="Type Fragrance Name" aria-placeholder="Type Fragrance Name" /></td>
                                <td class="middle">a</td>
                                <td class="middle"><a href="/add_to_stock/">Add</a></td>
                            </tr> --}}

                        </table>    

                        {{-- Pagination Links --}}
                        <div data-pagination="" data-num-pages="numPages()" data-current-page="currentPage"
                            data-max-size="maxSize" data-boundary-links="true"></div>
                        
                    </div>
                    @else
                    {{-- If Stock is Empty --}}
                    <br>
                    <div class="form-group row mb-0">
                        <div class="center de-gray">
                            No Fragrance Available in Stock.
                        </div>
                    </div>
                    @endif
                    
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
    var $arr_of_unavail = {!! json_encode($stock, JSON_HEX_TAG) !!};
</script>

<script src="{{ asset('js/stock.js') }}"></script>
@endsection