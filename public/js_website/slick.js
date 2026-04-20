$(document).ready(function(){
  $('.first-slide').slick({
      dots: false,
      infinite: true,
      speed: 800,
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      arrows: false,
      responsive: [
          {
              breakpoint: 1200,
              settings: {
                  slidesToShow: 4,
                  slidesToScroll: 1,
              }
          },
          {
              breakpoint: 992,
              settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
              }
          },
          {
              breakpoint: 768,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  arrows: false,
              }
          },
          {
              breakpoint: 355,
              settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  arrows: false,
              }
          },
      ]
  });

  $('.first-slider-nav .prev').click(function(){
      $('.first-slide').slick('slickPrev');
  });

  $('.first-slider-nav .next').click(function(){
      $('.first-slide').slick('slickNext');
  });
});

