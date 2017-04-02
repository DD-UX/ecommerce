(function($){
  $(document).ready(function(){
    var swiper = new Swiper('.product-slider', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true
    });
  });
    
    
})(jQuery)

