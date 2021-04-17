<?php
require_once("../config/config.php");
require_once("../Models/User.php");
session_start();
ini_set("display_errors", "On");

//$user = "root";
//$pass ="root"; ここまでは、config.phpから引っ張ってこれてる！

  //try {
  //  $User = new User($host,$dbname, $user, $pass);
  //  $User->connectDb();
  // $result = $User->findAll();

  try{
    $User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
  }
    //参照

//if(!isset($_SESSION['User'])){
 // header('Location:login2.php');
 // exit;
//}

  //print_r($result);


  catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }

    //print_r($_SESSION['Admin']);



//サニタイジング
//function h($post){
  //  return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
//}

//try{
  //  $User = new User($host,$dbname,$user,$pass);
    //$User->connectDb();
    //echo "connectDbまではいけてる！";
//}

//catch(PDOException $e){
//	echo 'エラー'.$e->getMessage();
//}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(管理者画面)</title>

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
	<h1 class="text-center">知の共有倉庫(管理者画面)</h1>
	</div>
</header>


	<div class="pt-5">

	<div class="text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='userlist.php'">ユーザ一覧</button>
	</div>

	<div class="mt-3 text-center">
		<button class="btn-sm btn-secondary rounded-pill w-25" onclick="location.href='postslist.php'">投稿一覧</button>
	</div>

	</div>


	<div class="d-flex flex-row mt-4 justify-content-center">
		<small class="mb-1 m-1"><a href="adminchange.php" class="">情報変更</a></small>
		<small class="m-1"><a href="adminlogout.php" class="">ログアウト</a></small>
	</div>



<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5 p-2 bg-dark">
	<small class="text-white">©️2021 <a href="index.php" class="text-white text-decoration-none">chinokyoyusoko</a> inc.</small>
</footer>

</body>
