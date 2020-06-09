<?php
// 商品一覧ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/item_func.php');
require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');

$all_items = get_all_items();
?>

<div class="container">
商品一覧ページ
</div>
<?php if ($all_items) {?>
    <ul>
        <?php foreach($all_items as $item_list) {
            echo "<li><a href='/items/show.php?id=" . $item_list['id'] . "'>" .  $item_list['name'] . "</a></li>";
        } ?>
    </ul>
<?php } else {
    echo '商品がありません。';
}

require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>