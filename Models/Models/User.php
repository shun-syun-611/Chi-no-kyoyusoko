<?php


//Models/Db.phpを呼び出し
require_once("Db.php");

//Dbクラスからのメソッドを引き継ぐ
class User extends Db {

	//参照 SELECT 管理者
    public function findAll(){
        $sql = 'SELECT * FROM users';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //参照 SELECT タイムラインページ 内部結合して、ユーザ名とidを結合して表示
    public function timeline(){
        //$sql = 'SELECT * FROM users_posts';
        $sql = 'SELECT * FROM users INNER JOIN users_posts ON users.id = users_posts.user_id';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //参照 自分の投稿を取得
    public function findmyPost($user_id){
        $sql = 'SELECT * FROM users_posts WHERE user_id = :user_id';
        $stmt = $this->connect->prepare($sql);
        $data = array(":user_id"=>$user_id["user_id"]);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $result;
    }

    //参照 投稿idを全表示
    public function findAllposted(){
        $sql = 'SELECT id FROM users_posts';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $fpresult = $stmt->fetchAll();
        return $fpresult;
    }


    //新規登録 INSERT 暗号化してパスワード送れてる！
	public function add($arr){
		$sql = "INSERT INTO users(name,mail,password) VALUES(:name,:mail,:password)";
		$stmt = $this->connect->prepare($sql);
		$params = array(
			':name'=>$arr['name'],
			':mail'=>$arr['mail'],
			':password'=>$arr['password']
			//':created'=>date('Y-m-d H:i:s')
		);
		$stmt->execute($params);
	}

	//新規投稿のメールアドレスバリデーション
	public function addmailCheck($arr){
		$sql ="SELECT * FROM users WHERE mail =:mail";
		$stmt = $this->connect->prepare($sql);
		$params = array(':mail'=>$arr['mail']);
		$stmt->execute($params);
		//$result = $stmt->rowCount();
		$result = $stmt->fetch();
		return $result;
	}

	//新規投稿 NEWPOST
	public function newpost($arr){
		$sql = "INSERT INTO users_posts(post,user_id) VALUES(:post,:user_id)";
		$stmt = $this->connect->prepare($sql);
		$params = array(
			':post'=>$arr['post'],
			':user_id'=>$arr['user_id']
			//':created'=>date('Y-m-d H:i:s')
		);
		$stmt->execute($params);
	}

	//いいねをされてるかされてないかの判定（一旦保留）
	public function favoritesFindAll($arr) {
        $sql = "SELECT COUNT(*) FROM favorites WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $this->connect->prepare($sql);
        $params = array(":user_id"=>$arr["user_id"],":post_id"=>$arr["post_id"]);
        $stmt->execute($params);
        $favresult = $stmt->fetch(PDO::FETCH_ASSOC);
        return $favresult;
    }

    //ログイン中のユーザがいいねをしたメッセージを全て取得(いいね表示用)
    public function favoritesDone($user_id){
    	$sql = "SELECT post_id FROM favorites WHERE user_id = :user_id";
    	$stmt = $this->connect->prepare($sql);
    	$data = array(":user_id"=>$user_id["user_id"]);
    	$stmt->execute($data);
    	while($liked = $stmt->fetch()) {
    	$likesd[] = $liked;
    	}
    	return $likesd;
    }

    //ログイン中のユーザがいいねをしたメッセージを全て取得(お気に入りページ表示用)
    //public function favoritesDone($user_id){
   // 	$sql = "SELECT post_id FROM favorites WHERE user_id = :user_id";
   // 	$stmt = $this->connect->prepare($sql);
   // 	$data = array(":user_id"=>$user_id["user_id"]);
   // 	$stmt->execute($data);
   // 	while($liked = $stmt->fetch()) {
   // 	$likesd[] = $liked;
   // 	}
   // 	return $likesd;
   //}

    //ここでログインユーザがいいね済みの投稿を取得する！（お気に入りページ）
    public function favline($user_id){
        //$sql = 'SELECT * FROM users_posts';
        $sql = 'SELECT u.name, p.post, p.created_at FROM users_posts AS p INNER JOIN favorites AS f ON p.id = f.post_id INNER JOIN users AS u ON p.user_id = u.id WHERE f.user_id = :user_id';
        $stmt = $this->connect->prepare($sql);
        $data = array(":user_id"=>$user_id["user_id"]);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $result;
    }



	//public function pressed(){
	//$sql = "SELECT COUNT(*) AS cnt FROM favorites WHERE post_id AND user_id";
	//$stmt = $this->connect->prepare($sql);
	//$params = array(
	//	$_REQUEST['like'],
	//	$_SESSION['User']['id']
	//);
	//$stmt->execute($params);
	//$results = $stmt->fetch();
	//return $results;
	//}


	//いいね！ favorite 動作確認OK!
	public function favorite($arr){
		$sql = "INSERT INTO favorites(user_id,post_id) VALUES(:user_id,:post_id)";
		$stmt = $this->connect->prepare($sql);
		$params = array(
			':user_id'=>$arr['user_id'],
			':post_id'=>$arr['post_id']
			//':created'=>date('Y-m-d H:i:s')
		);
		$stmt->execute($params);
	}

	//いいね！削除　Delete favorite 動作確認OK!
	public function favdelete($arr) {
        $sql = "DELETE FROM favorites WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $this->connect->prepare($sql);
        $params = array(":user_id"=>$arr["user_id"],":post_id"=>$arr["post_id"]);
        $stmt->execute($params);
    }


    //ログイン　パスワード認証できるようにする必要あり！
	public function login($arr){
		$sql ="SELECT * FROM users WHERE mail =:mail AND password =:password";
		$stmt = $this->connect->prepare($sql);
		$params = array(':mail'=>$arr['mail'],':password'=>$arr['password']);
		$stmt->execute($params);
		//$result = $stmt->rowCount();
		$result = $stmt->fetch();
		return $result;
	}

	//ログイン　パスワード認証できるようにする必要あり！→Emailでまずは検索をかける→そのEmailの一致したユーザが持つパスワードを抽出→入力したPassとDBパスワードを比較して一致したら、ログイン成功に進ませる！
	public function loginHash($arr){
		$sql = "SELECT * FROM users WHERE mail =:mail";
		$stmt = $this->connect->prepare($sql);
		$params = array(':mail'=>$arr['mail']);
		$stmt->execute($params);
		//$result = $stmt->rowCount();
		$result = $stmt->fetch();
		return $result;
	}

	//パスワードを忘れた方向けの別ルートログイン
	public function reset($arr){
		$sql ="SELECT * FROM users WHERE name =:name AND mail =:mail";
		$stmt = $this->connect->prepare($sql);
		$params = array(':name'=>$arr['name'],':mail'=>$arr['mail']);
		$stmt->execute($params);
		//$result = $stmt->rowCount();
		$result = $stmt->fetch();
		return $result;
	}

	 //ユーザ情報変更 ここの更新日時の部分は思い込みで修正に時間がかかった。常に自分が思い込みをしていないか、ルールや基本を抜かしていないかを自問せよ！
	public function edit($arr){
    $sql = 'UPDATE users SET mail = :mail, password = :password, updated_at = :updated_at WHERE id = :id';
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(":mail", $arr['mail']);
    $stmt->bindParam(":password", $arr['password']);
    $stmt->bindParam(":id", $arr['id']);
    $stmt->bindValue(":updated_at", date('Y-m-d H:i:s'));
    $stmt->execute();
  }


	//削除 DELETE
	public function delete($id = null){
    if(isset($id)){
      $sql = 'DELETE FROM users WHERE id = :id';
      $stmt = $this->connect->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    }
  }

  //削除 DELETE
	public function deletepost($id = null){
    if(isset($id)){
      $sql = 'DELETE FROM users_posts WHERE id = :id';
      $stmt = $this->connect->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    }
  }

  //ユーザ削除 DELETE
	public function Withdrawal($id = null){
    if(isset($id)){
      $sql = 'DELETE FROM users WHERE id = :id';
      $stmt = $this->connect->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    }
  }


}

?>