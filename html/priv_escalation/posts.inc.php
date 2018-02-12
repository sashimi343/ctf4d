<?php

require_once(dirname(__FILE__).'/db_config.inc.php');
require_once(dirname(__FILE__).'/functions.inc.php');

session_start(array('cookie_path' => '/priv_escalation'));

$login_id = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;
$posts = get_posts($login_id);

foreach($posts as $i => $post) {
    echo get_post_html($i+1, $post);
}

?>
