function cSlider() {
    'use strict';

    var $carousel = jQuery('.cslider');

    if ($carousel.length > 0) {

        // Variablen
        var $carouselItem = $carousel.find('.cslider-item'),
            $prev = $carousel.find('.cslider-prev'),
            $next = $carousel.find('.cslider-next'),
            itemLength = $carouselItem.length,
            index = 0;


        // Funktionen
        function setIndex(i, add) {
            if (i + add >= itemLength) {
                return i + add - itemLength;
            } else {
                return i + add;
            }
        }

        function setState(i) {
            // Reset der Klassen
            $carouselItem.attr('class', 'cslider-item')

            // Zuweisung der Klassen
            $carouselItem.eq(setIndex(i, 0)).addClass('cslider-item-first');
            $carouselItem.eq(setIndex(i, 1)).addClass('cslider-item-previous');
            $carouselItem.eq(setIndex(i, 2)).addClass('cslider-item-selected');
            $carouselItem.eq(setIndex(i, 3)).addClass('cslider-item-next');
            $carouselItem.eq(setIndex(i, 4)).addClass('cslider-item-last');


        }

        // Kontrollfelder
        $next.on('click', function () {
            index = index + 1;
            if (index >= itemLength) {
                index = 0;
            }
            setState(index);
        });

        $prev.on('click', function () {
            if (index <= 0) {
                index = itemLength;
            }
            index = index - 1;
            setState(index);
        });

        // Starte Slider
        setState(index);

    }

}

// Shorthand for $( document ).ready()
jQuery(function () {
    cSlider();
});
