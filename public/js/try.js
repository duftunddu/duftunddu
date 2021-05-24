var path = "/try_api";
$('input.typeahead').typeahead({
    source: function (to_search, process) {
        return $.get(path, { to_search: to_search }, function (data) {
            return process(data);
        });
    }
});