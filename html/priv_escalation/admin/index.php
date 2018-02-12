<?php

session_start(array('cookie_path' => '/priv_escalation'));

// Check if user is logged in.
if(!isset($_SESSION['admin_login_id'])) {
    header('Location: /priv_escalation/admin/login_page.php');
    exit();
}

?>
<!DOCTYLE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>管理者用ページ</title>
        <link rel="stylesheet" type="text/css" href="/priv_escalation/style.css" />
    </head>
    <body>
        <h1>管理者用ページ</h1>
        <p>Congratulations!</p>
        <p>FLAG{CWE-639_4uth0rizat1on-6ypa$$|ng}</p>
    </body>
</html>
