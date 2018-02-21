$(document).ready(function() {
    $('#js-single-item').slick({
        autoplay: true,
        autoplaySpeed: 4000,
        // dots: true
        responsive: [
            {
                breakpoint: 740,
                settings: {
                    arrows: false,
                }
            },
        ]
    });
});
