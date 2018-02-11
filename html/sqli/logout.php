<?php

session_start(array('cookie_path' => '/sqli'));

$_SESSION = array();

if(ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 'deleted', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

session_destroy();

header('Location: /sqli/login_page.php');

?>
