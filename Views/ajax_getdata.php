<?php
session_start();
require("../config/config.php");
require("../Models/User.php");

try{ //DB接続
    $User = new User($host,$dbname,$user,$pass);
    $User->connectDb();

//既にいいねをしているものはDELETE、まだいいねしていないものはINSERT INTO

    $favorite = array('post_id'=>$_POST['postId'],'user_id'=>$_SESSION['User']['id']);
    print_r($favorite);
    $favresult = $User->favoritesFindAll($favorite);
    echo "<br>";
    //これでDB上への、お気に入り登録,削除処理は成功！
      if($favresult['COUNT(*)'] > 0){
        echo 'alreadyいいね！なので、いいねを取り消したよ！';
        $favresult = $User->favdelete($favorite);
    }
     else{
        echo 'yetいいね！なので、いいねを新しく追加したよ！';
        $favresult = $User->favorite($favorite);
     }
    
}
catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
    }

//if($_POST) {
     //ヘッダー情報の明記。必須。
     //$data = $_POST["postId"];
     //$send["post_id"] = $_POST["id"]; //お気に入りするサービスのid
     //$send["user_id"] = $_SESSION["id"]; //ログインユーザのid
     //header("Content-Type: application/json; charset=UTF-8");





 //   $post_id = $_POST["id"];
 //   // レコードがないか確認
 //   $count = $FavoriteController->check($send);
 //    if(empty($count)) {
        // お気に入り登録
 //       $FavoriteController->favoriteAdd($send);
 //       $send["answer"] = "お気に入りしました。";
 //   }else {
        // お気に入り解除
 //       $FavoriteController->favoriteDelete($send);
 //       $send["answer"] = "お気に入り解除";

 //   }


    //echo json_encode($data);
//}


?>