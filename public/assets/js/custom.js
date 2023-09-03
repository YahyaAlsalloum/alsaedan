// JavaScript Document
$(window).on('scroll', function () {
  var scroll = $(window).scrollTop();

});
$(window).scroll(function (event) {
  var scroll = $(window).scrollTop();

  if (scroll >= 50) {
    $("header").addClass("darkHeader");
  } else {
    $("header").removeClass("darkHeader");
  }
  // if((scroll > 0)&&(scroll < 250)){
  //   console.log(scroll);
  //   $('.projects-page-top').addClass('display_null');
  //   $('.projects-page').addClass('no_padding');

  // }
  // else if(scroll < 251){
  //   console.log(scroll);
  //   $('.projects-page-top').removeClass('display_null');
  //   $('.projects-page').removeClass('no_padding');

  // }

});


// // $('.add').click(function () {   
// //   var th = $(this).closest('.wrap').find('.count');     
// //   th.val(+th.val() + 1);
// // });
// // $('.sub').click(function () {
// //   var th = $(this).closest('.wrap').find('.count');     
// //       if (th.val() > 1) th.val(+th.val() - 1);
// // });









$('.hamburger_icon').click(function () {
  $('.header nav').slideToggle('fast').addClass("show");
  return false;
});


$('.hamburger_icon').click(function () {
  $('.inner-header-left').slideToggle('fast').addClass("show");
  return false;
});




$(document).ready(function () {
  $(".hamburger_icon").click(function () {
    $(".hamburger_icon").toggleClass("show");
  });
});



$('.RealEstate-investment-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '60px',
      }
    },
    {
      breakpoint: 767,
      settings: {
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '60px',
      }
    },

  ]
});

$('.service-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
});

$('.home-banner-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 4000,
  arrows: false,
  dots: false,
});

$('.teams-slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  autoplay: true,
  autoplaySpeed: 4000,
  // rtl: true,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        centerMode: false,
        variableWidth: false,
      }
    },

    {
      breakpoint: 700,
      settings: {
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        centerMode: false,
        variableWidth: false,
      }
    },

  ]
});




$('.Business_development_slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  // fade: true,
  // fade: true,
  infinite: false,
  accessibility: false,
  asNavFor: '.Business_development_nav'
});
$('.Business_development_nav').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.Business_development_slider',
  dots: false,
  accessibility: false,
  arrows: false,
  infinite: false,
  // centerMode: true,
  focusOnSelect: true,
  // variableWidth: true,

  responsive: [
    {
      breakpoint: 1000,
      settings: {
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        centerMode: true,
        variableWidth: true,
      }
    },

  ]
});



const slider = $('.projects-slider1');
let isMobile = window.matchMedia("(max-width: 900px)").matches;
if (!isMobile) {

function onSliderAfterChange(event, slick, currentSlide) {
  $(event.target).data('current-slide', currentSlide);
}

function onSliderWheel(e) {
  var delayInMilliseconds = 400; //1 second

  var deltaY = e.originalEvent.deltaY,
    $currentSlider = $(e.currentTarget),
    currentSlickIndex = $currentSlider.data('current-slide') || 0;
  if (
    (deltaY < 0 && currentSlickIndex == 0)
  ) {
    // console.log(document.getElementById('header-inner'));
    // document.getElementById('header-inner').style.display = "block";
    // document.getElementById('projects-page-top').addClass('active');
    $('.projects-page-top').addClass('active');
    
    setTimeout(function() {
      //your code to be executed after 1 second
      // $('.projects-page-top').addClass('height');
    }, delayInMilliseconds);
  } else {
    // document.getElementById('header-inner').style.display = "none";
    // document.getElementById('projects-page-top').removeClass('active');
    $('.projects-page-top').removeClass('active');
    setTimeout(function() {
      // $('.projects-page-top').removeClass('height');
      //your code to be executed after 1 second
    }, delayInMilliseconds);
  }

  if (
    // check when you scroll up
    (deltaY < 0 && currentSlickIndex == 0) ||
    // check when you scroll down
    (deltaY > 0 && currentSlickIndex == $currentSlider.data('slider-length') - 1)
  ) {
    return;
  }


  e.preventDefault();

  if (e.originalEvent.deltaY < 0) {
    $currentSlider.slick('slickPrev');
  } else {
    $currentSlider.slick('slickNext');
  }
}

slider.each(function (index, element) {
  var $element = $(element);
  // set the length of children in each loop
  // but the better way for performance is to set this data attribute on the div.slider in the markup
  $element.data('slider-length', $element.children().length);
})
  .slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    vertical: true,
    verticalSwiping: true,
    arrows: false
  })
  .on('afterChange', onSliderAfterChange)
  .on('wheel', onSliderWheel);
}
$('.construction-blog-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  asNavFor: '.construction-blog-row',
  
});

