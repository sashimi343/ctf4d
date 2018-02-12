<?php

require_once(dirname(__FILE__).'/functions.inc.php');

session_start(array('cookie_path' => '/priv_escalation'));

function show_error($message) {
    echo '<p><font color="red">'.$message.'</font></p>';
    echo '<p><a href="/priv_escalation/top.php">[Back]</a></p>';
    exit();
}

// ログインしていない場合、エラーとする(CWE-425: Forced Browsing 対策)
if(!isset($_SESSION['login_id'])) {
    show_error('ログインしてください。');
}

$login_id = $_SESSION['login_id'];
$author_name = $_POST['author_name'];
$body = $_POST['body'];

if(!is_string($author_name) || !is_string($body)) {
    show_error('名前やメッセージには文字列を入力してください。');
}

if(post($login_id, $author_name, $body)) {
    header('Location: /priv_escalation/top.php');
} else {
    show_error('書き込みに失敗しました。');
}

?>
