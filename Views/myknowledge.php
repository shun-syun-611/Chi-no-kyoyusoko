<?php
session_start();
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");


try{
    $User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
    //タイムラインを表示
    $user_id = array('user_id'=>$_SESSION['User']['id']);
    //print_r($favoritesDone);
    $findmyPost = $User->findmyPost($user_id);
    rsort($findmyPost);
    //print_r($findmyPost);
}


    catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }

?>


<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(お気に入り)</title>

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
		<h2 class="text-center mb-4">自分の学び -knowledge- </h2>

	<div class="text-center">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='newpost.php'">学 び を 投 稿 す る</button>
	</div>

	<div class="mx-auto"  style="width:400px">

		<?php foreach($findmyPost as $row): ?>

			<div class="border-top mt-5">
			
			<p class="h5 mt-3 pb-2">
			  👤 自分の投稿
			</p>
			
			<p>
			  <?php echo ($row['post']) ?>
			</p>
			
			<p class="small text-muted pt-1" style="text-align: right">
		      <?php echo ($row['created_at']) ?>
			</p>

    </div>
<?php endforeach; ?>
			</div>
		
	    </div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>

</body>



