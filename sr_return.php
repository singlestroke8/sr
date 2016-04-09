<?php
session_start();

if (!isset($_GET["pid"])){
    print "セットされてない";
} else {
    $id = $_GET["pid"];
    $_SESSION["id"] = $id;
}

//接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "sr";
$user = "root";
$pass = "";

$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO ( $dsn, $user, $pass );
$sql = "SELECT * FROM kakomon WHERE ( id = :id );";
$stmt = $conn->prepare($sql);
$stmt->bindParam( ":id", $id );
$stmt->execute();
$row = $stmt->fetch();

$kamoku        = isset($row['kamoku']) ? $row['kamoku']: null;
$setsumonYear  = isset($row['year']) ? $row['year']: null;
$setsumonNum   = isset($row['num']) ? $row['num']: null;
$setsumonKigou = isset($row['kigou']) ? $row['kigou']: null;
$setsumon      = isset($row['setsumon']) ? $row['setsumon']: null;
$seitou        = isset($row['seitou']) ? $row['seitou']: null;
$kaisetsu      = isset($row['kigou']) ? $row['kaisetsu']: null;

function h ($var) {
    if (is_array($var)){
        return array_map(h, $var);
    } else {
        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>削除設問復帰確認画面</title>

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
<div class="container-fluid">
<div class="row">

<h1>削除設問復帰確認画面</h1>

<p>削除済から戻すの確認画面。</p>

<form method="POST" action="./sr_return_submit.php" class="form-horizontal">

<div class="form-group">
	<label for="kamoku" class="col-sm-2 control-label">科目名</label>
	<div class="col-sm-10">
            <?php if ($kamoku): ?>
            <?php print "<p>".h($kamoku)."</p>"; ?>
            <?php endif; ?>
	</div>
</div>

<div class="form-group">
	<label for="setsumonYear" class="col-sm-2 control-label">年度</label>
	<div class="col-sm-10">
            <?php if ($setsumonYear): ?>
            <?php print "<p>".h($setsumonYear); ?>
            <?php endif; ?>

            第<?php if ($setsumonNum): ?>
            <?php print h($setsumonNum); ?>
            <?php endif; ?>問

            <?php if ($setsumonKigou): ?>
            <?php print h($setsumonKigou)."</p>"; ?>
            <?php endif; ?>
        </div>        
</div>
    
    
<div class="form-group">
    <label for="setsumon" class="col-sm-2 control-label">設問</label>
    <div class="col-sm-10">
            <?php if ($setsumon): ?>
            <?php print "<p>".h($setsumon)."</p>"; ?>
            <?php endif; ?>
    </div>
</div>
        

<div class="form-group">
        <label for="seitou" class="col-sm-2 control-label">正答</label>
	<div class="col-sm-10">
            <?php if ($seitou): ?>
            <?php print "<p>".h($seitou)."</p>"; ?>
            <?php endif; ?>
	</div>
</div>

<div class="form-group">
    <label for="kaisetsu" class="col-sm-2 control-label">解説</label>
    <div class="col-sm-10">
            <?php if ($kaisetsu): ?>
            <?php print "<p>".nl2br(h($kaisetsu))."</p>"; ?>
            <?php endif; ?>
    </div>
</div>
    
    <p class="text-center"><input type="submit" name="submit" class="btn btn-default btn-lg" value="削除状態から戻す"></p>

</form>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
