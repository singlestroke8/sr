<h1>ユーザ登録用メールアドレス確認</h1>

<?php

foreach (['email', 'submit'] as $key) {
    $$key = (string)filter_input(INPUT_POST, $key);
    // print "キーは".$key."<br>";
}
// エラー配列初期化
$errors = [];

if ( isset ($_POST["submit"])){
    $email = $_POST["email"];
    // echo $email;
    
    $errors = [];
    
    // メールアドレスのチェック
    // 空欄
    if ( $email === "" ) {
        $errors[] = 'メールアドレスを入力してください';
    // 形式
    } else if ( !filter_var ( $email, FILTER_VALIDATE_EMAIL ) ) {
        $errors[] = 'メールアドレスの形式が正しくありません。';
    // 重複
    } else {
        $sql_email = "SELECT * FROM user_kaiin";
        $stmt = $conn -> prepare( $sql_email );
        $stmt->execute();
        // 万が一、メールアドレスが重複して登録された場合、その分エラーが出てしまう
        while ( $row = $stmt->fetch() ){
            if ( $row["email"] == $email ){
                $errors[] = 'ご希望のメールアドレスは既に使用されています。';
            }
        }
    }

}

?>

<form method="POST" action="sr_user_index.php" class="form-horizontal">
    <input type="hidden" name="mode" value="email_regist">

    <div class="form-group">
            <label for="email" class="col-sm-3 control-label">メールアドレス</label>
            <div class="col-sm-9">
                <?php if ($errors): ?>
                <ul>
                <?php foreach ($errors as $error): ?>
                    <li class="text-danger"><?=h($error)?></li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <p><?=h($email)?></p>
            </div>
    </div>
    
    <p class="text-center"><input type="button" class="btn btn-default" value="戻る" onclick="javascript:history.back();">
    <input type="submit" name="confirm" class="btn btn-default btn-lg" value="確認"></p>

</form>