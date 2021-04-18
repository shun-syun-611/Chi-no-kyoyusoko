$(function () {
    $('#favorite').on("click", function () {
        $.ajax({
            type: 'POST',
            url: 'ajax_getdata.php',
            data: {
                'text': "お気に入り"
            },
            dataType: 'json', //必須。json形式で返すように設定
        }).done(function (data) {
            //連想配列のプロパティがそのままjsonオブジェクトのプロパティとなっている
            console.log(data);
            alert('うまくajaxが動いてるよ！');
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert('うまくajaxが動いてないよ！');
        })
    })
})



