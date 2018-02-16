<?php

require_once(dirname(__FILE__).'/db_config.inc.php');

function show_error($message) {
    $_SESSION['register_error'] = $message;
    header('Location: /priv_escalation/register_page.php');
    exit();
}

session_start(array('cookie_path' => '/priv_escalation'));

$user_id = $_POST['user_id'];
$password = $_POST['password'];
$name = $_POST['name'];
$account_type = $_POST['account_type'];

// Validate user input.
if(!is_string($user_id) || empty($user_id) || !preg_match('/^\w{1,32}$/', $user_id)) {
    show_error('ユーザIDが不正です。');
}

if(!is_string($password) || empty($password)) {
    show_error('パスワードが不正です。');
}

if(!is_string($name) || empty($name) || strlen($name) > 64) {
    show_error('ユーザ名が不正です。');
}

if(!is_string($account_type) || empty($account_type) || strlen($account_type) > 1) {
    show_error('アカウントタイプが不正です。');
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

    // Check whether account that has user_id $user_id exists.
    $sql = "SELECT count(id) FROM accounts WHERE user_id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch();

    if(!empty($result['count(id)'])) {
        show_error('そのユーザIDは既に使用されています。');
    }

    // Register account.
    $sql = "INSERT INTO accounts(user_id, encrypted_password, name, account_type) VALUES (:user_id, :encrypted_password, :name, :account_type)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindValue(':encrypted_password', $encrypted_password, PDO::PARAM_STR);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':account_type', $account_type, PDO::PARAM_STR);
    $result = $statement->execute();

    if(!$result) {
        show_error('ユーザ登録に失敗しました。お手数ですがもう一度お試しください。');
    }

    // Login and redirect to top page.
    $sql = "SELECT id, name FROM accounts WHERE user_id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch();

    if(!empty($result['id'])) {
        $_SESSION['login_id'] = $result['id'];
        $_SESSION['user_name'] = $result['name'];
    }

    header('Location: /priv_escalation/top.php');
} catch(PDOException $e) {
    error_log($e->getMessage());
    show_error('システムエラーが発生しました。お手数ですがもう一度お試しください。');
}

?>
