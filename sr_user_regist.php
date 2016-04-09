<h1>会員登録入力画面</h1>

<?php

// pre_user_idの値を取得
/*
if (isset($mode)) {
    $mode = "regist_form";
    $pre_user_id = $_GET["pre_user_id"];
} else {
    print '$modeは空です。';
    print "<p>URLが有効ではありません。</p>";
}
 * */
if ( $mode == "regist_form" ) {
    $pre_user_id = $_GET["pre_user_id"];
}

// print '<p>$pre_user_id='.$pre_user_id."</p>";

// 取得したキーをもとに登録されたIDを取得
$sql = "SELECT * FROM user_kaiin WHERE ( pre_user_id = :pre_user_id); ";
$stmt = $conn -> prepare( $sql );
$stmt->bindParam ( ":pre_user_id", $pre_user_id );
$stmt->execute();
$result = $stmt->fetch();
/*
echo "<pre>";
print $result["email"];
echo "</pre>";
*/
?>

<form method="POST" action="./sr_user_index.php" class="form-horizontal">
    <input type="hidden" name="mode" value="regist_confirm">
    <input type="hidden" name="pre_user_id" value="<?php print $pre_user_id; ?>">

    <div class="form-group">
            <label for="user_id" class="col-sm-4 control-label">ユーザ名</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="user_id" id="user_id">
                <p>英小文字、数字、アンダースコアが使えます。4文字以上15文字以内で入力してください。</p>
            </div>
    </div>

    <div class="form-group">
            <label for="email" class="col-sm-4 control-label">メールアドレス</label>
            <div class="col-sm-8">
                <p><?php echo $result["email"]; ?></p>
                <input type="hidden" name="email" value="<?php echo $result["email"]; ?>">
            </div>
    </div>

    <div class="form-group">
            <label for="password" class="col-sm-4 control-label">パスワード</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password" id="password">
                <p>英小文字、数字が使えます。6文字以上15文字以内で入力してください。</p>
            </div>
    </div>

    <p class="text-center"><input type="submit" name="submit" class="btn btn-default btn-lg" value="入力内容を確認する"></p>

</form>