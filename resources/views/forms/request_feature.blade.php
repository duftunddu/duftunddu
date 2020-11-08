@extends('layouts.app')
{{-- @extends('layouts.nav_bar') --}}
<link href="{{ asset('css/paragraph.css') }}" rel="stylesheet">

<title>{{_('Request A Feature | Duft Und Du')}}</title>

<style>

    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5rem;
        margin: .5rem 0 .75rem;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35rem;
    }

    table th,
    table td {
        padding: .625rem;
        text-align: center;
    }

    table th {
        font-size: .85rem;
        letter-spacing: .1rem;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {

        table {
            border: 0;
        }

        table caption {
            font-size: 1.3rem;
        }
        
        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
        
        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625rem;
        }
        
        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8rem;
            text-align: right;
        }
        
        table td::before {
            /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        table td:last-child {
            border-bottom: 0;
        }
    }

</style>
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h1>{{ __('Request A Feature')}}</h1>
                
                <p>
                    {{ __('
                    You can request a Feature here
                    ')}}
                </p>

                <table>
                    {{-- <caption>Statement Summary</caption> --}}
                    <thead>
                      <tr>
                        <th scope="col">Account</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Period</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach()  --}}
                            <tr>
                                <td data-label="Account">Visa - 3412</td>
                                <td data-label="Due Date">04/01/2016</td>
                                <td data-label="Amount">$1,190</td>
                                <td data-label="Period">03/01/2016 - 03/31/2016</td>
                            </tr>
                        {{-- @endforeach --}}

                      <tr>
                        <td scope="row" data-label="Account">Visa - 6076</td>
                        <td data-label="Due Date">03/01/2016</td>
                        <td data-label="Amount">$2,443</td>
                        <td data-label="Period">02/01/2016 - 02/29/2016</td>
                      </tr>
                      <tr>
                        <td scope="row" data-label="Account">Corporate AMEX</td>
                        <td data-label="Due Date">03/01/2016</td>
                        <td data-label="Amount">$1,181</td>
                        <td data-label="Period">02/01/2016 - 02/29/2016</td>
                      </tr>
                      <tr>
                        <td scope="row" data-label="Acount">Visa - 3412</td>
                        <td data-label="Due Date">02/01/2016</td>
                        <td data-label="Amount">$842</td>
                        <td data-label="Period">01/01/2016 - 01/31/2016</td>
                      </tr>
                    </tbody>
                  </table>

            </div>
        </div>
    </div>
@endsection
