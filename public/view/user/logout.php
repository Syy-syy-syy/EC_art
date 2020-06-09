<?php
require_once(dirname(__FILE__).'/../commoms/php_head.php');
$_SESSION = array();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}
session_destroy();

include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');
echo '<div class="container">';
echo 'ログアウト完了';
echo '</div>';

include_once(dirname(__FILE__).'/../commoms/html_script.php');

?>