<?php
//接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "sr";
$user = "root";
$pass = "";

$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO ( $dsn, $user, $pass );
$sql2 = "SELECT * FROM kakomon WHERE del_flg = 1";
$stmt = $conn->prepare($sql2);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>削除済一覧画面</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
body { padding: .5em; padding-top: 70px; }
h1 { margin: 0 0 1em; }
</style>
  </head>
  <body>

<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./sr_index.php">社労士試験択一式対策</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="./sr_index.php">Home</a></li>
        <li><a href="./sr_setumon_input.php">登録</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">科目別 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li><a href="./sr_delete_index.php">削除一覧</a></li>
      </ul>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</nav><!-- /.navbar -->
      
<div class="container-fluid">
<div class="row">

<h1>削除済一覧画面</h1>

<table class="table table-hover table-bordered">
<?php

while ($row = $stmt->fetch()){
    print "<tr>\n";
    print "<td>{$row["id"]}</td>\n";
    print "<td>{$row["kamoku"]}</td>\n";
    print "<td>{$row["year"]}</td>\n";
    print "<td>{$row["num"]}</td>\n";
    print "<td>{$row["kigou"]}</td>\n";
    print "<td width=\"50%\">".nl2br($row["setsumon"])."</td>\n";
    print "<td>\n";    
    print "<a href=\"sr_update.php?pid={$row["id"]}\">変更</a>｜\n";
    print "<a href=\"sr_return.php?pid={$row["id"]}\">戻す</a>｜\n";
    print "<a href=\"sr_detail.php?pid={$row["id"]}\">詳細</a>\n";
    print "</td>\n";
    print "</tr>\n";
}
?>
</table>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
