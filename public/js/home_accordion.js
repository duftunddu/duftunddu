jQuery(document).ready(($) => {
    $('.as-accordion-head').click(function () {
        $(this).find('.as-accordion-close').toggleClass('open');
        $(this).next('.as-accordion-collapse').slideToggle('fast', () => {
            // Do something maybe .. 
        });
    });
});
