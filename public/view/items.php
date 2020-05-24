<?php
// 商品一覧ページ

ini_set('display_errors', 1);

require_once(dirname(__FILE__).'/../functions/pdo_db.php');


$errors = array();
$all_items = get_all_items();
session_start();

require_once(dirname(__FILE__).'/./commoms/head.php');
require_once(dirname(__FILE__).'/./commoms/navbar.php');
?>

<div class="container">
商品一覧ページ
</div>
<?php foreach($all_items as $item_list) { ?>
<?php echo $item_list['name']; ?>
<?php } ?>
<?php
require_once(dirname(__FILE__).'/./commoms/html_script.php');
?>