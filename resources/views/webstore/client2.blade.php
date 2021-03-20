<link href="{{ asset('css/webstore_client2.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    
    <a href="#" class="btn btn-lux-lipstick-red model-open" data-toggle="modal" onclick="modelOpen()" data-target="#duftunddu">Personalized    Review</a>
    <div class="model-overlay">
    <div class="model">
        <a href="#" class="model-close" onclick="modelClose()">✕</a>
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
  <script src="{{ asset('js/webstore_client2.js') }}"></script>
</body>