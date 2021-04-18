// ajax.jsの練習

$(function(){

  var $orders = $('#orders'); //index.phpの出力箇所のidを取得からの変数へ
  var $name = $('#name'); //inputタグのnameを追加
  var $drink = $('#drink'); //inputタグのdrinkを追加

//指定する相対パスでうまくいかないことが多いので、気をつけるように！

  $.ajax({
    dataType: 'json',//データタイプはjsonを指定
    type: 'GET', //値を得たいからGET
    url: '../Views/api.php', //ajaxBasicのなかのapi.phpにアクセス
    success: function(orders){ //通信成功時の処理
      console.log(orders); //consoleにArrayで{jsonデータ}が出ていたらOK
      $.each(orders,function(i,order){
        $orders.append('<li>氏名: '+ order.name + ', 飲み物: ' + order.drink + '</li>'); //eachで回してorderそれぞれの要素をorder.name / order.drinkとして出力
      })
      //alert('非同期通信成功だーーー！！');

    },
    error: function(){ //通信失敗時の処理
      alert('非同期通信失敗！');
    }
  });
  

  //ここから送信処理を記述
  $('#add-order').on('click',function(){
    var order = {
      name: $name.val(),
      drink: $drink.val(),
    };

    $.ajax({
      dataType: 'json',
      type: 'POST',
      url: '../Views/apiPost.php',
      data: {data : order},
      success: function(orders){
        console.log(orders);
        $orders.append('<li>氏名: '+ orders.name + ', 飲み物: ' + orders.drink + '</li>');
      },
      error: function(){
        alert('エラーです！');
      }
    });
  });






























});

