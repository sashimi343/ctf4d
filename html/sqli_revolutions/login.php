<?php

require_once(dirname(__FILE__).'/db_config.inc.php');

function show_error($message) {
    $_SESSION['login_error'] = $message;
    header('Location: /sqli_revolutions/login_page.php');
    exit();
}

session_start(array('cookie_path' => '/sqli_revolutions'));

// Get ID and password.
$id = $_POST['id'];
$password = $_POST['password'];

// Validate user input.
if(!is_string($id) || empty($id)) {
    show_error('ID is required.');
}

if(!is_string($password) || empty($password)) {
    show_error('Password is required.');
}

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

    // Added: Escape password string to prevent SQL Injection.
    $escaped_password = $pdo->quote($password);

    // Added: Use '%d' format specifier to convert $id to integer.
    // (This also prevents SQL Injection attacks.)
    $sql = sprintf("SELECT name FROM users WHERE id = %d AND encrypted_password = encrypt_password($escaped_password)", $id);

    // Find username by ID (user number) and password.
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetch();

    // Failed to login.
    if(empty($result['name'])) {
        error_log("Login failed: id = '$id'");
        show_error('ID or password is incorrect');
    }

    // Success to login.
    $_SESSION['login_user'] = $result['name'];
    header('Location: /sqli_revolutions/my_page.php');
} catch(PDOException $e) {
    error_log($e->getMessage());
    show_error('Database error has occurred. Please try again.');
}

?>
