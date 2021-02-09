// Preloader
document.addEventListener("DOMContentLoaded", function (event) {

    setTimeout(function () {
        $('#ctn-preloader').addClass('loaded');
        $('body').removeClass('no-scroll-y');

        if ($('#ctn-preloader').hasClass('loaded')) {
            $('#preloader').delay(1000).queue(function () {
                $(this).remove();
                setTimeout(function () {
                    $(".background").css("filter", "blur(5px)");
                    setTimeout(function () {
                        $(".content").css("opacity", "1");
                    }, 200);
                }, 0);
            });
        }
    }, 0);

});