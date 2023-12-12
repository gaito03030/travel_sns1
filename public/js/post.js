

$(function () {

    /**フォームの要素追加、削除 */

    /**
     * 要素が追加・削除された時にname属性をナンバリングしなおす
     * @param $list : js_itemクラスの親要素
     */
    function numbering($list) {
        //渡されたlistの中にjs_itemクラスの要素があるか探す
        $list.children('.js_item').each(function (index) {
            console.log(index);
            //〇日目
            if($(this).children('.js_date_text')){
                $(this).children('.js_date_text').html((index+1) + "日目");
            }
            //.js_itemの中にjs_inputクラスの要素があるか探す
            $(this).children('.js_input').each(function () {
                //js_inputクラス要素の数だけ処理する
                //name属性の[x]の部分を書き換える
                var replaceText = $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']');
                //name属性をつけなおす
                $(this).attr('name', replaceText);
            })

            if ($list.is('[data-input="dates"]')){
                $(this).find('.js_input').each(function () {
                    var replaceText = $(this).attr('name').replace(/\d+\[/, (1+index) + '[');
                    $(this).attr('name', replaceText);
                })
            }
        })
    }

    //追加
    var $items = $('.js_items');
    $items.on('click', '.js_add_btn', function () {
        var $list = $(this).prev('.js_item_list');

        /**.itemが存在するかチェック
         * 存在するときは.itemのクローンを作成、
         * 存在しない時は新しく.itemを作成
         */
        if ($list.find('.js_item').length == 0) {
            //存在しない
            console.log($list.is('[data-input="detials"]'));
            console.log($list.is('[data-input="dates"]'));
            console.log($list.is('[data-input="spots"]'));

            //リストのdate-input属性の値がdetailsの時
            if ($list.is('[data-input="detials"]')) {
                $list.append(
                    '<li class="js_item">' +
                    '<input type="text" name="detail_title[0]" class="js_input" placeholder="タイトル（例 持ち物リスト）"><br>' +
                    '<textarea type="text" name="detial_content[0]" class="js_input" placeholder="内容"></textarea>' +
                    '<button class="js_remove_btn">削除</button>' +
                    '</li>'
                );
            } else if ($list.is('[data-input="dates"]')) {
                //data-input = dates
                $list.append(
                    '<li class="js_item">' +
                    '<input type="hidden" class="js_date_length" name="date_length" value="1">' +
                    '<p class="js_date_text">1日目</p>' +
                    '<div class="js_items">' +
                    '<ul class="js_item_list" data-input="spots">' +
                    '<li class="js_item">' +
                    '<input type="time" name="spot_time_1[0]" class="js_input">' +
                    '<input type="text" name="spot_title_1[0]" class="js_input" placeholder="行程のタイトル">' +
                    '<textarea name="spot_description_1[0]" class="js_input" placeholder="詳細"></textarea>' +
                    '<input type="text" name="spot_address_1[0]" class="js_input" placeholder="住所"><br>' +
                    '<button class="js_remove_btn">削除</button>' +
                    '</li>' +
                    '</ul>' +
                    '<button class="js_add_btn">予定を追加</button><br>' +
                    '<button class="js_remove_btn">日にちを削除</button>' +
                    '</li>'
                );

            } else if ($list.is('[data-input="spots"]')) {
                $list.append(
                    '<li class="js_item">' +
                    '<input type="time" name="spot_time_1[0]" class="js_input">' +
                    '<input type="text" name="spot_title_1[0]" class="js_input" placeholder="行程のタイトル">' +
                    '<textarea name="spot_description_1[0]" class="js_input" placeholder="詳細"></textarea>' +
                    '<input type="text" name="spot_address_1[0]" class="js_input" placeholder="住所"><br>' +
                    '<button class="js_remove_btn">削除</button>' +
                    '</li>'

                );
            }

        } else {
            //存在する
            var $cloneItem = "";
            //日にちの追加だけ特殊な処理をする
            if ($list.is('[data-input="dates"]')) {
                //data-input = dates
                var $num = parseInt($(".js_date_length").val()) + 1;
                $cloneItem =
                    '<li class="js_item">' +
                    '<p class="js_date_text">' + $num + '日目</p>' +
                    '<div class="js_items">' +
                    '<ul class="js_item_list" data-input="spots">' +
                    '<li class="js_item">' +
                    '<input type="time" name="spot_time_' + $num + '[0]" class="js_input">' +
                    '<input type="text" name="spot_title_' + $num + '[0]" class="js_input" placeholder="行程のタイトル">' +
                    '<textarea name="spot_description_' + $num + '[0]" class="js_input" placeholder="詳細"></textarea>' +
                    '<input type="text" name="spot_address_' + $num + '[0]" class="js_input" placeholder="住所"><br>' +
                    '<button class="js_remove_btn">削除</button>' +
                    '</li>' +
                    '</ul>' +
                    '<button class="js_add_btn">予定を追加</button><br>' +
                    '<button class="js_remove_btn">日にちを削除</button>' +
                    '</li>';

                $(".js_date_length").val($num);

            } else {
                $cloneItem = $list.children('.js_item:last').clone();
                //value を空にする
                $cloneItem.find('.js_input').val("");
            }

            $list.append($cloneItem);

        }

        numbering($list);
        return false
    });


    //削除
    $(document).on("click", ".js_remove_btn", function () {

        console.log("remove");
        var $list = $(this).closest('.js_item_list');
        if ($list.is('[data-input="dates"]')) {
            var $num = parseInt($(".js_date_length").val()) - 1;
            $(".js_date_length").val($num);
        }
        console.log($list);
        $(this).closest('.js_item').remove();

        numbering($list);

        return false;
    });





})