<?php

require('./common/includes/Problems.class.php');

$problems = (new Problems())->find_all();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>CTF for D</title>
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
            <p>
                社内CTFに出題する（した）問題とかを寄せ集めたやつです。
                超簡易仕様なので、スコアの記録やらログインやらそんな機能はありません。
                フラグを投げつけると正解か否かだけ知ることができます。
            </p>
            <p>
                FLAGの形式は<code>FLAG{xxxx}</code>です。
            </p>
            <h2>Problems</h2>
            <table class="striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Point</th>
                    </tr>
                </thead>
<?php

foreach($problems as $problem) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($problem['problem_no']) . '</td>';
    echo '<td><a href="/' . htmlspecialchars($problem['unique_name']) . '/">' . htmlspecialchars($problem['title']) . '</a></td>';
    echo '<td>' . htmlspecialchars($problem['genre_name']) . '</td>';
    echo '<td>' . htmlspecialchars($problem['point']) . '</td>';
}

?>
            </table>
            <hr />
            <p class="copyright">Copyright (c) 2018 Kohei Kakimoto All Rights Reserved.</p>
        </div>
    </body>
</html>
