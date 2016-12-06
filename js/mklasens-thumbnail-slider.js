jQuery(document).ready(function($) {

  sliders = $('.products li.product .mk-thumbnail-slider');

  // initiate

  sliders.each(function(index, slider) {
    // first elem
    firstSlide = $('ul li', slider).first()
    firstSlide.addClass('active')

    $('span.prev', slider).on('click', function(e) {
      e.preventDefault()
      allElems = $('li', $(e.target).parent());
      prevElem = $('li.active', $(e.target).parent()).prev();

      if (prevElem.is('li')) {
        allElems.removeClass('active');
        allElems.css('margin-left', 0);
        prevElem.addClass('active');

        var newMargin = $(prevElem).offset().left - $(prevElem).parent().offset().left - $(prevElem).parent().scrollLeft()
        $('li', $(e.target).parent()).first().css('margin-left', -Math.abs(newMargin));
      }
    });

    $('span.next', slider).on('click', function(e) {
      e.preventDefault()
      allElems = $('li', $(e.target).parent());
      curElem = $('li.active', $(e.target).parent())
      nextElem = $('li.active', $(e.target).parent()).next();

      if (nextElem.is('li')) {
        // Only do somthing when it's actually about a LI
        allElems.removeClass('active');
        allElems.css('margin-left', 0);
        nextElem.addClass('active');

        var newMargin = $(nextElem).offset().left - $(nextElem).parent().offset().left - $(nextElem).parent().scrollLeft()
        $('li', $(e.target).parent()).first().css('margin-left', -Math.abs(newMargin));
      }


    });
  })
});
