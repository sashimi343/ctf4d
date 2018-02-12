<?php

session_start(array('cookie_path' => '/sqli_revolutions'));

?>
<!DOCTYLE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login page</title>
    </head>
    <body>
        <h1>Login page</h1>
<?php

if(isset($_SESSION['login_error'])) {
    echo '<p style="color:red">'.$_SESSION['login_error'].'</p>';
    unset($_SESSION['login_error']);
}

?>
        <form action="/sqli_revolutions/login.php" method="POST">
            <label for="id">ID (user number):</label>
            <!--
            <select name="id">
                <option value="1">admin</option>
                <option value="2">user</option>
                <option value="3">test</option>
            </select>
            -->
            <input type="text" name="id" />
            <label for="password">Password:</label>
            <input type="password" name="password" />
            <input type="submit" value="Login" />
        </form>
        <hr />
        <a href="/sqli_revolutions/">[Back]</a>
    </body>
</html>
