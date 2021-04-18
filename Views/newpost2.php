<?php
session_start();
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");

// エスケープ
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

$newpost = $_POST["newpost"];

//print_r($_SESSION['User']['id']);



?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(新規投稿内容確認画面)</title>

<body>
	<head>
	 <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    </head>

<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center">知の共有倉庫</h1>
	</div>
</header>

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2">以下の内容で新規投稿しますか？</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
		<div class="mx-auto col-md-3 pb-2 text-center form-group">
			 <form action="newpost3.php" method="post">
		<div class="mx-auto mt-2">
			<p><?= h($newpost);?></p>
			<input type="hidden" name="newpost" value="<?= $newpost; ?>">
		</div>

		</div>

		<div class="mt-1 text-center">
			<button class="btn-primary rounded-pill w-25" onclick="location.href='newpost3.php'">この内容で投稿する</button>
		</div>
	        </form>
	</div>
	<div class="center-block m-4">
	<p class="text-center">新規投稿内容を<a href="newpost.php">修正する</a></p>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>


</body>



<!--
	<h1>新規投稿内容確認画面</h1>
	<h2>以下の内容で投稿しますか？</h2>

	<form>
		<textarea name="textarea"></textarea>
		<button type="submit">新規投稿する</button>
	</form>
	<a href="">内容を修正する</a>
	<a href="index.php">マイページへ</a>

-->