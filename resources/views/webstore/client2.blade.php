<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="webstore_client2.css" rel="stylesheet" defer>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" defer>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

<a href="" class="btn btn-lux-lipstick-red model-open" data-toggle="modal" onclick="modelOpen()" data-target="#duftunddu">Personalized
    Review</a>

<!-- Modal -->
<div class="model-overlay">
    <div class="model">
        <a href="#" class="model-close" onclick="modelClose()">x</a>
        <div class="model-content">
            <iframe src="http://127.0.0.1:8000/webstore_call/key/brand_name/swag20" class="dnd-frame" frameborder="0"
                sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
                allowtransparency="true"></iframe>
        </div>
        <div class="model-footer">
            Powered by <span class="dnd-name"> Duft Und Du</span>
        </div>
    </div>
</div>

<script>
    // $('.model-close').on('click', );
    function modelClose() {
        $('.model').addClass("model-absolute");
        $('.model').addClass("model-hidden");
        $('.model-overlay').addClass("model-overlay-hidden");
        setTimeout(() => {
            $('.model-overlay').addClass("model-overlay-none");
        }, 300);
    }

    // $('.model-open').on('click',);
    function modelOpen() {
        $('.model-overlay').removeClass("model-overlay-none");
        setTimeout(() => {
            $('.model-overlay').removeClass("model-overlay-hidden");
            $('.model').removeClass("model-hidden");
            setTimeout(() => {
                $('.model').removeClass("model-absolute");
            }, 300)
        },
            300)
    }
    modelClose()
</script>