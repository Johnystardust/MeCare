jQuery(document).ready(function(){
    $ = jQuery;

    $('.go-up').hide();

    $(window).load(function () {
        if($(window).scrollTop() > 100){
            $('.go-up').stop().fadeIn();
        }
    });

    // Scroll to top fadeIn/fadeOut
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.go-up').stop().fadeIn();
        } else {
            $('.go-up').stop().fadeOut();
        }
    });

    // Scroll to top
    $('.go-up').click(function(){
        $("html, body").animate({ scrollTop: 0 },600);
        return false
    });
});