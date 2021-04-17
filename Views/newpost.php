<?php
session_start();
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");

//function h($post){
  //return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
//}

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
<title>知の共有倉庫(新規投稿画面)</title>


	<head>
	 <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>

    <script>
    	$(function(){ //1文字以上、400字以内以外は入力できない
    		$("button").on("click",function(){
    			if($(".post").val() === " " || $(".post").val() === "　" || $(".post").val() === "" || $(".post").val().length > 400){
    				alert("1文字以上、400字以内で入力してください");
    				return false;
    			}
    		});
    	});
    </script>




    </head>
    <body>

<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center"><a href="index.php" class="text-white text-decoration-none">知の共有倉庫</a></h1>
	</div>
</header>

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2">新規投稿画面</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
		<div class="mx-auto col-md-3 pb-2 text-center form-group">
		<form action="newpost2.php" method="post">
			<textarea rows="5" placeholder="400字以内で学びを投稿できます。" class="form-control post" type="form" name="newpost"></textarea>
		</div>

		<div class="mt-3 text-center">
			<button class="btn-primary rounded-pill w-25 btn">内 容 の 確 認</button>
		</div>
		</form>
	</div>
	<div class="center-block m-4">
	<p class="text-center">マイページに<a href="index.php">戻る</a></p>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>


</body>







<!--
	<h1>新規投稿画面</h1>

	<form>
		<textarea name="textarea">こちらにあなたの学びを入力してください。</textarea>
		<button type="submit">内容確認</button>
	</form>
	<a href="index.php">マイページへ</a>

-->
