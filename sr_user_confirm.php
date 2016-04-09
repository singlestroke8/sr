<h1>会員登録確認画面</h1>

<?php
session_start();

foreach (['pre_user_id','user_id', 'email', 'password', 'submit'] as $key) {
    $$key = (string)filter_input(INPUT_POST, $key);
    // print "キーは".$key."<br>";
}
// エラー配列初期化
$errorsUser = [];
$errorsPass = [];

// POSTされたときだけ実行
if ($submit) {
    //$pre_user_id = isset ( $_GET["pre_user_id"]) ? $_GET["pre_user_id"]: NULL;
    //echo $pre_user_id;
            
    if ( $user_id === "" ) {
        $errorsUser[] = 'ユーザ名を入力してください';
    }
    if (!preg_match('/\A\w{4,15}\z/', $user_id)) {
        $errorsUser[] = 'ユーザ名は半角英数字またはアンダースコアで4～15文字で入力してください';
    }
    $sql = "SELECT * FROM user_kaiin WHERE kaiin_flg = 1";
    $stmt = $conn -> prepare( $sql );
    $stmt->execute();
    while ( $row = $stmt->fetch() ){
        if ( $row["user_id"] == $user_id ){
           $errorsUser[] = "ご希望のユーザ名は既に使用されています。";
        }
    }
    if ( $password === "" ) {
        $errorsPass[] = 'パスワードを入力してください';
    }
    if (!preg_match('/\A\w{6,15}\z/', $password)) {
        $errorsPass[] = 'パスワードは半角英数字で6～15文字で入力してください';
    }
    $passNum = strlen ( $password );
    
    // エラーが無ければ
    if (!$errorsUser && !$errorsPass) {
    
        $pre_user_id = h($pre_user_id);
        $user_id = h($user_id);
        $password = h($password);
        
        $_SESSION["pre_user_id"] = $pre_user_id;
        $_SESSION["user_id"] = $user_id;
        $_SESSION["password"] = $password;
        
    }
}

?>

<form method="POST" action="./sr_user_index.php" class="form-horizontal">
    <input type="hidden" name="mode" value="regist_regist">
    <input type="hidden" name="pre_user_id" value="<?php print $pre_user_id; ?>">

    <div class="form-group">
            <label for="userid" class="col-sm-4 control-label">ユーザー名</label>
            <div class="col-sm-8">
                <?php if ($errorsUser): ?>
                <ul>
                <?php foreach ($errorsUser as $error): ?>
                    <li class="text-danger"><?=h($error)?></li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <p><?=h($user_id)?></p>
            </div>
    </div>

    <div class="form-group">
            <label for="email" class="col-sm-4 control-label">メールアドレス</label>
            <div class="col-sm-8">
                <p><?=h($email)?></p>
            </div>
    </div>

    <div class="form-group">
            <label for="password" class="col-sm-4 control-label">パスワード</label>
            <div class="col-sm-8">
                <?php if ($errorsPass): ?>
                <ul>
                <?php foreach ($errorsPass as $error): ?>
                    <li class="text-danger"><?=h($error)?></li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <p><?php
                    for ( $i=0; $i<$passNum; $i++ ) {
                        echo "*";
                    }
                ?></p>
            </div>
    </div>

    <p class="text-center"><input type="button" class="btn btn-default" value="戻る" onclick="javascript:history.back();">
    <input type="submit" name="submit" class="btn btn-default btn-lg" value="会員登録する"></p>

</form>