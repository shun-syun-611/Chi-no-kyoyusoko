<?php
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");

function h($post){
  return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
}

//トライの後には、キャッチを用意しておかないとエラーになるよ！
try{
	$User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
}

catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}




?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(ユーザ登録画面)</title>

<body>
	<head>
	 <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>

    <script>

    	$(function(){ //新規登録バリデーション

    		$(".button").on("click",function(){
    			if($(".name").val() === "" || $(".name").val().length > 1){
            alert("ユーザ名を1文字以上で入力してください");
            return false;
                 }
    			else if($(".mail").val() === "" || !$('.mail').val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){//メールバリデーション
            alert("必須項目を入力、\nまたはメールアドレスを正しく入力してください");
            return false;
                 }
                else if($(".pass").val() === "" || $(".pass").val().length < 4){
            alert("パスワードを4文字以上で入力してください");
            return false;
                 }
    		});
    	});
    </script>




    </head>

<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center">知の共有倉庫</h1>
	</div>
</header>

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2">ユーザ登録画面</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
    <!--新規登録フォーム（新規登録内容確認ページへ）-->
	<form name="" action="register2.php" method="post" class="text-center form-group">

		<div class="mx-auto col-md-3 pb-2">
			<input placeholder="ユーザ名" class="name form-control" type="name" name="name">
		</div>

		<div class="mx-auto col-md-3 pb-2">
			<input placeholder="メールアドレス" class="mail form-control" type="mail" name="mail">
		</div>

		<div class="mx-auto col-md-3">
			<input placeholder="パスワード(8文字以上、英数字推奨)" class="pass form-control" type="password" name="password">
		</div>

		<div class="mt-3">
			<button type="submit" class="button btn-primary rounded-pill w-25">登録内容の確認</button>
		</div>
	</form>
	</div>
	<div class="center-block m-4">
	<p class="text-center">ログイン画面は<a href="login2.php">こちら</a></p>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>




<!--

ベースを元にして、項目に変えて、作る
	確認画面へ送る
	<form>
		<label for="name">ユーザ名></label>
		<input type="text" name="name">
		<label for="email">メールアドレス></label>
		<input type="text" name="email">
		<label for="password"></label>
		<input type="password" name="password">
		<button type="submit">登録内容の確認</button>
	</form>

-->

</body>