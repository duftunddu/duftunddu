<head>
    <link href="http://127.0.0.1:8000/webstore_client_css.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/webstore_client_js.js" defer></script>
</head>

<body>
    
    {{-- <a href="#" class="btn btn-lux-lipstick-red model-open" data-toggle="modal" onclick="duftundduModalOpen()" data-target="#duftunddu">Personalized Review</a> --}}
    
    <button class="duftunddu-btn" data-toggle="modal" onclick="duftundduModalOpen()" data-target="#duftunddu">Get Fragrance Reivew</button>


    {{-- <div class="section three">
        <div id="button">
           Genie
           <div class="ring one"></div>
           <div class="ring two"></div>
           <div class="ring three"></div>
           <div class="ring four"></div>
        </div>
    </div> --}}
     

    <div class="duftunddu-modal-overlay">
        <div class="duftunddu-modal">
            <a href="#" class="duftunddu-modal-close" onclick="duftundduModalClose()">✕</a>
            <div class="duftunddu-modal-content">
                <iframe src="http://127.0.0.1:8000/webstore_call/k3dhk9843ykzw45tjhfon3kq69kqmrlltp8qgrb5/user_key/Venom/swag20/Eau de Toilette/default/" class="dnd-frame" frameborder="0"
                sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
                allowtransparency="true"></iframe>
            </div>
            <div class="duftunddu-modal-footer">
                Powered by <span class="dnd-name"> Duft Und Du</span>
            </div>
        </div>
    </div>
</body>

{{-- <script>
    function duftundduModalClose() {
        $('.duftunddu-modal').addClass("duftunddu-modal-absolute");
        $('.duftunddu-modal').addClass("duftunddu-modal-hidden");
        $('.duftunddu-modal-overlay').addClass("duftunddu-modal-overlay-hidden");
        setTimeout(() => {
            $('.duftunddu-modal-overlay').addClass("duftunddu-modal-overlay-none");
        }, 300);
    }
    
    function duftundduModalOpen() {
        $('.duftunddu-modal-overlay').removeClass("duftunddu-modal-overlay-none");
        setTimeout(() => {
            $('.duftunddu-modal-overlay').removeClass("duftunddu-modal-overlay-hidden");
            $('.duftunddu-modal').removeClass("duftunddu-modal-hidden");
            setTimeout(() => {
                $('.duftunddu-modal').removeClass("duftunddu-modal-absolute");
            }, 300)
        }, 300)
    }
    duftundduModalClose()

    $(document).keydown(function(event) { 
        if (event.keyCode == 27) { 
            // $('#modal_id').hide();
            duftundduModalClose()
        }
    });
</script> --}}