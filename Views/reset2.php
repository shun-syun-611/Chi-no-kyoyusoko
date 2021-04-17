<!DOCTYPE html>
<html lang="ja">

<head>
	<!-- メタディスクリプション -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>知の共有倉庫(リセットメール)</title>
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

	<div class="center-block bg-light pb-5 pt-4">
		<h3 class="text-center p-2">パスワード再設定画面</h3>
	<!--<h3 class="text-center mb-4">ログインページ</h3>-->
	<div class="d-flex flex-column pt-2">
	<form class="text-center form-group">

		<div class="mx-auto col-md-3 pb-2">
			<input placeholder="パスワード" class="form-control" type="password" name="password">
		</div>


		<div class="mt-3">
			<button class="btn-primary rounded-pill w-25">新しいパスワードを設定</button>
		</div>
	</form>
	</div>
	<div class="center-block m-4">
	<p class="text-center">ログイン画面は<a href="login2.html">こちら</a></p>
	</div>
	</div>

<!--ここは、footer.phpから引っ張ってくる-->
<footer class="footer text-center mt-5">
	<small>©️2021 chinokyoyusoko inc.</small>
</footer>


</body>

<!--ベースに以下の内容を入れ込む
	<h1>パスワード再設定画面</h1>
	<p>新しいパスワードを再設定してください。</p>
	<form>
		<label for="email">resetmail></label>
		<input type="reset2" name="reset2">
		<button type="submit">パスワードを登録</button>
	</form>
-->
