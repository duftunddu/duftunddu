<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/webstore_client.js') }}"></script>
<link rel="stylesheet" href="http://127.0.0.1:8000/webstore_client_css.css" defer>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" defer>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

<a href="" class="btn btn-lux-lipstick-red" data-toggle="modal" data-target="#duftunddu">Personalized Review</a>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="duftunddu" tabindex="-1" role="dialog" aria-labelledby="Personalized Review | Duft Und Du" aria-hidden="true"
data-backdrop="static" width="800px" height="500px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                {{-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> --}}
                <iframe src="http://127.0.0.1:8000/webstore_call" class="dnd-frame" frameborder="0"
                    sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
                    allowtransparency="true"></iframe>
            </div>
            <div class="modal-footer">
                Powered by <span class="dnd-name"> Duft Und Du</span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->