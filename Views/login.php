<?php

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
<title>知の共有倉庫(ログイン画面)</title>

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


	<div class="pt-5">

	<div class="text-center">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='login2.php'">ロ グ イ ン</button>
	</div>

	<div class="mt-3 text-center">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='register.php'">新 規 登 録</button>
	</div>

	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>

</body>