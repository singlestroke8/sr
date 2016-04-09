<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>管理者ユーザー追加入力</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
body { padding: 40px .5em; background-color: #eee; }
.container-fluid { width: 450px; }
.form-signin { width: 370px; margin: 0 auto; }
</style>
  </head>
  <body>
<div class="container-fluid">
<div class="row">

<h1>管理者ユーザー追加入力</h1>

<form method="POST" action="./sr_kanri_submit.php" class="form-horizontal">

<div class="form-group">
	<label for="name" class="col-sm-3 control-label">ユーザー名</label>
	<div class="col-sm-9">
            <input class="form-control input-lg" type="text" id="name" name="name" placeholder="testname" />
	</div>
</div>

<div class="form-group">
	<label for="email" class="col-sm-3 control-label">メールアドレス</label>
	<div class="col-sm-9">
            <input class="form-control input-lg" type="text" id="email" name="email" placeholder="aaa@bbb.com" />
	</div>
</div>

<div class="form-group">
	<label for="password" class="col-sm-3 control-label">パスワード</label>
	<div class="col-sm-9">
            <input class="form-control input-lg" type="password" id="password" name="password" />
	</div>
</div>
    
    <p class="text-center"><input type="submit" name="submit" class="btn btn-default btn-lg" value="登録する"></p>

</form>

</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
