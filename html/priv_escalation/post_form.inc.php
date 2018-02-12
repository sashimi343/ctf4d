<?php

if(isset($_SESSION['login_id'])) {
    echo '<hr />';
    echo '<h2>投稿フォーム</h2>';
    echo '<form action="/priv_escalation/post.php" method="POST">';
    echo '<p>';
    echo '<label for="author_name">Name:</label>';
    echo '<input type="text" name="author_name" size="60" value="'.$_SESSION['user_name'].'" />';
    echo '</p>';
    echo '<p>';
    echo '<textarea name="body" cols="60" rows="10"></textarea>';
    echo '</p>';
    echo '<p>';
    echo '<input type="submit" value="投稿する" />';
    echo '</p>';
    echo '</form>';
}

?>
