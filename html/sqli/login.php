<?php

require_once(dirname(__FILE__).'/db_config.inc.php');

function show_error($message) {
    $_SESSION['login_error'] = $message;
    header('Location: /sqli/login_page.php');
    exit();
}

session_start(array('cookie_path' => '/sqli'));

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
    header('Location: /sqli/my_page.php');
} catch(PDOException $e) {
    error_log($e->getMessage());
    show_error('Database error has occurred. Please try again.');
}

?>
