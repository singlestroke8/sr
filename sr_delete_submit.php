<?php
session_start();

if ( isset($_POST["submit"]) ) {
    //print "submitされてる";
    $id = $_SESSION["id"];
    print $id;

    //接続設定
    $dbtype = "mysql";
    $sv = "localhost";
    $dbname = "sr";
    $user = "root";
    $pass = "";
    
    //接続
    $dsn = "$dbtype:dbname=$dbname;host=$sv";
    $conn = new PDO ( $dsn, $user, $pass );
    $del_flg = 1;

    $sql = "UPDATE kakomon SET
                del_flg = :del_flg,
                koushin  = NOW()
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":del_flg", $del_flg);
    $stmt->execute();
    

    $error = $stmt->errorInfo();
    if ( $error[0] != "00000" ){
        $message = "データ更新失敗{$error[2]}";
    } else {
        $message = "データ更新成功。データ番号：".$conn->lastInsertId();
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

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>設問削除完了画面</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
body { padding: .5em; }
.form-group p { padding-top: .5em; padding-bottom: .5em; }
</style>
  </head>
  <body>
<div class="container-fluid">
<div class="row">

<h1>設問削除完了画面</h1>
<p><?php print $message; ?></p>

<p><a href="./sr_index.php">一覧ページへ戻る</a></p>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
