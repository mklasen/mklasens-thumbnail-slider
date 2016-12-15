jQuery(document).ready(function($) {

  sliders = $('.products li.product .mk-thumbnail-slider');

  // initiate

  sliders.each(function(index, slider) {
    // first elem
    firstSlide = $('ul li', slider).first()
    firstSlide.addClass('active')

    $('span.mk-thumb-nav', slider).on('click', function(e) {
      e.preventDefault()
      action = $(this).attr('data-action')
      allElems = $('li', $(this).parent());

      if ($('li.active', $(this).parent())[action]().is('li')) {
        nextElem = $('li.active', $(this).parent())[action]();
        allElems.removeClass('active');
        nextElem.addClass('active')

        newElem = $('ul li.active', slider)

        margin = $(newElem).offset().left - $(newElem).parent().offset().left - $(newElem).parent().scrollLeft() - parseFloat($('ul li', slider).first().css('margin-left'))

        marginResult = -Math.abs(margin)
        $('ul li', slider).first().css('margin-left', marginResult)
      }
    });
  })
});
