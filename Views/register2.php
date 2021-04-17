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

session_start();

 $name = $_POST["name"];
 $mail = $_POST["mail"];
 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//echo password_hash($_POST['password'], PASSWORD_DEFAULT);

//register.phpの所の入力内容をPOSTで受け取れてる！
 //print_r($_POST["name"]);
 //echo '<br>';
 //print_r($_POST["email"]);
 //echo '<br>';
 //print_r($_POST["password"]);

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
    </head>

<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center">知の共有倉庫</h1>
	</div>
</header>

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2 mb-4">この内容でユーザ新規登録しますか？</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">

	<div class="text-center form-group">

<!--ケアレスのスペルミス多いから気をつけて！-->
<form action="register3.php" method="post">
        <div class="mx-auto col-md-3">
		  <p>ユーザ名: <?= h($name);?></p>
		</div>

        <div class="mx-auto col-md-3 mt-2">
		  <p>Eメール: <?= h($mail);?></p>
		</div>

        <div class="mx-auto col-md-3 mt-2">
		  <p>パスワード: ＊＊＊＊</p>
		</div>

		<!--隠しフォームでデータベースにPOST送信！-->
			<input type="hidden" name="name" value="<?= h($name); ?>">
			<input type="hidden" name="mail" value="<?= h($mail); ?>">
			<input type="hidden" name="password" value="<?= h($password); ?>">

		<div class="mt-5">
			<button type="submit" class="btn-primary rounded-pill w-25">新 規 登 録</button>
		</div>
</form>
	</div>

	<div class="center-block m-4">
	<p class="text-center">修正する場合は<a href="register.php">こちら</a></p>
	</div>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>



<!--
	<h1>ユーザ登録内容確認画面</h1>
	隠しフォームを入れる
	<form>
		<label for="name">ユーザ名></label>
		<input type="text" name="name">
		<label for="email">メールアドレス></label>
		<input type="text" name="email">
		<label for="password"></label>
		<input type="password" name="password">
		<button type="submit">上記の内容で新規登録</button>
	</form>
	<a href="register.php">登録内容を修正</a>
-->

</body>