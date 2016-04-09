<?php
    
// DB接続設定
$dbtype = "mysql";
$sv = "localhost";
$dbname = "sr";
$user = "root";
$pass = "";

$dsn = "$dbtype:dbname=$dbname;host=$sv";
$conn = new PDO ( $dsn, $user, $pass );



function h ($var) {
    if (is_array($var)){
        return array_map(h, $var);
    } else {
        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    }
}