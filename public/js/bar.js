// just some JS to show that the links work and detect browsers that don't fully support flexbox

function checkBrowser() {

    var $browserAlert = $('.browserAlert');
    var $nav = $('.nav');
    var $content = $('.content');

    var message = 'Please update your browser.';

    if (is.safari('<=6') || is.firefox('<=27')) {
        $browserAlert.html(message);
        $browserAlert.show();
    } else if (is.ie()) {
        message = 'Please open this page with another browser.';
        $browserAlert.html(message);
        $browserAlert.show();
    } else {
        $nav.show();
        $content.show();
    }
}

$(function() {

    // cache DOM
    var $links = $('ul.links');
    var $clicked = $('.clicked');
    var $nav = $('.nav');
    var $content = $('.content');

    $nav.hide();
    $content.hide();

    // browser detect

    // include is.js
    $.ajax({
        url: 'https://cdn.rawgit.com/arasatasaygin/is.js/master/is.min.js',
        dataType: "script",
        success: checkBrowser
    });

    $links.find('li').each(function() {
        $(this).mousedown(function() {
            $clicked.html($(this).text().toUpperCase());
            $clicked.addClass('active');
        });
    });

});