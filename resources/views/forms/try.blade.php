
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>

<input class="form-control basicAutoComplete" type="text"
        data-url="/try_api"
        autocomplete="off">

<div id="csrf">
    @csrf
</div>

<script>
    $('.basicAutoComplete').autoComplete();
</script>