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
$setsumonYear = mb_substr($setsumonYear, 2,2);
$setsumonNum   = isset($row['num']) ? $row['num']: null;
$setsumonKigou = isset($row['kigou']) ? $row['kigou']: null;
$setsumon      = isset($row['setsumon']) ? $row['setsumon']: null;
$seitou        = isset($row['seitou']) ? $row['seitou']: null;
$kaisetsu      = isset($row['kigou']) ? $row['kaisetsu']: null;


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>設問編集入力画面</title>

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
</style>
  </head>
  <body>
<div class="container-fluid">
<div class="row">

<h1>設問編集入力画面</h1>

<form method="POST" action="./sr_update_confirm.php" class="form-horizontal">

<div class="form-group">
	<label for="kamoku" class="col-sm-2 control-label">科目名</label>
	<div class="col-sm-5">
            <select class="form-control" name="kamoku">
                <option value="">科目を選択</option>
                <?php
                $kamokuArray = array("労働基準法","労働安全衛生法","労災保険法","雇用保険法","徴収法","労働一般","社会一般","健康保険法","厚生年金保険法","国民年金法");
                for ( $i = 0; $i <= count($kamokuArray); $i++ ){
                    if ( $kamokuArray[$i] == $kamoku ) {
                        print "<option value=\"{$kamokuArray[$i]}\" selected=\"selected\">{$kamokuArray[$i]}</option>\n";
                    }
                    print "<option value=\"{$kamokuArray[$i]}\">{$kamokuArray[$i]}</option>\n";
                }
                ?>
            </select>
	</div>
</div>

<div class="form-group">
	<label for="uname" class="col-sm-2 control-label">年度</label>
	<div class="col-sm-3">
            <select class="form-control" name="setsumonYear">
                <?php
                $year = "";
                for ( $year = 12; $year < 28; $year++ ){
                        if ( $year == $setsumonYear ){
                            print "<option value=\"平成{$year}年度\" selected=\"selected\">平成{$year}年度</option>";
                        }
                print "<option value=\"平成{$year}年度\">平成{$year}年度</option>";
                }
                ?>
            </select>
	</div>
        
	<div class="col-sm-2">
            <select class="form-control" name="setsumonNum">
                <?php
                $toi = "";
                for ( $toi = 1; $toi <= 10; $toi++ ){
                    if ( $toi == $setsumonNum ) {
                        print "<option value=\"{$toi}\" selected=\"selected\">問{$toi}</option>";
                    }
                print "<option value=\"{$toi}\">問{$toi}</option>";
                }
                ?>
            </select>
	</div>

 	<div class="col-sm-2">
            <select class="form-control" name="setsumonKigou">
                <?php
                $kigou =array("A","B","C","D","E");
                foreach ($kigou as $value){
                    if ( $value == $setsumonKigou ) {
                        print "<option value=\"{$value}\" selected=\"selected\">{$value}</option>";
                    }
                    print "<option value=\"{$value}\">{$value}</option>";
                }
                ?>
            </select>
	</div>       
        
</div>
    
    
<div class="form-group">
    <label for="setsumon" class="col-sm-2 control-label">設問</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="setsumon" rows="3" id="setsumon"><?php print $setsumon; ?></textarea>
    </div>
</div>
        

<div class="form-group">
        <label for="seitou" class="col-sm-2 control-label">正答</label>
	<div class="col-sm-10">
		<label class="radio-inline">
			<input type="radio" name="seitou" value="○"
                        <?php
                        if ($seitou == "○") { print "checked=\"checked\""; }
                        ?>> ○
		</label>
		<label class="radio-inline">
			<input type="radio" name="seitou" value="×"
                        <?php
                        if ($seitou == "×") { print "checked=\"checked\""; }
                        ?>> ×
		</label>
	</div>
</div>

<div class="form-group">
    <label for="kaisetsu" class="col-sm-2 control-label">解説</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="kaisetsu" rows="3" id="kaisetsu"><?php print $kaisetsu; ?></textarea>
    </div>
</div>
    
    <p class="text-center"><input type="submit" name="confirm" class="btn btn-default btn-lg" value="編集内容を確認する"></p>

</form>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
