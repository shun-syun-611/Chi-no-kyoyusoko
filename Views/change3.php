<?php
session_start();
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


 //$mail = $_POST['mail'];
 //$password = $_POST['password'];

//register.phpの所の入力内容をPOSTで受け取れてる！
 //print_r($_POST["id"]);
 //echo '<br>';
 //print_r($_POST['mail']);
 //echo '<br>';
 //print_r($_POST['password']);


 if($_POST){
	$User->edit($_POST);
	//echo "情報変更成功！";
}

if(!isset($_SESSION['User'])){
	header('Location:login2.php');
	exit;
}

//ログアウト処理
if(isset($_GET['logout'])){
	$SESSION = array();
	session_destroy();
}

//ログイン画面を経由しているかの確認。直接アクセスは、ログイン画面へ遷移
if(!isset($_SESSION['User'])){
	header('Location:login2.php');
	exit;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(新規投稿完了画面)</title>

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
	<h1 class="text-center"><a href="index.php" class="text-white text-decoration-none">知の共有倉庫</a></h1>
	</div>
</header>

	<div class="pt-5">
		<h2 class="text-center mb-4">情報変更完了！</h2>
	<div class="text-center">
		<a class="btn btn-primary" href="index.php?logout">新パスワードでログイン</a>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>

</body>







<!--
	<h1>情報変更完了</h1>
	<a href="index.php">マイページへ</a>
-->