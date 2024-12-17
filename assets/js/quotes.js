function initQuoteCarousel() {

    var $quotesWrapper = $(".cust-quotes");
    var $quotes = $quotesWrapper.find("blockquote");

    if (!$quotes.length) {
        return;
    }

    $quotes.hide();
    $quotes.first().show();

    var selectNextQuote = function () {
        var $currentQuote = $quotesWrapper.find("blockquote:visible");
        var $nextQuote = $currentQuote.next("blockquote").length ? $currentQuote.next("blockquote") : $quotes.first();

        $currentQuote.fadeOut(500, function () {
            $nextQuote.fadeIn(500);
        });

        setTimeout(selectNextQuote, $nextQuote.data("timeout"));
    };

    setTimeout(selectNextQuote, $quotes.filter(":first").data("timeout"));
}

$(function () {
    initQuoteCarousel();
});

$(window).on('scroll', function() {
    var scrollPosition = $(window).scrollTop();
    var elementOffset = $('#testimonials').offset().top;

    if (scrollPosition + $(window).height() > elementOffset) {
        $('#testimonials').addClass('visible');
    }
});