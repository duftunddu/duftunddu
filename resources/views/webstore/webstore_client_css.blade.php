<html>
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
    color: red;
    cursor: pointer;
    display: flex;
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
</pre></body></html>