<?php

require_once(dirname(__FILE__).'/db_config.inc.php');
require_once(dirname(__FILE__).'/functions.inc.php');

session_start(array('cookie_path' => '/sqli_reloaded'));

// Get user ID and password.
$user_id = $_POST['user_id'];
$password = $_POST['password'];

// Validate user input.
if(!is_string($user_id) || empty($user_id)) {
    show_error('User ID is required.');
}

if(!is_string($password) || empty($password)) {
    show_error('Password is required.');
}

// Added: Check if user input contains a fragment of SQL.
// (Prevention of SQL Injection.)
if(detect_sql_injection($user_id)) {
    show_error('Fatal: SQL Injection attack is detected.');
}

// Get encrypted (SHA-256 hashed) password.
$encrypted_password = hash('sha256', $password);

try {
    // Open database connection.
    $pdo = new PDO(
        'mysql:host=db;dbname='.DB_NAME,
        DB_USER,
        DB_PASSWORD,
        array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );

    // Find username by user ID and password.
    $sql = "SELECT name FROM users WHERE user_id = '$user_id' AND encrypted_password = '$encrypted_password'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetch();

    // Failed to login.
    if(empty($result['name'])) {
        error_log("Login failed: user_id = '$user_id'");
        show_error('User ID or password is incorrect');
    }

    // Success to login.
    $_SESSION['login_user'] = $result['name'];
    header('Location: /sqli_reloaded/my_page.php');
} catch(PDOException $e) {
    error_log($e->getMessage());
    show_error('Database error has occurred. Please try again.');
}

?>
