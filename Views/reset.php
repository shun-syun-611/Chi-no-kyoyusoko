<?php
session_start();
$message = "";
require("../config/config.php");
require("../Models/User.php");
$message = "";

ini_set("display_errors", "On");

//function h($post){
  //return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
//}

//トライの後には、キャッチを用意しておかないとエラーになるよ！
try{
	$User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
}

//if($_POST){
	//echo "ポスト送信はできてる！";
	//if($User->login($_POST)){
	//	echo "ログインできました";
	//}
	//else{
	//	"ログインできませんでした";
	//}
//}


catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

 //$mail = $_POST["mail"];
 //$password = $_POST["password"];

//print_r($_POST["mail"]);
//echo "<br>";
//print_r($_POST["password"]);
//echo "<br>";

//if($_POST){
//	echo "ポスト送信できてる";
//}
//echo "<br>";

if($_POST){
	$result = $User->reset($_POST);
	if(!empty($result)){
		$_SESSION['User'] = $result;
		header('Location:change.php');
	}
	else{
		$message = "ユーザ名とメールアドレスが一致しません！";
	}
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(リセットメール)</title>
	 <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>


<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center">知の共有倉庫</h1>
	</div>
</header>

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2">パスワード再設定画面</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
	<form class="text-center form-group" method="post">

		<p class="text-danger"><?php if(empty($result)) echo $message ;?></p>
		<div class="mx-auto col-md-3 pb-2">
			<input placeholder="ユーザ名" class="form-control mb-2" type="name" name="name">
			<input placeholder="メールアドレス" class="form-control" type="mail" name="mail">
		</div>


		<div class="mt-3">
			<button class="btn-primary rounded-pill w-25"  href="reset2.php">パスワードを再設定</button>
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






<!--ベースに以下の内容を入れ込む

	<p>登録済みのメールアドレスを入力してください</p>
	パスワードリセットの方法については調べる
	<form>
		<label for="email">resetmail></label>
		<input type="reset" name="reset">
		<button type="submit">再設定メールを送信</button>
	</form>
-->

</body>