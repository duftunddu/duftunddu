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
                    1. Information Collection and Use
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	Data Collected
                    <br>&emsp;&emsp;&emsp;&emsp;o	Data:
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	Visitors: No data is collected.
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	Guests and Users: All entered data and IP Addresses are collected.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Events of Data Collection:
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	When Guests use the Search Engine.
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	All events where users enter the data.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Purpose:
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	For other provided services.
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	For enhancement of the provided services.
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	For innovation of services.
                </div><br>

                <div class="flex-4-heading">
                    2. Log Data
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	IP Addresses.
                    <br>&emsp;&emsp;•	Login: 
                    <br>&emsp;&emsp;&emsp;&emsp;o	User Identification Details:
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	Email addresses and passwords.
                    <br>&emsp;&emsp;•	Purpose:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Session Management.
                </div><br>

                <div class="flex-4-heading">
                    3. Communications
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	User will be notified via email regarding:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Any major changes in services.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Changes in Terms and Conditions.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Newsletters, if he has signed up for it.
                    <br>&emsp;&emsp;•	The Provider is required by law to inform the User about changes to the Terms And Conditions.
                    <br>&emsp;&emsp;•	Cessation of Communication:
                    <br>&emsp;&emsp;&emsp;&emsp;o	User can:
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	Unsubscribe from the newsletter, to stop receiving the newsletter.
                    <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ỽ	Terminate the contract, to stop all communication.
                </div><br>
                
                <div class="flex-4-heading">
                    4. Cookies
                </div>
                <div class="flex-4-body">      
                    &emsp;&emsp;•	Definition of Cookies:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Visitors & Guests: Session cookies.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Users: Session cookies and persistent cookies.
                    <br>&emsp;&emsp;•	Visiting, using, or participating on the website are all cookie events.
                    <br>&emsp;&emsp;•	Purpose:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Session Management.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Personalization.
                    <br>&emsp;&emsp;•	Conditions if User doesn’t want to allow the collection of cookies:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Don’t use the website.
                </div><br>
                
                <div class="flex-4-heading">
                    5. Changes to Privacy Policy
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	The Provider reserves the right to change the privacy policy without any notice.
                    <br>&emsp;&emsp;•	The Provider will not communicate the changes in privacy policy. 
                    <br>&emsp;&emsp;•	Usage of the website implies that Users agree to the Privacy Policy.
                </div><br>
                
                <div class="flex-4-heading">
                    6. Judication
                </div>
                <div class="flex-4-body">        
                    &emsp;&emsp;•	Using the website is a personal decision.
                    <br>&emsp;&emsp;•	It is User’s responsibility to ensure that the Provider’s policy supports his local laws.
                </div><br>
                
                <div class="flex-4-heading">
                    7. Contact Details
                </div>
                <div class="flex-4-body">
                    &emsp;&emsp;•	We can be contacted for the following purposes:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Report bugs/errors.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Report complains, suggestions.
                    <br>&emsp;&emsp;&emsp;&emsp;o	Clarification of Policy.
                    <br>&emsp;&emsp;•	Channels of Communication:
                    <br>&emsp;&emsp;&emsp;&emsp;o	Email: duftunddu@outlook.com 
                </div>

            </div>
        </div>
    </div>
@endsection
