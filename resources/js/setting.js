$(function () {
    $('[name="notice_all"]').change(function () {
        //選択した値に応じてdisable切り替え

        if ($(this).val() == 1) {
            $('.js_disable').prop('disabled', true);
        } else {
            $('.js_disable').prop('disabled', false);
        }
    });
});