<?php

require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");

function h($post){
  return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
}

//$user = "root";
//$pass ="root"; ここまでは、config.phpから引っ張ってこれてる！

  //try {
  //  $User = new User($host,$dbname, $user, $pass);
  //  $User->connectDb();
  // $result = $User->findAll();

  try{
    $User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
    //参照
    $result = $User->timeline();
    rsort($result);
    }

  catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }

    //削除処理
    if(isset($_GET['del'])){
    	$User->deletepost($_GET['del']);
    //削除後の参照
        $result = $User->timeline();
        rsort($result);
    }


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
	<h1 class="text-center"><a href="admin.php" class="text-white text-decoration-none">知の共有倉庫(管理者画面)</a></h1>
	</div>
</header>


<div>
	<h3 class="text-center m-4">投稿一覧</h3>
	<table class="table table-bordered">
	  <thead>
		<tr scope="col">
			<th scope="row">投稿ID</th>
			<th>投稿内容</th>
			<th>ユーザID</th>
			<th>作成日</th>
			<th>投稿管理</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($result as $row): ?>
		<tr>
	    <th><?php echo h($row['id']) ?></th>
        <th><?php echo h($row['post']) ?></th>
        <th><?php echo h($row['user_id']) ?></th>
        <th><?php echo h($row['created_at']) ?></th>
	    <th><a href="?del=<?= $row['id'] ?>" onClick="if(!confirm('投稿 : <?= $row['post'] ?>を削除しますか？'))return false">投稿削除</a></th>
		</tr>
		</tr>
      <?php endforeach; ?>
	  </tbody>
	</table>
</div>



<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5 p-2 bg-dark">
	<small class="text-white">©️2021 <a href="admin.html" class="text-white text-decoration-none">chinokyoyusoko</a> inc.</small>
</footer>

</body>
