<?php
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");

//function h($post){ 後でここ設定は反映させる
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

//print_r($_POST);


if($_POST){ //既に登録されているメールアドレスの場合は弾く
	$result = $User->addmailCheck($_POST);
	if(!$result == 0){
	//echo "既に登録されているメールアドレスです";
	}
	else{
	$User->add($_POST);
	//echo "登録成功！";
	}
}


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
	<?php if(!$result == 0) :?>
		<h2 class="text-center mb-4">既に登録されているメールアドレスがあります！</h2>
		<h2 class="text-center mb-5">別のメールアドレスで登録してください</h2>
		<div class="text-center">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='register.php'">新 規 登 録 ペ ー ジ へ</button>
	    </div>
	<?php else : ?>
	    <h2 class="text-center mb-4">新規登録完了！</h2>
		<h2 class="text-center mb-5">知の共有倉庫へようこそ！</h2>
		<div class="text-center">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='index.php'">マ イ ペ ー ジ へ</button>
	    </div>
	<?php endif; ?>

	
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>


<!--
<body>
	<h1>ユーザ登録完了！</h1>
	<h2>知の共有倉庫へようこそ！</h2>
	<a href="index.php">マイページへ</a>
</body>
-->