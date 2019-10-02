
      $('.nav-header').sticky({
        getWidthFrom: '.container-fluid',
        responsiveWidth: true
      });

      $('.slides').slick({
        fade: true,
        autoplay: true,
        speed: 2000,
        arrows: false,
        dots: true
      });

      $('.hot-deals-slides').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      nextArrow: '<i class="fa fa-angle-right hot-right"></span><span class="sr-only">Prev</i>',
      prevArrow: '<i class="fa fa-angle-left hot-left"></span><span class="sr-only">Prev</i>',
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

      $('.partners-slides').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      nextArrow: '<i class="fa fa-angle-right hot-right"></span><span class="sr-only">Prev</i>',
      prevArrow: '<i class="fa fa-angle-left hot-left"></span><span class="sr-only">Prev</i>',
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

function toggleDropdown (e) {
  const _d = $(e.target).closest('.dropdown'),
    _m = $('.dropdown-menu', _d);
  setTimeout(function(){
    const shouldOpen = e.type !== 'click' && _d.is(':hover');
    _m.toggleClass('show', shouldOpen);
    _d.toggleClass('show', shouldOpen);
    $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
  }, e.type === 'mouseleave' ? 0 : 0);
}

$('body')
  .on('mouseenter mouseleave','.dropdown',toggleDropdown)
  .on('click', '.dropdown-menu a', toggleDropdown);
