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
<?php if ($all_items) {?>
<?php foreach($all_items as $item_list) {
    echo $item_list['name'];
    }
} else {
    echo '商品がありません。';
 } ?>
<?php
require_once(dirname(__FILE__).'/./commoms/html_script.php');
?>