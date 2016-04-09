<?php
session_start();
if (isset($_POST["confirm"])){
    //print "postされてる";
    $kamoku = isset($_POST["kamoku"])? $_POST["kamoku"]: null;
    $setsumonYear = isset($_POST["setsumonYear"])? $_POST["setsumonYear"]: null;
    $setsumonNum = isset($_POST["setsumonNum"])? $_POST["setsumonNum"]: null;
    $setsumonKigou = isset($_POST["setsumonKigou"])? $_POST["setsumonKigou"]: null;
    $setsumon = isset($_POST["setsumon"])? $_POST["setsumon"]: null;
    $seitou = isset($_POST["seitou"])? $_POST["seitou"]: null;
    $kaisetsu = isset($_POST["kaisetsu"])? $_POST["kaisetsu"]: null;

    $errors = array();
    if (empty($kamoku)) {
        $errors["kamoku"] = "科目名を選択してください。";
    }
    if (empty($setsumonYear)) {
        $errors["setsumonYear"] = "出題年度を選択してください。";
    }
    if (empty($setsumonNum)) {
        $errors["setsumonNum"] = "設問番号を選択してください。";
    }
    if (empty($setsumonKigou)) {
        $errors["setsumonKigou"] = "設問記号を選択してください。";
    }
    if (empty($setsumon)) {
        $errors["setsumon"] = "設問を入力してください。";
    }
    if (empty($seitou)) {
        $errors["seitou"] = "正答を選択してください。";
    }
    if (empty($kaisetsu)) {
        $errors["kaisetsu"] = "解説を入力してください。";
    }
    $_SESSION["kamoku"]        = $kamoku;
    //print $_SESSION["kamoku"];
    $_SESSION["setsumonYear"]  = $setsumonYear;
    $_SESSION["setsumonNum"]   = $setsumonNum;
    $_SESSION["setsumonKigou"] = $setsumonKigou;
    $_SESSION["setsumon"]      = $setsumon;
    $_SESSION["seitou"]        = $seitou;
    $_SESSION["kaisetsu"]      = $kaisetsu;
}

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
    <title>設問入力確認画面</title>

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

<h1>設問入力確認画面</h1>

<form method="POST" action="./sr_setumon_submit.php" class="form-horizontal">

<div class="form-group">
	<label for="kamoku" class="col-sm-2 control-label">科目名</label>
	<div class="col-sm-10">
            <?php if (isset($errors["kamoku"])): ?>
            <p class="text-danger"><?php print $errors["kamoku"]; ?></p>
            <?php endif; ?>
            <?php if ($_SESSION["kamoku"]): ?>
            <?php print "<p>".h($kamoku)."</p>"; ?>
            <?php endif; ?>
	</div>
</div>

<div class="form-group">
	<label for="setsumonYear" class="col-sm-2 control-label">年度</label>
	<div class="col-sm-10">
            <?php if (isset($errors["setsumonYear"])): ?>
            <p class="text-danger"><?php print $errors["setsumonYear"]; ?></p>
            <?php endif; ?>
            <?php if ($_SESSION["setsumonYear"]): ?>
            <?php print "<p>".h($setsumonYear); ?>
            <?php endif; ?>

            <?php if (isset($errors["setsumonNum"])): ?>
            <p class="text-danger"><?php print $errors["setsumonNum"]; ?></p>
            <?php endif; ?>
            第
            <?php if ($_SESSION["setsumonNum"]): ?>
            <?php print h($setsumonNum); ?>
            <?php endif; ?>
            問
            
            <?php if (isset($errors["setsumonKigou"])): ?>
            <p class="text-danger"><?php print $errors["setsumonKigou"]; ?></p>
            <?php endif; ?>
            <?php if ($_SESSION["setsumonKigou"]): ?>
            <?php print h($setsumonKigou)."</p>"; ?>
            <?php endif; ?>

        </div>        
</div>
    
    
<div class="form-group">
    <label for="setsumon" class="col-sm-2 control-label">設問</label>
    <div class="col-sm-10">
            <?php if (isset($errors["setsumon"])): ?>
            <p class="text-danger"><?php print $errors["setsumon"]; ?></p>
            <?php endif; ?>
            <?php if ($_SESSION["setsumon"]): ?>
            <?php print "<p>".h($setsumon)."</p>"; ?>
            <?php endif; ?>
    </div>
</div>
        

<div class="form-group">
        <label for="seitou" class="col-sm-2 control-label">正答</label>
	<div class="col-sm-10">
            <?php if (isset($errors["seitou"])): ?>
            <p class="text-danger"><?php print $errors["seitou"]; ?></p>
            <?php endif; ?>
            <?php if ($_SESSION["seitou"]): ?>
            <?php print "<p>".h($seitou)."</p>"; ?>
            <?php endif; ?>
	</div>
</div>

<div class="form-group">
    <label for="kaisetsu" class="col-sm-2 control-label">解説</label>
    <div class="col-sm-10">
            <?php if (isset($errors["kaisetsu"])): ?>
            <p class="text-danger"><?php print $errors["kaisetsu"]; ?></p>
            <?php endif; ?>
            <?php if ($_SESSION["kaisetsu"]): ?>
            <?php print "<p>".nl2br(h($kaisetsu))."</p>"; ?>
            <?php endif; ?>
    </div>
</div>
    
    <p class="text-center"><input type="submit" name="submit" class="btn btn-default btn-lg" value="確認する"></p>

</form>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>