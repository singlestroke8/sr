<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>管理者ユーザー追加完了</title>

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

<h1>管理者ユーザー追加完了</h1>

<?php
require './lib/password.php';

if (isset($_POST["submit"])){
    $dbtype = "mysql";
    $sv = "localhost";
    $dbname = "sr";
    $user = "root";
    $pass = "";

    $name     = isset($_POST["name"])? $_POST["name"]: null;
    $email    = isset($_POST["email"])? $_POST["email"]: null;
    $password = isset($_POST["password"])? $_POST["password"]: null;

    //　エラーの配列
    $errors = array();
    
    //　ユーザー名バリデーション
    if (empty($name)) {
        $errors["name"] = "ユーザー名を入力してください。";
    }
    
    //　メールアドレスバリデーション
    if (empty($email)) {
        $errors["email"] = "メールアドレスを入力してください。";
    } else if ( !filter_var ( $email, FILTER_VALIDATE_EMAIL ) ) {
        $errors["email"] = "メールアドレスの形式が正しくありません。";
    } else {
        $dsn = "$dbtype:dbname=$dbname;host=$sv";
        $conn = new PDO ( $dsn, $user, $pass );
        $sql_mail = "SELECT * FROM user_kanri";
        $stmt = $conn -> prepare( $sql_mail );
        $stmt->execute();
        while ( $row = $stmt->fetch() ){
            if ( $row["email"] == $email ){
                $errors["email"] = "ご希望のメールアドレスは既に使用されています。";
            }
        }
    }
    
    //　パスワードバリデーション
    $passlength = strlen($password);
    if (empty($password)) {
        $errors["password"] = "パスワードを入力してください。";
    } else if ( $passlength < 6 || $passlength > 10  ) {
        $errors["password"] = "パスワードは6文字以上10文字以内で入力してください。";
    } else if ( !preg_match( "/^[a-zA-Z0-9]+$/" , $password) ) {
        $errors["password"] = "パスワードは半角英数字で入力してください。";
    }

    if ( count($errors) !== 0 ){
        print "<pre>";
        var_dump($errors);
        print "</pre>";
        foreach ( $errors as $values ) {
            print "<p class=\"text-danger\">" .$values. "</p>";
        }
        print "<a href=\"javascript:history.back();\">戻る</a>";
    } else  {
        $name     = h($name);
        $email    = h($email);
        $password = h($password);
        $hashpass = password_hash ( $password, PASSWORD_DEFAULT );
        
        $sql = "INSERT INTO user_kanri ( name, email, password )
                VALUES ( :name, :email, :hashpass )";
        $stmt = $conn->prepare( $sql );
        $stmt->bindParam( ":name", $name );
        $stmt->bindParam( ":email", $email );
        $stmt->bindParam( ":hashpass", $hashpass );
        $stmt->execute();
        print "管理者登録完了";
        print "<p><a href=\"sr_index.php\">管理TOPへ</a></p>";
        
        $to = "baba.makoto@gmail.com";
        $title = "登録";
        $ext_header = "From:baba.makoto.mobile@gmail.com";
        $body = "--------------\n";
        $body .= "下記管理ユーザーの登録が完了しました。\n\n";
        $body .= "お名前：{$name}\n";
        $body .= "メールアドレス：{$email}\n";
        $body .= "パスワード：{$password}\n";
        $body .= "--------------";
        
        $rc = mb_send_mail($to, $title, $body, $ext_header);
        if ( !$rc ) {
            print "送信エラー";
        } else {
            print "送信完了";
            $_SESSION = NULL;
        }
    }
} else {
    print "postされていない";
}

function h ($var) {
    if (is_array($var)){
        return array_map(h, $var);
    } else {
        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    }
}

?>



</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
