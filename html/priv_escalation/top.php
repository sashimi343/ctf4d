<?php

require_once(dirname(__FILE__).'/functions.inc.php');

session_start(array('cookie_path' => '/priv_escalation'));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>CTF BBS</title>
        <link rel="stylesheet" type="text/css" href="/priv_escalation/style.css" />
    </head>
    <body>
        <h1>CTF BBS</h1>
<?php

if(isset($_SESSION['login_id'])) {
    echo '<p>こんにちは、'.h($_SESSION['user_name'], ENT_QUOTES).'さん。</p>';
    echo '<p><a href="/priv_escalation/logout.php">ログアウト</a></p>';
} else {
    echo '<p>ようこそ、ゲストさん。掲示板に書き込むためには、<a href="/priv_escalation/login_page.php">ログイン</a>または<a href="/priv_escalation/register_page.php">ユーザ登録</a>が必要です。</p>';
}

?>
        <hr />
        <?php include(dirname(__FILE__).'/posts.inc.php'); ?>
        <?php include(dirname(__FILE__).'/post_form.inc.php'); ?>
        <hr />
        <a href="/priv_escalation/admin/login_page.php">[管理者用ページ]</a>
    </body>
</html>
