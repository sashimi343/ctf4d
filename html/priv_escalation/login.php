<?php

require_once(dirname(__FILE__).'/db_config.inc.php');

function show_error($message) {
    $_SESSION['login_error'] = $message;
    header('Location: /priv_escalation/login_page.php');
    exit();
}

session_start(array('cookie_path' => '/priv_escalation'));

// Get user ID and password.
$user_id = $_POST['user_id'];
$password = $_POST['password'];

// Validate user input.
if(!is_string($user_id) || empty($user_id) || strlen($user_id) > 32) {
    show_error('ユーザIDが不正です。');
}

if(!is_string($password) || empty($password)) {
    show_error('パスワードが不正です。');
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
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );

    // Find username by user ID and password.
    $sql = "SELECT id, name FROM accounts WHERE user_id = :user_id AND encrypted_password = :encrypted_password";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindValue(':encrypted_password', $encrypted_password, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch();

    // Failed to login.
    if(empty($result['name'])) {
        error_log("Login failed: user_id = '$user_id'");
        show_error('ユーザIDまたはパスワードが違います。');
    }

    // Success to login.
    $_SESSION['login_id'] = $result['id'];
    $_SESSION['user_name'] = $result['name'];
    header('Location: /priv_escalation/top.php');
} catch(PDOException $e) {
    error_log($e->getMessage());
    show_error('システムエラーが発生しました。お手数ですがもう一度お試しください。');
}

?>
