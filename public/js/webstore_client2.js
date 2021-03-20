function modelClose() {
    $('.model').addClass("model-absolute");
    $('.model').addClass("model-hidden");
    $('.model-overlay').addClass("model-overlay-hidden");
    setTimeout(() => {
        $('.model-overlay').addClass("model-overlay-none");
    }, 300);
}
function modelOpen() {
    $('.model-overlay').removeClass("model-overlay-none");
    setTimeout(() => {
        $('.model-overlay').removeClass("model-overlay-hidden");
        $('.model').removeClass("model-hidden");
        setTimeout(() => {
            $('.model').removeClass("model-absolute");
        }, 300)
    },
        300)
}
modelClose()
