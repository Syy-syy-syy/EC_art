<?php
// タグ一覧ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/pdo_db.php');
require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');

$all_items = get_tags();
?>

<div class="container">
タグ一覧ページ
</div>
<?php if ($all_items) {?>
<?php foreach($all_items as $item_list) {
    echo $item_list['name'];
    }
} else {
    echo 'タグがありません。';
 } ?>
<?php
require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>