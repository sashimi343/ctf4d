<?php

session_start(array('cookie_path' => '/priv_escalation'));

?>
<!DOCTYLE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login | CTF BBS</title>
        <link rel="stylesheet" type="text/css" href="/priv_escalation/style.css" />
    </head>
    <body>
        <h1>Login</h1>
<?php

if(isset($_SESSION['login_error'])) {
    echo '<p style="color:red">'.$_SESSION['login_error'].'</p>';
    unset($_SESSION['login_error']);
}

?>
        <form action="/priv_escalation/login.php" method="POST">
            <label for="user_id">ユーザID:</label>
            <input type="text" name="user_id" />
            <label for="password">パスワード:</label>
            <input type="password" name="password" />
            <input type="submit" value="ログイン" />
        </form>
        <hr />
        <a href="/priv_escalation/top.php">[Back]</a>
    </body>
</html>
