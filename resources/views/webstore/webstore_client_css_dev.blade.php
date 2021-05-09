<html> 
<head><style type="text/css"></style></head>

<body data-new-gr-c-s-check-loaded="14.995.0"data-gr-ext-installed=""><pre style="word-wrap: break-word; white-space: normal;">
/*!
 * Duft Und Du Client Call CSS (https://duftunddu.com./)
 * All Rights Reserved.
 */<br>
@import url("https://fonts.googleapis.com/css?family=Nunito");

:root{
    --lux-black-box: #101820FF;
    --lux-black-font: #212529;
    --lux-purple: #8167a9;
    --lux-lipstick-red: #ca3849;

}



.duftunddu-modal-footer{
    font-family: Nunito;
    font-size: 1rem;
    color: #212529;
}

.duftunddu-name{
    font-family: Nunito;
    color: #8167a9;
}

{{-- .dnd-frame{
    display: block;
    margin: 0 auto;
    width: 700px;
    height: 500px;
} --}}

{{-- @media (max-width: 900px) {
    .dnd-frame{
        width: 400px !important;
        height: 400px !important;
    }    
} --}}

{{-- /* Button */
.btn-lux-lipstick-red {
    color: #FFFFFF !important;
    background-color: rgba(202, 56, 73, 0.9) !important;
    border-color: rgba(202, 56, 73, 1) !important;
}
.btn-lux-lipstick-red:hover,
.btn-lux-lipstick-red:focus,
.btn-lux-lipstick-red:active,
.btn-lux-lipstick-red.active,
.open .dropdown-toggle.btn-lux-lipstick-red {
    color: rgba(202, 56, 73, 0.9) !important;
    background-color: #FFFFFF !important;
    border-color: var(--lux-lipstick-red) !important;
    box-shadow: 0 0 0 .2rem rgba(206, 153, 159, 0.6) !important;
}
.btn-lux-lipstick-red:active,
.btn-lux-lipstick-red.active,
.open .dropdown-toggle.btn-lux-lipstick-red {
    background-image: none;
}
.btn-lux-lipstick-red:focus,
.btn-lux-lipstick-red.focus {
    box-shadow: 0 0 0 .2rem rgba(202, 56, 73, 0.6) !important;
}
.btn-lux-lipstick-red.disabled,
.btn-lux-lipstick-red[disabled],
fieldset[disabled] .btn-lux-lipstick-red,
.btn-lux-lipstick-red.disabled:hover,
.btn-lux-lipstick-red[disabled]:hover,
fieldset[disabled] .btn-lux-lipstick-red:hover,
.btn-lux-lipstick-red.disabled:focus,
.btn-lux-lipstick-red[disabled]:focus,
fieldset[disabled] .btn-lux-lipstick-red:focus,
.btn-lux-lipstick-red.disabled:active,
.btn-lux-lipstick-red[disabled]:active,
fieldset[disabled] .btn-lux-lipstick-red:active,
.btn-lux-lipstick-red.disabled.active,
.btn-lux-lipstick-red[disabled].active,
fieldset[disabled] .btn-lux-lipstick-red.active {
    background-color: #FFFFFF;
    border-color: var(--lux-lipstick-red);
}
.btn-lux-lipstick-red .badge {
    color: #FFFFFF;
    background-color: var(--lux-lipstick-red);
} --}}

.duftunddu-modal-overlay {
    background-color: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    transition: 0.3s ease-in all;
}

.duftunddu-modal {
    {{-- width: 70%; --}}
    width: 60%;
    height: 80%;
    top: 15%;
    transition: 0.3s ease-in all;
    background-color: white;
    display: flex;
    flex-direction: column;
    border-radius: 5px;
}

.duftunddu-modal-content {
    flex: 2;
}

.duftunddu-modal-hidden {
    top: -100%;
}

.duftunddu-modal-absolute {
    position: absolute;
}

.duftunddu-modal-overlay-hidden {
    opacity: 0;
}

.duftunddu-modal-overlay-none {
    display: none;
}

.duftunddu-modal-close {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    color: gray;
    font-size: larger;
    padding: 20px;
    text-decoration: none;
    border-bottom: 1px solid #eee;
}

.duftunddu-modal-content iframe {
    width: 100%;
    {{-- width: 90%; --}}
    height: 100%;
    background-color: white;
}

