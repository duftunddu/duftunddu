<link href="http://127.0.0.1:8000/webstore_client_css.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="{{ asset('js/webstore_client.js') }}"></script> --}}
{{-- <script src="http://127.0.0.1:8000/webstore_client_js.js" defer></script> --}}

<body>
    
    {{-- <a href="#" class="btn btn-lux-lipstick-red model-open" data-toggle="modal" onclick="modelOpen()" data-target="#duftunddu">Personalized Review</a> --}}
    
    <button class="btn fifth model-open" data-toggle="modal" onclick="modelOpen()" data-target="#duftunddu">Get Fragrance Reivew</button>


    <div class="section three">
        <div id="button">
           Genie
           <div class="ring one"></div>
           <div class="ring two"></div>
           <div class="ring three"></div>
           <div class="ring four"></div>
        </div>
     </div>
     

    <div class="model-overlay">
    <div class="model">
        <a href="#" class="model-close" onclick="modelClose()">✕</a>
        <div class="model-content">
            <iframe src="http://127.0.0.1:8000/webstore_call/k3dhk9843ykzw45tjhfon3kq69kqmrlltp8qgrb5/user_key/Venom/swag20/Eau de Toilette/default/" class="dnd-frame" frameborder="0"
            sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
            allowtransparency="true"></iframe>
        </div>
        <div class="model-footer">
            Powered by <span class="dnd-name"> Duft Und Du</span>
        </div>
    </div>
  </div>
</body>

<script>
    function modelClose() {
        $('.model').addClass("model-absolute");
        $('.model').addClass("model-hidden");
        $('.model-overlay').addClass("model-overlay-hidden");
        setTimeout(() => {
            $('.model-overlay').addClass("model-overlay-none");
        }, 300);
    }
    
    function modelOpen() {
        $('.model-overlay').removeClass("model-overlay-none");
        setTimeout(() => {
            $('.model-overlay').removeClass("model-overlay-hidden");
            $('.model').removeClass("model-hidden");
            setTimeout(() => {
                $('.model').removeClass("model-absolute");
            }, 300)
        }, 300)
    }
    modelClose()

$(document).keydown(function(event) { 
  if (event.keyCode == 27) { 
    // $('#modal_id').hide();
    modelClose()
  }
});
</script>