<?php
session_start();
require("../config/config.php");
require("../Models/User.php");

ini_set("display_errors", "On");
$likesd ="";

//function h($post){
  //return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
//}

//$user = "root";
//$pass ="root"; ここまでは、config.phpから引っ張ってこれてる！

  //try {
  //  $User = new User($host,$dbname, $user, $pass);
  //  $User->connectDb();
  // $result = $User->findAll();

  try{
    $User = new User($host,$dbname,$user,$pass);
    $User->connectDb();
    //タイムラインを表示
    $result = $User->timeline();
    //新規投稿順
    rsort($result);
    //print_r(rsort($result));

    //if($User){
	//echo "PDO接続成功！";
	//}

    //echo "<pre>";
    //foreach($result as $row) {
    //print_r($row);
    //}
    //echo "</pre>";


    //$fpresult = $User->findAllposted();
    //print_r($fpresult);
    //echo "</br>";
    //foreach($result as $row){
      //echo "表示されているpostID　　 :";
      //print_r($row['id']);
      //echo "</br>";
    //}



//favoritesDoneをテスト
    $favoritesDone = array('user_id'=>$_SESSION['User']['id']);
    //print_r($favoritesDone);
    $likesd = $User->favoritesDone($favoritesDone);
    //print_r($likesd[1]); 二次元配列を作れてる
    //$liked_cnt = 0;
    //if(!empty($likesd)) {
    //  foreach($likesd as $liked_post){
    //    foreach($liked_post as $liked_post_id){
    //      if($liked_post_id == $row){
    //        $liked_cnt = 1;
    //      }
    //    }
        //liked_postの中にはログインユーザいいね済みの数字が入れられてる
        //echo "loginユーザいいね済投稿ID:";
        //print_r($liked_post);
        //echo "</br>";

        //print_r($liked_post); 中身をループ表示できてる
    //  }
    //}



//同期通信ではうまくいってるので、非同期通信を実装するために、一旦、コメントアウトにしておく↓↓

    //これで条件分岐をさせて、同じuser_idとpost_idがの組み合わせがあった場合、まだされてない場合で、処理を切り替えられる。↓これを裏でクリックごとに裏で動かせば、ajaxが完成ということだ！
   // $favorite = array('post_id'=>$_GET['like'],'user_id'=>$_SESSION['User']['id']);
   // echo "<br>";
   // print_r($favorite);
   // $favresult = $User->favoritesFindAll($favorite);
   // echo "<br>";
    //これでDB上への、お気に入り登録,削除処理は成功！
   // if(isset($_GET['like'])){
   //   if($favresult['COUNT(*)'] > 0){
   //     echo 'alreadyいいね！なので、いいねを取り消したよ！';
   //     $favresult = $User->favdelete($favorite);
   // }
   // else{
   //     echo 'yetいいね！なので、いいねを新しく追加したよ！';
   //     $favresult = $User->favorite($favorite);
   // }
   // $likesd = $User->favoritesDone($favoritesDone);
//}
//よし、ここでSQL文を走らせられたので、カウント数で条件分岐ができる！





    }


  catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }

    //これでクリックした投稿固有のIDは取得できた！あとは、クリックをした本人のIDをセッションから持ってきて、DBに登録する！
    //print_r($_GET['like']);
    //echo "<br>";
    //print_r($_SESSION['User']['id']);

    //ここでidがあるかないかを確認する。ただここも一旦保留。

    //if($my_like_cnt['cnt'] < 1){
    //	echo "まだいいねされていない！";
    //}

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
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<title>知の共有倉庫(タイムライン)</title>

    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>

    <script>

//parent関数では、データベースには正しく送信される。でも、CSSが変化しない

  $(function(){
    var $fav = $('.fav'), //いいねボタンセレクタ
                favPostId; //投稿ID
    $fav.on('click',function(e){
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性（postid）に格納された投稿ID取得
        favPostId = $(this).data('postid');
        $.ajax({
            type: 'POST',
            url: 'ajax_getdata.php', //post送信を受けとるphpファイル
            data: { postId: favPostId} //{キー:投稿ID}
        }).done(function(data){
            //alert('いいね！');

            // いいね取り消しのスタイル
            $this.children('i').toggleClass('far'); //空洞ハート
            // いいね押した時のスタイル
            $this.children('i').toggleClass('fas'); //塗りつぶしハート
            $this.children('i').toggleClass('active');
            $this.toggleClass('active');
        }).fail(function() {
            alert('Ajax通信失敗');
        });
    });
});

    </script>
</head>

<body>

<!--ここはheader.phpから引っ張ってくる-->
<header>
	<div class="p-5 bg-dark text-white">
	<h1 class="text-center"><a href="index.php" class="text-white text-decoration-none">知の共有倉庫</a></h1>
	</div>
</header>

	<div class="pt-5">
		<h2 class="text-center mb-5">タイムライン</h2>

	<div class="text-center pb-5">
		<button class="btn-primary rounded-pill w-25" onclick="location.href='newpost.php'">学 び を 投 稿 す る</button>
	</div>

		<div class="mx-auto"  style="width:400px">

		<?php foreach($result as $row): ?>

			<div class="border-top mt-5">
			
			<p class="h5 mt-3 pb-2">
			  👤 <?php echo ($row['name']) ?>
			</p>
			
			<p>
			  <?php echo ($row['post']) ?>
			</p>
			
			<p class="small text-muted pt-1" style="text-align: right">
		      <?php echo ($row['created_at']) ?>
			</p>
			
      <!--一旦、ここをsectionタグで作ってみる！
			<div id="favorites" class="post pb-3 m-3" style="text-align: right">
      -->

        <!--ここで、ログインユーザがいいねしてる投稿を判別-->
      <?php
        $liked_cnt = 0;
      if(!empty($likesd)){
        foreach($likesd as $liked_post){
          foreach($liked_post as $liked_post_id){
            if($liked_post_id == $row['id']){
            $liked_cnt = 1;
          }
          }
        }
        //print_r($liked_cnt);
      }
      ?>
      

      <!--ここで、ログインユーザがいいねしてる投稿には、いいね済みの表示-->
      <!--同期通信ではできてるので、非同期通信で実装するため、aタグを変更
        <?php if ($liked_cnt < 1) : ?>
        <p class="fav <?php echo ($row['id']) ?>" value="timeline.php?like=<?php echo ($row['id']) ?>">
                    &#9825;
                </p>
          <?php else : ?>
                <p class="fav <?php echo ($row['id']) ?>" value="timeline.php?like=<?php echo ($row['id']) ?>">
                    &#9829;
                </p>
          <?php endif; ?>
      -->

      <div class="fav text-danger m-2 float-end" data-postid="<?php echo ($row['id']) ?>">

     <?php if ($liked_cnt < 1) : ?>
        <i data-postid="<?php echo ($row['id']) ?>" class="fav2 fa-heart small far"></i>
     <?php else : ?>
            <i data-postid="<?php echo ($row['id']) ?>" class="fav2 fa-heart small active fas"></i>
     <?php endif; ?>

    </div>

			</div>
      
		<?php endforeach; ?>
	    </div>

	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center p-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>

</body>












<!--
	<h1>タイムライン</h1>
-->