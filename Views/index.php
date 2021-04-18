<?php
session_start();
require_once("../config/config.php");
require_once("../Models/User.php");

ini_set("display_errors", "On");

//function h($post){
  //return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
//}

//ログアウト処理
if(isset($_GET['logout'])){
	//セッションを破棄する
	$_SESSION = array();
}

//ログイン画面を経由しているかの確認。直接アクセスは、ログイン画面へ遷移
if(!isset($_SESSION['User'])){
	header('Location:login2.php');
	exit;
}

//print_r($_SESSION['User']);

//トライの後には、キャッチを用意しておかないとエラーになるよ！
try{
	$User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
}

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

//if($_POST){
//	if($User->login($_POST)){
//		echo "ログイン成功！";
//	}
//	else{
//		echo "ログイン失敗！";
//	}
//}



?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(ログイン画面)</title>

    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body class="">

<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center"><a href="index.php" class="text-white text-decoration-none">知の共有倉庫</a></h1>
	</div>
</header>



	<div class="pt-5">

		<!--<div>余裕があったら、◯◯さんこんにちは！のメッセージを出すようにする！</div>-->

   <?php if($_SESSION['User']['attribute']!= 0): ?>
	<div class="mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='userlist.php'">ユ ー ザ 一 覧</button>
	</div>

	<div class="mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='postslist.php'">投 稿 一 覧</button>
	</div>
   <?php endif; ?>

   <?php if($_SESSION['User']['attribute']!= 1): ?>
	<div class=" mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='newpost.php'">学 び を シ ェ ア</button>
	</div>

	<div class="mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='myknowledge.php'">自 分 の 学 び</button>
	</div>

	<div class="mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='timeline.php'">タ イ ム ラ イ ン</button>
	</div>

	<div class="mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='favorite.php'">お 気 に 入 り</button>
	</div>
   <?php endif; ?>

	</div>


	<div class="d-flex flex-row mt-5 justify-content-center">
		<small class="mb-1 m-1"><a href="change.php" class="small text-muted">情報変更</a></small>
		<small class="m-1"><a href="?logout=1" class="small text-muted">ログアウト</a></small>
		<small class="m-1"><a href="delete.php" class="small text-muted">アカウント削除</a></small>
	</div>


	<!--というか思ったのは、情報変更とか、ログアウトも下の方のリンクに一緒に置いておいた方が使いやすくね-->


<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center bg-dark mt-5 p-5">
	<div class="border-top border-white mt-5 mb-1 pb-2"></div>
	<div class="mb-3 mt-3">
		<small><a class="text-white text-decoration-none" href="newpost.php">学びをシェア /</a></small>
		<small><a class="text-white text-decoration-none" href="myknowledge.php">自分の学び /</a></small>
		<small><a class="text-white text-decoration-none" href="timeline.php">タイムライン /</a></small>
		<small><a class="text-white text-decoration-none" href="favorite.php">お気に入り</a></small>
	</div>
	<small class="text-white">©️2021 <a href="index.php" class="text-white text-decoration-none">chinokyoyusoko</a> inc.</small>
</footer>

</body>



<!--
	<h1>マイページ</h1>
	<div>
	  <a href="">学びをシェア</a>
	  <a href="">自分の学び</a>
	  <a href="">タイムライン</a>
	  <a href="">お気に入り</a>
    </div>

    <div>
	<a href="">情報変更</a>
	<a href="">ログアウト</a>
    </div>
-->

