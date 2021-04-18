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

$newpost = $_POST["newpost"];
//print_r($_SESSION['User']['id']);

if($_POST){
	$post = array('post'=>$newpost, 'user_id'=>$_SESSION['User']['id']);
	//print_r($post);
	$User->newpost($post);
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
		<h2 class="text-center mb-4">新規投稿しました！</h2>
	<div class="text-center">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='timeline.php'">タ イ ム ラ イ ン へ</button>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>

</body>




<!---
	<h1>新規投稿完了！</h1>
	<a href="timeline.php">タイムラインへ</a>

-->