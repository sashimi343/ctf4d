<?php include(dirname(__FILE__) . '/../common/includes/problem_header.inc.php'); ?>
<p>
    下記の暗号文（？）を解読してください。
</p>
<pre>
<?php

echo base64_encode(base64_encode(base64_encode('FLAG{BASE=6666}')));

?>
</pre>
<p>ヒント：末尾のイコールに注目</p>
<?php include(dirname(__FILE__) . '/../common/includes/problem_footer.inc.php'); ?>
