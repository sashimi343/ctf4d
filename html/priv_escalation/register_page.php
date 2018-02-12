<?php

session_start(array('cookie_path' => '/priv_escalation'));

?>
<!DOCTYLE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Register | CTF BBS</title>
        <link rel="stylesheet" type="text/css" href="/priv_escalation/style.css" />
    </head>
    <body>
        <h1>Register</h1>
<?php

if(isset($_SESSION['register_error'])) {
    echo '<p style="color:red">'.$_SESSION['register_error'].'</p>';
    unset($_SESSION['register_error']);
}

?>
        <form action="/priv_escalation/register.php" method="POST">
            <input type="hidden" name="account_type" value="U" />
            <p>
                <label for="user_id">ユーザID:</label>
                <input type="text" name="user_id" />
            </p>
            <p>
                <label for="password">パスワード:</label>
                <input type="password" name="password" />
            </p>
            <p>
                <label for="name">ユーザ名:</label>
                <input type="text" name="name" />
            </p>
            <p>
                <input type="submit" value="登録" />
            </p>
        </form>
        <hr />
        <a href="/priv_escalation/top.php">[Back]</a>
    </body>
</html>
