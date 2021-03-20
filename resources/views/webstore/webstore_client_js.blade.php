<html> 
    {{-- <head><style type="text/css"></style></head> --}}

<body data-new-gr-c-s-check-loaded="14.995.0"data-gr-ext-installed=""><pre style="word-wrap: break-word; white-space: normal;">
/*!
 * Duft Und Du Client Call JS (https://duftunddu.com./)
 * All Rights Reserved.
 */
<br>
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
        }, 300)
    }
    modelClose()

    $(document).keydown(function(event) { 
        if (event.keyCode == 27) { 
            modelClose()
        }
    });

</pre></body></html>