<?php
// カテゴリ一覧ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/category_func.php');
require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');

$all_items = get_categories();
?>

<div class="container">
カテゴリ一覧ページ
</div>
<?php if ($all_items) {?>
    <ul>
        <?php
        foreach($all_items as $item_list) {
            echo "<li>" . "<a href='/category/show.php?id=" . $item_list['id'] . "'>" .  $item_list['name'] . "</a>" .  "</li>";
        }
        ?>
    </ul>
<?php
} else {
    echo 'カテゴリがありません。';
}

require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>