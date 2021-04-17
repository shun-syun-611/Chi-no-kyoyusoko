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
    $result = $User->findAll();
    rsort($result);

    //echo "<pre>";
    //foreach($result as $row) {
    //print_r($row);
    //}
    //echo "</pre>";

    //削除処理
    if(isset($_GET['del'])){
    	$User->delete($_GET['del']);
    //削除後の参照
        $result = $User->findAll();
    }

    // 接続を閉じる ずっと、これを残していたらから、このコード以降の情報が切られていて、配列の中が空になっていた！
    //$result = null;
    //$User = null;
    }

  catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }


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
	<h1 class="text-center"><a href="admin.php" class="text-white text-decoration-none">知の共有倉庫(管理者画面)</a></h1>
	</div>
</header>


<div>
	<h3 class="text-center m-4">ユーザ一覧</h3>
	<table class="table table-bordered">
		<tr scope="col">
			<th scope="row">ユーザID</th>
			<th>ユーザ名</th>
			<th>メールアドレス</th>
			<th>パスワード</th>
			<th>属性</th>
			<th>作成日</th>
			<th>更新日</th>
			<th>強制退会</th>
		</tr>
	  	<?php foreach($result as $row): ?>
		<tr>
	    <th><?php echo h($row['id']) ?></th>
        <th><?php echo h($row['name']) ?></th>
        <th><?php echo h($row['mail']) ?></th>
        <th><?php echo h($row['password']) ?></th>
        <th><?php echo h($row['attribute']) ?></th>
        <th><?php echo h($row['created_at']) ?></th>
        <th><?php echo h($row['updated_at']) ?></th>
	     <th><a href="?del=<?= $row['id'] ?>" onClick="if(!confirm('ユーザ名 : <?= $row['name'] ?>を削除しますか？'))return false">退会させる</a></th>
		</tr>
	    <?php endforeach; ?>
    </table>
</div>



<!--ここは、footer.phpから引っ張ってくる

<tr>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th><a href="">削除</a></th>
		</tr>
		<tr>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th><a href="">削除</a></th>
		</tr>
		<tr>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th><a href="">削除</a></th>
		</tr>
		<tr>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th>ここにループで表示</th>
			<th><a href="">削除</a></th>
		</tr>


-->
<footer class="footer text-center mt-5 p-2 bg-dark">
	<small class="text-white">©️2021 <a href="admin.html" class="text-white text-decoration-none">chinokyoyusoko</a> inc.</small>
</footer>

</body>
