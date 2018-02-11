<?php

session_start(array('cookie_path' => '/sqli'));

// Check if user is logged in.
if(!isset($_SESSION['login_user'])) {
    header('Location: /sqli/login_page.php');
    exit();
}

?>
<!DOCTYLE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>My page</title>
    </head>
    <body>
        <h1>My page</h1>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['login_user'], ENT_QUOTES); ?></p>
        <hr />
        <a href="/sqli/logout.php">[Logout]</a>
    </body>
</html>
