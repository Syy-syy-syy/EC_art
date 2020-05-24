<?php

session_start();

$_SESSION = array();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}
session_destroy();

require_once(dirname(__FILE__).'/./commoms/head.php');
require_once(dirname(__FILE__).'/./commoms/navbar.php');
echo '<div class="container">';
echo 'ログアウト完了';
echo '</div>';

require_once(dirname(__FILE__).'/./commoms/html_script.php');

?>