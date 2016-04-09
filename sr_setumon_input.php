<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>設問入力画面</title>

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

<h1>設問入力画面</h1>

<form method="POST" action="./sr_setumon_confirm.php" class="form-horizontal">

<div class="form-group">
	<label for="kamoku" class="col-sm-2 control-label">科目名</label>
	<div class="col-sm-5">
            <select class="form-control" name="kamoku">
                <option value="">科目を選択</option>
                <option value="労働基準法">労働基準法</option>
                <option value="労働安全衛生法">労働安全衛生法</option>
                <option value="労災保険法">労災保険法</option>
                <option value="雇用保険法">雇用保険法</option>
                <option value="徴収法">徴収法</option>
                <option value="労働一般">労働一般</option>
                <option value="社会一般">社会一般</option>
                <option value="健康保険法">健康保険法</option>
                <option value="厚生年金保険法">厚生年金保険法</option>
                <option value="国民年金法">国民年金法</option>
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
                    print "<option value=\"{$value}\">{$value}</option>";
                }
                ?>
            </select>
	</div>       
        
</div>
    
    
<div class="form-group">
    <label for="setsumon" class="col-sm-2 control-label">設問</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="setsumon" rows="3" id="setsumon"></textarea>
    </div>
</div>
        

<div class="form-group">
        <label for="seitou" class="col-sm-2 control-label">正答</label>
	<div class="col-sm-10">
		<label class="radio-inline">
			<input type="radio" name="seitou" value="○"> ○
		</label>
		<label class="radio-inline">
			<input type="radio" name="seitou" value="×"> ×
		</label>
	</div>
</div>

<div class="form-group">
    <label for="kaisetsu" class="col-sm-2 control-label">解説</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="kaisetsu" rows="3" id="kaisetsu"></textarea>
    </div>
</div>
    
    <p class="text-center"><input type="submit" name="confirm" class="btn btn-default btn-lg" value="確認する"></p>

</form>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
