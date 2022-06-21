$('.slick-slider').slick({
    autoplay: true,
    dots: true,
    speed:1000,
    arrows :true,
    swipe:true,
    slidesToShow:2,
  }); 

$('.slick-slider1').slick({
    autoplay: false,
    dots: true,
    speed:1000,
    swipe:true,
    slidesToShow:3,
    arrows :true,
    swipe : true,
    responsive: [{
      breakpoint: 767,
      settings: {
        slidesToShow: 1, // 表示スライド数 2つ
        slidesToScroll: 1,
      }
    }]
  }); 