.duftunddu-modal-footer {
    padding: 20px;
    text-align: right;
    border-top: 1px solid #eee;
}


{{-- Black Filling Button --}}
.duftunddu-btn {
    font-family: Nunito;
    box-sizing: border-box;
    appearance: none;
    background-color: transparent;
    border: 1px solid red;
    {{-- border-radius: 0.6rem; --}}
    color: red;
    cursor: pointer;
    display: flex;
    {{-- align-self: center; --}}
    font-size: 1.1rem;
    line-height: 1;
    padding: 1.2rem 2.0rem;
    text-decoration: none;
    text-align: center;
    font-variant: small-caps;
    font-family: 'Nunito', sans-serif;
    letter-spacing: 2px;
}
.duftunddu-btn:hover, .duftunddu-btn:focus {
    {{-- color: #fff; --}}
    outline: 0;
}
.duftunddu-btn {
    border-color: #101820FF;
    border-radius: 0;
    color: #101820FF;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: color 250ms ease-in-out;
}
.duftunddu-btn:after {
    content: '';
    position: absolute;
    display: block;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 100%;
    background: #101820FF;
    z-index: -1;
    transition: width 250ms ease-in-out;
}
.duftunddu-btn:hover {
    color: #fff;
}
.duftunddu-btn:hover:after {
    width: 110%;
}




{{-- New Fancy Button--}}

.section {
    {{-- width: 100%; --}}
    width: 375px;
    height: 375px;
    {{-- padding: 0; --}}
    position: absolute;
    {{-- border-top: 2px solid #fff; --}}
    {{-- border-bottom: 2px solid #fff; --}}
}

.three {
    z-index: -1;
    {{-- top: 800px; --}}
    top: 490px;
    {{-- left: 0; --}}
    background: url(https://images.unsplash.com/photo-1431440869543-efaf3388c585?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&s=a9ed512366462aff761f7c04ac383675) center center no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.three #button {
    width: 122px;
    padding: 16px;
    height: 50px;
    color: #f6f6f6;
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    background: transparent;
    -webkit-transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
    -moz-transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
    -o-transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
    transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
    cursor: pointer;
    box-shadow: 0px 0px 0px #fff;
    z-index: 0;
}
.three #button .ring {
    position: absolute;
    width: 20px;
    height: 20px;
    background: #fff;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    -o-border-radius: 50px;
    border-radius: 50px;
    top: 40%;
    left: 45%;
    -webkit-transition: all 1s cubic-bezier(0.55, 0, 0.1, 1);
    -moz-transition: all 1s cubic-bezier(0.55, 0, 0.1, 1);
    -o-transition: all 1s cubic-bezier(0.55, 0, 0.1, 1);
    transition: all 1s cubic-bezier(0.55, 0, 0.1, 1);
    transform: perspective(500px) translate3d(0px, 0px, 0px);
    opacity: 0;
}
.three #button:hover .one {
    transform: perspective(500px) translate3d(-90px, -50px, 150px);
    opacity: 1;
}
.three #button:hover .two {
    transform: perspective(800px) translate3d(-130px, 50px, 180px);
    opacity: 0.6;
}
.three #button:hover .three {
    transform: perspective(800px) translate3d(130px, 50px, 30px);
    opacity: 0.2;
}
.three #button:hover .four {
    transform: perspective(800px) translate3d(130px, -120px, 80px);
    opacity: 0.9;
}
.three #button::after {
    position: absolute;
    top: -35px;
    left: 0;
    width: 150px;
    height: 150px;
    content: "";
    background: #fff;
    z-index: -1;
    transform: perspective(800px) scale(0) rotate(0deg);
    -webkit-transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
    -moz-transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
    -o-transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
    transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
}
.three #button:before {
    position: absolute;
    top: -40px;
    left: -6px;
    width: 160px;
    height: 160px;
    border: solid 1px #fff;
    content: "";
    background: transparent;
    z-index: -1;
    transform: perspective(800px) scale(0.4) rotate(0deg);
    -webkit-transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
    -moz-transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
    -o-transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
    transition: all 2s cubic-bezier(0.55, 0, 0.1, 1);
}
.three #button:hover::after {
    transform: perspective(800px) scale(1) rotate(600deg);
}
.three #button:hover::before {
    transform: perspective(800px) scale(1) rotate(-100deg);
}
.three #button:hover {
    color: #505050;
}

</pre></body></html>