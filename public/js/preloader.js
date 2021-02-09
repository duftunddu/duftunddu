// Preloader
document.addEventListener("DOMContentLoaded", function (event) {
    setTimeout(function () {
        $('#ctn-preloader').addClass('loaded');
        // Once the preloader has finished, the scroll appears
        $('body').removeClass('no-scroll-y');

        if ($('#ctn-preloader').hasClass('loaded')) {
            // It is so that once the preloader is gone, the entire preloader section is deleted
            $('#preloader').delay(2000).queue(function () {
                $(this).remove();
            });
        }
    }, 0);
});