<?php
session_start();
require_once("../config/config.php");
require_once("../Models/User.php");

ini_set("display_errors", "On");

//function h($post){
  //return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
//}

//ログアウト処理
//if(isset($_GET['logout'])){
	//セッションを破棄する
//	$_SESSION = array();
//}


//ログイン画面を経由しているかの確認。直接アクセスは、ログイン画面へ遷移、ここは後ほど、戻す
if(!isset($_SESSION['User'])){
	header('Location:login2.php');
	exit;
}

//ここのセッションのidを元に、今セッションのあるユーザーの情報変更ができそう！
//print_r($_SESSION['User']['id']);
//echo "<br>";
//print_r($_SESSION['User']['mail']);
//echo "<br>";
//print_r($_SESSION['User']['password']);


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
<title>知の共有倉庫(ユーザ情報変更画面)</title>

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
		<h3 class="text-center p-2">ユーザ情報変更画面</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
	<form class="text-center form-group" method="post" action="change2.php">

		<div class="mx-auto col-md-3 pb-2">
			<p>メールアドレス:<?php echo $_SESSION['User']['mail'] ;?></p>
		</div>

		<div class="mx-auto col-md-3">
			<p>▼以下に新しいパスワードを入力してください<input placeholder="" class="form-control" type="password" name="password" value=""></p>
		</div>

		<div class="mx-auto mt-3">
			<button class="btn-primary rounded-pill w-25">情報変更内容の確認</button>
		</div>
	</form>
	</div>
	<div class="center-block m-4">
	<!--<p class="text-center">マイページへ<a href="index.php">戻る</a></p>-->
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>
</body>




	<!--
<form>
		<label for="email">メールアドレス</label>
		<input type="reset" name="reset">
		<label for="email">パスワード</label>
		<input type="password" name="password">
		<button type="submit">変更内容を確認</button>
	</form>
-->
