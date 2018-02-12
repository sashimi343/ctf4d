<?php

require_once(dirname(__FILE__).'/db_config.inc.php');

function h($str) {
    $escaped_str = htmlspecialchars($str, ENT_QUOTES);
    return preg_replace('/[\r\n]+/', '<br />', $escaped_str);
}

function build_author_html($name, $account_type) {
    $author_html = '<span class="author_name">'.h($name).'</span>';

    if($account_type === 'A') {
        $author_html .= '<span class="admin_mark">&nbsp;(管理者)</span>';
    }

    return $author_html;
}

function get_posts($login_id) {
    $posts = array();

    try {
        $pdo = new PDO(
            'mysql:host=db;dbname='.DB_NAME,
            DB_USER,
            DB_PASSWORD,
            array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            )
        );

        $sql = 'SELECT author_name, account_type, body FROM posts INNER JOIN accounts ON posts.author_id = accounts.id WHERE accounts.is_default = 1 OR accounts.id = :login_id';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':login_id', $login_id, PDO::PARAM_INT);
        $statement->execute();

        $posts = $statement->fetchAll();
    } catch(PDOException $e) {
        error_log($e->getMessage());
    }

    return $posts;
}

function get_post_html($post_no, $post) {
    $author = build_author_html($post['author_name'], $post['account_type']);
    $body = h($post['body']);
    $post_html = sprintf(
        '<div class="post"><p>%d. %s</p><p>%s</p></div>',
        $post_no,
        $author,
        $body
    );

    return $post_html;
}

function post($author_id, $author_name, $body) {
    try {
        $pdo = new PDO(
            'mysql:host=db;dbname='.DB_NAME,
            DB_USER,
            DB_PASSWORD,
            array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            )
        );

        $sql = 'INSERT INTO posts(author_id, author_name, body) VALUES (:author_id, :author_name, :body)';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':author_id', $author_id, PDO::PARAM_INT);
        $statement->bindValue(':author_name', $author_name, PDO::PARAM_STR);
        $statement->bindValue(':body', $body, PDO::PARAM_STR);

        $result = $statement->execute();
        return $result;
    } catch(PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

?>
