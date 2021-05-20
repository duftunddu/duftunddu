<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<input class="typeahead">
   
<script>
    var path = "{{ url('/try_api') }}";
    $('input.typeahead').typeahead({
        source:  function (to_search, process) {
        return $.get(path, { to_search: to_search }, function (data) {
                return process(data);
            });
        }
    });
</script>
