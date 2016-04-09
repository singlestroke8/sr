<?php
session_start();

require './function.php';

if ( !isset($_POST["login"]) ) {
    inputForm();
} else {
    
    // フォームの値を取得
    foreach (['form_email', 'form_password', 'login'] as $key) {
    $$key = (string)filter_input(INPUT_POST, $key);
    // print "キーは".$key."<br>";
    }

    $form_email    = h($_POST["form_email"]);
    $form_password = h($_POST["form_password"]);
    
    // 未入力
    if ( ($form_email === "") || ($form_password === "") ) {
        error(1);
    } else {
        $dbPassword = NULL;
        $dbkaiinFlg = NULL;
        // ID、パスワード入力あり →  user_kaiinのテーブルデータを取得
        $query = "SELECT * FROM user_kaiin WHERE (email = :form_email);";
        $stmt = $conn->prepare( $query );
        $stmt->bindParam( ":form_email", $form_email, PDO::PARAM_STR );
        $stmt->execute();
        while ( $data = $stmt->fetch() ) {
            if ( $data["email"] === $form_email ) {
                $dbPassword = $data["password"];
                // 数値型に変換
                $dbkaiinFlg = intval($data["kaiin_flg"]);
                break;
            }
        }
        print "<pre>";
        print_r($data);
        print "</pre>";
        //パスワードのハッシュ化
        $options = array( 'cost' => 10 );
        $hash_form_password = password_hash( $form_password, PASSWORD_DEFAULT, $options );
        // 検索されたユーザIDのパスワードに値がない＝ユーザIDをが違う

        // var_dump($dbkaiinFlg);
        if ( $dbkaiinFlg === 0 ) {
            error (2);
        } else if ( !isset($dbPassword) ) {
            error (3);
        } else if ( $dbPassword !== $hash_form_password ) {
            error (4);
        } else {
            $_SESSION["loginUser"] = $form_user_id;
        }
    }
}

?>
<?php
//入力画面表示
function inputForm () {
    header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ユーザログイン</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
body { padding: 40px .5em; background-color: #EAF6FD; }
.container-fluid { width: 450px; }
.form-signin { width: 370px; margin: 0 auto; }
.col-sm-8 p,
.col-sm-8 ul { padding-top: 8px; }
.col-sm-8 input + p { padding-top: 3px; }
</style>
    </head>
    <body>

    <div class="container-fluid">
    <div class="row">
    <h1>ユーザログイン</h1>

    <form method="POST" action="sr_user_login.php" class="form-horizontal">

        <div class="form-group">
        <label for="email" class="col-sm-3 control-label">メールアドレス</label>
        <div class="col-sm-9">
            <input class="form-control input-lg" type="email" id="email" name="form_email" />
        </div>
        </div>
        
        <div class="form-group">
        <label for="password" class="col-sm-3 control-label">パスワード</label>
        <div class="col-sm-9">
            <input class="form-control input-lg" type="password" id="password" name="form_password" />
        </div>
        </div>

        <p class="text-center"><input type="submit" name="login" class="btn btn-default btn-lg" value="ログイン"></p>

    </form>
    </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>


<?php

}
function error ( $errorType ) {
    switch ( $errorType ) {
        
    case 1:
        $errorMsg = "メールアドレスとパスワードを入力してください。";
        break;
    case 2:
        $errorMsg = "会員登録されていません。";
        break;
    case 3:
        $errorMsg = "メールアドレスが違います。";
        break;
    case 4:
        $errorMsg = "パスワードが違います。";
        break;

    }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ユーザログインエラーページ</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
body { padding: 40px .5em; background-color: #EAF6FD; }
.container-fluid { width: 450px; }
.form-signin { width: 370px; margin: 0 auto; }
.col-sm-8 p,
.col-sm-8 ul { padding-top: 8px; }
.col-sm-8 input + p { padding-top: 3px; }
</style>
    </head>
    <body>

    <div class="container-fluid">
    <div class="row">
    <h1>ログインエラー</h1>
   　<?php
     print "<p class=\"text-danger\">".$errorMsg."</p>";
     ?>
    </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}
?>
