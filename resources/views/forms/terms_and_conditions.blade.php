@extends('layouts.app')

<style>
    html, body {
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
        height: auto !important;
    }
    .flex-4-placement{
        text-align: left;
        align-items: left;
        justify-content: left;
    }
    .flex-4-heading{
        font-size: 3.0vw;
        font-weight: 100;
        font-variant: small-caps;
    }
    .flex-4-body{
        font-size: 1.7vw;
        font-weight: 100;
        padding-bottom: 20px;
    }

    @media (max-width: 700px) {
        .flex-4-placement{
            text-align: left;
            align-items: left;
            justify-content: left;
        }
        .flex-4-heading{
            font-size: 5.5vh;
        }
        .flex-4-body{
            font-size: 3vh;
        }
    }
</style>

@section('content')
    <div class="container">
        <div class="flex-4-right position-ref full-height">
            <div class="flex-4-placement">
                
                <br>
                <h1>Terms And Conditions</h1>

                <div class="flex-4-heading">
                    1. Introduction
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	These are the general terms of the company Duft Und Du SMC Pvt. Ltd. © {{ date('Y') }} All Rights Reserved, with seat in Karachi, Pakistan, called Provider in the following clauses.
                    <br>&emsp;&emsp;•	It's possible to register for the service offered by the Provider. By registering, the General Terms are accepted. A person that is registered, is called a User in the following clauses.
                </div><br>

                <div class="flex-4-heading">
                    2. Service
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	The Provider offers a service to the User to manipulate entered data into other information.
                </div><br>

                <div class="flex-4-heading">
                    3. Usage
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	User is only allowed to apply for Brand Ambassadorship if he meets all the following conditions: 
                    <br>&emsp;&emsp;&emsp;&emsp;o	1) Affiliated with the brand that he is applying for.
                    <br>&emsp;&emsp;&emsp;&emsp;o	2) The brand has granted him permission to represent them on the website.
                    <br>&emsp;&emsp;•	User is only allowed to add fragrances that belong to the brand, which the User is representing.
                    <br>&emsp;&emsp;•	The Provider is allowed to block access in case the Provider thinks it's necessary (for example because of excess usage).
                </div><br>
                
                <div class="flex-4-heading">
                    4. Liability
                </div>
                <div class="flex-4-body">            
                    &emsp;&emsp;•	The Provider doesn't guarantee for the success, correctness or completeness of the services provided.
                <br>&emsp;&emsp;•	The Provider is not liable for any damages resulting from problems with the provided service.
                </div><br>
                
                <div class="flex-4-heading">
                    5. Contract
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	The contract does not have any time limitation.
                <br>&emsp;&emsp;•	A User can cancel the contract by deleting his account; but the Provider has the right to retain any data entered or generated upon User’s request.
                </div><br>
                
                <div class="flex-4-heading">
                    6. Various
                </div>
                <div class="flex-4-body">            
                    &emsp;&emsp;•	The Provider reserves the right to change the General Terms at any moment without indicating any reasons, simply by informing the registered User via email one week before the changes become effective.
                <br>&emsp;&emsp;•	In case single clauses of the General Terms become invalid, the other clauses shall remain valid.
                <br>&emsp;&emsp;•	The place of jurisdiction shall be Karachi, Pakistan.
                </div>
                
            </div>
        </div>
    </div>
@endsection
