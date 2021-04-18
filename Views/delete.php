<?php
session_start();
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");

function h($post){
  return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
}

  try{
    $User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
    }


  catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }

   //print_r($_SESSION['User']["id"]);
    //echo '<br>';
    //print_r($_SESSION['User']["name"]);
    //echo '<br>';
    //print_r($_SESSION['User']["password"]);


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
		<h3 class="text-center p-2">本当にアカウントを削除してよろしいですか？</h3>
		<!--ここに「本当に削除してよろしいですか？」のアラートを入れる-->
		<div class="mt-3 text-center" onclick="location.href='delete2.php?del'">
			<button class="btn-primary rounded-pill w-25">ア カ ウ ン ト を 削 除</button>
		</div>
	</div>
	<div class="center-block m-4">
	<p class="text-center">マイページは<a href="index.php">こちら</a></p>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>
</body>








</body>


<!--
	<h1>アカウント削除画面</h1>
	<h2>本当にアカウントを削除しますか？</h2>
	<a href="index.php">キャンセル</a>
	<a href="delete2.php">アカウントを削除</a>
-->