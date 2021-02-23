<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <link rel="stylesheet" href="http://127.0.0.1:8000/webstore_client_css.css" defer> --}}
<link href="{{ asset('css/webstore_client2.css') }}" rel="stylesheet" defer>
<script src="{{ asset('js/webstore_client2.js') }}"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" defer>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

<a href="" class="btn btn-lux-lipstick-red" data-toggle="modal" data-target="#duftunddu">Personalized Review</a>

<!-- Modal -->
<div class="model-overlay">
    <a href="#">x</a>
    <div class="model-content">
        <iframe src="http://127.0.0.1:8000/webstore_call/key/brand_name/swag20" class="dnd-frame" frameborder="0"
        sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
        allowtransparency="true"></iframe>
    </div>
    <div class="model-footer">
        Powered by <span class="dnd-name"> Duft Und Du</span>
    </div>
</div>
{{-- <div class="modal fade bd-example-modal-lg" id="duftunddu" tabindex="-1" role="dialog" aria-labelledby="Personalized Review | Duft Und Du" aria-hidden="true"
data-backdrop="static" width="800px" height="500px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-body">
                {{-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> --}}
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 
<!-- /.modal -->