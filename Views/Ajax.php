<?php
?>
<!-- index.php -->

<!DOCTYPE html>
<html>
<head>
  <title>ajax処理ー基礎ー</title>
  <link rel="stylesheet" type="text/css">
      <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/Ajax.js"></script>
<body>

  <h1>jQueryでAjax処理をしようpart1</h1>

  <h2>注文表</h2>
  <ul id="orders">
    

  </ul>

  <h4>注文フォーム</h4>
  <p>名前: <input type="text" id="name" name="name"></p>
  <p>飲み物: <input type="text" id="drink" name="drink"></p>
  <button id="add-order">注文を追加する</button>




</body>
</html>