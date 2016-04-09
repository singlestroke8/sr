<?php

require './function.php';
// modeによって切り替え
/*
if (isset($mode)) {
    $mode = $_POST["mode"];
} else {
    $mode = "";
}
 * */
// modeの初期化
$mode = isset($_POST["mode"]) ? $_POST["mode"] : NULL;

if ( isset($_GET["pre_user_id"])) {
    $mode = "regist_form";
}
/*
if ( $_GET["pre_user_id"] != "" ) {
    $mode = "regist_form";
}
*/
// 振り分け処理
switch ( $mode ) {
    // メールアドレスの登録確認
    case "email_confirm";
    $page = "sr_user_email_confirm.php";
    $title = "メールアドレス送信フォーム";
    break;
    
    // メールアドレスの登録と仮ID送信
    case "email_regist";
    $page = "sr_user_email_regist.php";
    $title = "ユーザ登録URL送信";
    break;

    // 会員登録フォーム
    case "regist_form";
    $page = "sr_user_regist.php";
    $title = "ユーザ登録入力フォーム";
    break;

    // 会員登録確認
    case "regist_confirm";
    $page = "sr_user_confirm.php";
    $title = "ユーザ登録確認";
    break;

    // 会員登録
    case "regist_regist";
    $page = "sr_user_submit.php";
    $title = "ユーザ登録完了";
    break;

    // メールアドレスの登録
    default;
    $page = "sr_user_email.php";
    $title = "メールアドレス送信フォーム";
    break;

}

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>

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
        <?php
        echo '$mode='.$mode."<br>\n";
        echo '$page='.$page."<br>\n";
        // echo dirname(__FILE__);
        // echo realpath(dirname(__FILE__));
        require_once dirname(__FILE__) ."\\".$page;
        ?>
    </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
