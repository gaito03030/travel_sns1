$(function () {
    $(document).on('click', '.js_delete_button', function () {
        $('.js_bg').fadeIn();
        //削除のパスをhrefに埋め込む
        $('.js_popup_delete_btn').attr('href', $(this).attr('data-delete_link'));

        return false;
    });

    $(document).on('click', '.js_popup_cancel_btn', function () {
        $('.js_bg').fadeOut();
        $('.js_popup_delete_btn').attr('href', "#");

    });
    $(document).on('click', '.js_bg', function () {
        $('.js_bg').fadeOut();
        $('.js_popup_delete_btn').attr('href', "#");
    });


    $(document).on('click', '.js_open_narrow_popup', function () {
        $('.js_bg').fadeIn();
        $('.js_popup').fadeIn();
        return false;
    });

    $(document).on('click', '.js_popup_close_btn', function () {
        $('.js_bg').fadeOut();
        $('.js_popup').fadeOut();


    });
    $(document).on('click', '.js_bg', function () {
        $('.js_bg').fadeOut();
        $('.js_popup').fadeOut();

    });

    



});