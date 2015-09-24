/**
 * Created by Tim on 9/23/2015.
 */
$(document).ready(function(){

    var windowHeight = $(window).height();
    var navHeight    = $('.main-nav').height();

    $('.full-page-slider').css('height', (windowHeight - navHeight + 3));

    // The resize function
    $(window).resize(function(){
        windowHeight = $(window).height();

        $('.full-page-slider').css('height', (windowHeight - navHeight + 3));
    });


    // Function to set the propper width to the sub-menu items
    $('.nav-menu').find('.menu-dropdown').each(function(){
        var menuWidth = $(this).outerWidth();
        $(this).find('.dropdown-container').find('li').css('width', menuWidth);
    });

});