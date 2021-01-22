@extends('layouts.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="{{ asset('js/webstore_client.js') }}" ></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">LINKY</a>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" width="800px" height="500px">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> --}}
                            {{-- <iframe src="http://127.0.0.1:8000/store_profile" width="80%" height="80%" frameborder="0" --}}
                            {{-- <iframe src="http://127.0.0.1:8000/store_profile" width="400" height="500" frameborder="0" --}}
                            <iframe src="http://127.0.0.1:8000/store_profile" width="400px" height="500px" frameborder="0"
                            {{-- <iframe src="http://127.0.0.1:8000/store_profile" width="5rem" height="7rem" frameborder="0" --}}
                                sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
                                allowtransparency="true"></iframe>
                        </div>
                        <div class="modal-header">
                            Powered by Duft Und Du
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </div>
    </div>
</div>


@endsection

{{-- <a href="/store_profile"    onclick="document.getElementById('modal1').style.display='block'" target="iframe_modal">link</a>

<div id="modal1" class="modal">
  <span onclick="document.getElementById('modal1').style.display='none'; document.getElementById('iframe1').src =''" class="">&times;</span>
  <iframe id="iframe1" height="300px" width="100%" src="" name="iframe_modal"></iframe>
</div> --}}