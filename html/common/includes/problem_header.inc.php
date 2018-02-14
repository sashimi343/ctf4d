<?php

require_once(dirname(__FILE__) . '/Problems.class.php');

$problem_index = debug_backtrace()[0]['file'];
$unique_name = basename(dirname($problem_index));
$problem = (new Problems())->find_by_unique_name($unique_name);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $problem['title']; ?> | CTF for D</title>
        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <script type="text/javascript" src="/common/kickstart_lite/js/kickstart_lite.js"></script>                         
        <link rel="stylesheet" type="text/css" href="/common/kickstart_lite/css/kickstart.css" media="all" />
        <link rel="stylesheet" type="text/css" href="/common/stylesheets/main.css" />
    </head>
    <body>
        <ul class="menu" id="navigation">
            <li><a href="/">CTF for D</a></li>
        </ul>
        <div id="container">
            <h1>CTF for D</h1>
            <h2><?php echo $problem['title'] ?> (<?php echo $problem['genre_name'] ?> <?php echo $problem['point']; ?>)</h2>

