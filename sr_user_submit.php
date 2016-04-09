<h1>会員登録完了画面</h1>

<?php
session_start();

foreach (['submit'] as $key) {
    $$key = (string)filter_input(INPUT_POST, $key);
    // print "キーは".$key."<br>";
}
echo "foreachされた";
// POSTされたときだけ実行
// 前ページのname=submitが入っていること
if ($submit) {
    echo "submitされた";

    $pre_user_id = h($_SESSION["pre_user_id"]);
    $user_id     = h($_SESSION["user_id"]);
    $password    = h($_SESSION["password"]);
   
    //パスワードのハッシュ化
    $options = array( 'cost' => 10 );
    $hash = password_hash( $password, PASSWORD_DEFAULT, $options );
    $kaiin_flg = 1;

    $sql = "UPDATE user_kaiin SET
                user_id  = :user_id,
                password = :hash,
                kaiin_flg = :kaiin_flg,
                submit_date = NOW()
            WHERE pre_user_id = :pre_user_id";
    $stmt = $conn->prepare( $sql );
    $stmt->bindParam( ":pre_user_id", $pre_user_id );
    $stmt->bindParam( ":user_id", $user_id );
    $stmt->bindParam( ":hash", $hash );
    $stmt->bindParam( ":kaiin_flg", $kaiin_flg );
    $stmt->execute();
    print "<p>ユーザ登録完了しました。</p>";
    print "<p><a href=\"xxxx.php\">ユーザTOPへ</a></p>";
    session_destroy();

} else {
    echo "submitされていない";
}

?>