$('.construction-blog-row').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  rtl:true
});

// $('.construction-blog-slider').slick({
//   slidesToShow: 1,
//   slidesToScroll:1,
//   arrows: false,
//   dots: true,
// });



$('.more_project_slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: false,
  dots: true,
  centerMode: true,
  centerPadding: '60px',
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: '40px',
      }
    },

  ]
});

$('.deem_slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: false,
  dots: true,
  centerMode: true,
  centerPadding: '20px',
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: '40px',
      }
    },

  ]
});





$('.services-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  arrows: false,
  // fade: true,
  // fade: true,
  asNavFor: '.services-slider-nav'
});
$('.services-slider-nav').slick({
  slidesToShow: 7,
  slidesToScroll: 1,
  asNavFor: '.services-slider',
  dots: false,
  //infinite: false,
  // centerMode: true,
  focusOnSelect: true,
  arrows: false,
  //variableWidth: true,

  responsive: [
    {
      breakpoint: 1000,
      settings: {
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        centerMode: true,
        variableWidth: true,
      }
    },

  ]
});





AOS.init({
  duration: 2000,

})



$(document).ready(function () {
  $('.tab-b').click(function () {
    $(".tabb").removeClass('tab-active');
    $(".tabb[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
    $(".tab-b").removeClass('active-a');
    $(this).parent().find(".tab-b").addClass('active-a');
  });
});

$(document).ready(function () {
  $('.tab-ap').click(function () {
    $(".tabap").removeClass('tab-active');
    $(".tabap[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
    $(".tab-ap").removeClass('active-a');
    $(".tab-ap[data-id='" + $(this).attr('data-id') + "']").addClass("active-a");
  });
});




// jQuery(document).ready(function () {
//   jQuery(".about_video").click(function () {
//     if (jQuery("#video").get(0).paused) {
//       jQuery("#video").trigger("play");
//       jQuery(".play").fadeOut(500);
//     } else {
//       jQuery("#video").trigger("pause");
//       jQuery(".play").fadeIn(500);
//     }
//   });
// });



// $(document).ready(function () {
//            $(".accordion_title").on("click", function () {
//                if ($(this).hasClass("active")) {
//                    $(this).removeClass("active");
//                    $(this).attr("aria-expanded","false");
//                    $(this).siblings(".accordion_list").slideUp(500);
//                } else {
//                    $(".accordion_title").removeClass("active");
//                    $(".accordion_title").attr("aria-expanded","false");
//                    $(this).addClass("active");
//                    $(this).attr("aria-expanded","true");
//                    $(".accordion_list").slideUp(500);
//                    $(this).siblings(".accordion_list").slideDown(500);
//                }
//            });
//        });



jQuery(document).ready(function () {
  jQuery(".home_video").click(function () {
    if (jQuery("#video").get(0).paused) {
      jQuery("#video").trigger("play");
      jQuery(".play").fadeOut(500);
    } else {
      jQuery("#video").trigger("pause");
      jQuery(".play").fadeIn(500);
    }
  });
});


