<?php
session_start();
require_once("../config/config.php");
require_once("../Models/User.php");

ini_set("display_errors", "On");



//トライの後には、キャッチを用意しておかないとエラーになるよ！
try{
	$User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
}

catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

 $id = $_SESSION['Admin']['id'];
 $mail = $_SESSION['Admin']['mail'];
 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(管理者情報変更画面)</title>

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
	<h1 class="text-center">知の共有倉庫(管理者画面)</h1>
	</div>
</header>

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2">以下の内容で情報変更してよろしいでしょうか？</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
	<form class="text-center form-group" action="adminchange3.php" method="post">

        <div class="mx-auto col-md-3 mt-2">
		  <p>メールアドレス: <?php echo $_SESSION['Admin']['mail'] ;?></p>
		</div>

        <div class="mx-auto col-md-3 mt-2">
		  <p>パスワード: ****</p>
		</div>

		<!--隠しフォームでデータベースにPOST送信！-->
		    <input type="hidden" name="id" value="<?= $id; ?>">
			<input type="hidden" name="mail" value="<?= $mail; ?>">
			<input type="hidden" name="password" value="<?= $password; ?>">

		<div class="mt-3">
			<button class="mx-auto btn-primary rounded-pill w-25">情 報 変 更 す る</button>
		</div>
	</form>
	</div>
	<div class="center-block m-4">
	<p class="text-center">情報変更内容を<a href="adminchange.php">修正</a></p>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>
</body>








<!--
	<h1>情報確認画面</h1>
	<h2>以下の内容で変更してよろしいですか？</h2>
	<form>
		<label for="email">メールアドレス</label>
		<input type="reset" name="reset">
		<label for="email">パスワード</label>
		<input type="password" name="password">
		<button type="submit">この内容で変更</button>
	</form>
	<a href="change.php">修正する</a>
</body>
-->