jQuery(function ($) {
    $(".nav_openbtn").click(function () {
        if ($(this).is('.active')) {
            $('nav').css('right', '-60%');
            $('.nav_bg').fadeOut();
        } else {
            $('nav').css('right', '0');
            $('.nav_bg').fadeIn();
        }
        $(this).toggleClass('active');
    });
    $(".nav_bg").click(function () {
        $('nav').css('right', '-60%');
        $('.nav_bg').fadeOut();
        $(".nav_openbtn").toggleClass('active');
    })
})

