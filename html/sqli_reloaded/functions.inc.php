<?php

function show_error($message) {
    $_SESSION['login_error'] = $message;
    header('Location: /sqli_reloaded/login_page.php');
    exit();
}

function detect_sql_injection($subject) {
    // These pattern indicates SQL Injection attacks.
    $black_list = array(
        '/\'\s*and/i',      // "'and"
        '/\'\s*or/i',       // "'or"
        '/\s+and/i',        // " and"
        '/\s+or/i',         // " or"
        '/-- /',            // single-line comment("-- ")
        '/\/\*\w*\*\//',    // C-style comment("/* 〜 */")
        '/#/'               // single-line comment 2("# ")
    );

    // Check if $subject contains a fragment of SQL.
    foreach($black_list as $pattern) {
        if(preg_match($pattern, $subject)) {
            // SQL Injection attack is detected.
            return true;
        }
    }

    // SQL Injection attack is not detected.
    return false;
}

?>
