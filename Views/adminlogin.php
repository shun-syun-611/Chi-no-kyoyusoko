<?php
session_start();
$message = "";
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
	$result = $User->loginHash($_POST);
	if(!empty($result)){
		$_SESSION['Admin'] = $result;
		if(password_verify($_POST['password'], $_SESSION['Admin']['password'])){
			header('Location:admin.php');
		}
		else{
			$message = "メールアドレスまたは、パスワードが違います";
		}
	}
	else{
		$message = "メールアドレスまたは、パスワードが違います";
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
<title>知の共有倉庫(管理者ログイン画面)</title>

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
	<h1 class="text-center">知の共有倉庫(管理者画面)</h1>
	</div>
</header>


	<div class="center-block bg-light pb-5 pt-4">
		<div><?php echo $message ?></div>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
	<form class="text-center form-group" method="post">
	    <!--<div class="mb-1"><label for="email">メールアドレス</label></div>-->
		<div class="mx-auto col-md-3 pb-2"><input placeholder="メールアドレス" class="form-control" type="email" name="mail"></div>
		<!--<div class="mt-2 mb-1"><label for="password">パスワード</label></div>-->
		<div class="mx-auto col-md-3"><input placeholder="パスワード" class="form-control" type="password" name="password"></div>
		<div class="mt-3"><button class="btn-primary rounded-pill w-25">ロ グ イ ン</button></div>
	</form>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>

</body>