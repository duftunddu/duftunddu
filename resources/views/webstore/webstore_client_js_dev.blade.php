/*! Duft Und Du Client Call JS (https://duftunddu.com./) | All Rights Reserved. */

function duftundduModalClose() {
    $('.duftunddu-modal').addClass("duftunddu-modal-absolute");
    $('.duftunddu-modal').addClass("duftunddu-modal-hidden");
    $('.duftunddu-modal-overlay').addClass("duftunddu-modal-overlay-hidden");
    setTimeout(() => {
        $('.duftunddu-modal-overlay').addClass("duftunddu-modal-overlay-none");
    }, 300);
}

function duftundduModalOpen() {
    $('.duftunddu-modal-overlay').removeClass("duftunddu-modal-overlay-none");
    setTimeout(() => {
        $('.duftunddu-modal-overlay').removeClass("duftunddu-modal-overlay-hidden");
        $('.duftunddu-modal').removeClass("duftunddu-modal-hidden");
        setTimeout(() => {
            $('.duftunddu-modal').removeClass("duftunddu-modal-absolute");
        }, 300)
    }, 300)
}
duftundduModalClose()

$(document).keydown(function(event) { 
    if (event.keyCode == 27) { 
        // $('#modal_id').hide();
        duftundduModalClose()
    }
});