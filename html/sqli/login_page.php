<?php

session_start(array('cookie_path' => '/sqli'));

?>
<!DOCTYPE html>
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
        <form action="/sqli/login.php" method="POST">
            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" />
            <label for="password">Password:</label>
            <input type="password" name="password" />
            <input type="submit" value="Login" />
        </form>
        <hr />
        <a href="/sqli/">[Back]</a>
    </body>
</html>
