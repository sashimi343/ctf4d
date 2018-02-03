<?php

setrawcookie('encrypted_flag', base64_encode('FLAG{i_am_CookieM0nst3r!}'), 0, '/todays_snack/');

?>
<?php include(dirname(__FILE__) . '/../common/includes/problem_header.inc.php'); ?>
<p>
    今日のおやつはこれで決まり！キャンディでもビターチョコレートでもないよ！
</p>
<?php include(dirname(__FILE__) . '/../common/includes/problem_footer.inc.php'); ?>
