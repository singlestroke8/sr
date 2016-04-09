<h1>【会員用】メールアドレス</h1>

<?php

foreach (['email', 'submit'] as $key) {
    $$key = (string)filter_input(INPUT_POST, $key);
}

if ($submit){
    $email = h($_POST["email"]);

    // 仮ユーザーIDの発行
    $pre_user_id = uniqid(rand(100, 999));
    // SQL文を発行
    $sql_temp = "INSERT INTO user_kaiin ( pre_user_id, email )
        VALUES ( :pre_user_id, :email )";
    $stmt = $conn->prepare( $sql_temp );
    $stmt->bindParam(":pre_user_id", $pre_user_id);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $error = $stmt->errorInfo();
    if ( $error[0] != "00000" ){
        $errmessage = "データベースに登録できませんでした。{$error[2]}";
    } else {
        $errmessage = "データ更新成功。データ番号：".$conn->lastInsertId();

        // メール送信
        mb_language ( "japanese" );
        mb_internal_encoding ( "UTF-8" );

        $to = $email;
        $subject = "会員登録URL送信メール";
        $message  = "{$email}さん\n\n\nこのたびは、会員ご登録のメールアドレスを送信していただき、誠にありがとうございます。\n";
        $message .= "下記URLにアクセスしてご登録手続き(無料)をお願いいたします。\n\n";
        $message .= "http://localhost:81/study/sr_user_index.php?pre_user_id={$pre_user_id}\n\n\n";
        $message .= "※本メールにお心あたりが無い場合、他の方が誤ってあなたのメールアドレスを入力した可能性があります。たいへんお手数ですが、下記よりお問い合わせください。\n\n";
        $header = "From:baba.makoto.mobile@gmail.com";

        if ( mb_send_mail( $to, $subject, $message, $header )) {
            echo "<h2>送信先メールアドレス</h2>\n";
            echo "<p><strong>{$email}</strong></p>\n";
        } else {
            echo "{$email}へメールが送信できませんでした。<br><br><a href=\"http://localhost:81/study/sr_user_index.php?pre_user_id={$pre_user_id}\">遷移先はこちら</a>";
        }
    }
}

?>