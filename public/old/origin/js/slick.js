//スライドショー　メイン
$(function () {
  $('.mainimg-slick').slick({
    autoplay: true,
    dots: true,
    arrows: false,
    autoplaySpeed: 4000,
    pauseOnHover: false,
    centerMode: true,
    centerPadding: '120px'
  });
});
