<?php
// カテゴリ一覧ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

$all_items = get_categories();
$pages_info = category_pagenation();
?>

<div class="container">
カテゴリ一覧ページ
</div>
<?php if (!empty($pages_info) && $pages_info['count'] != 0) { ?>
    <?php echo 'カテゴリ合計件数：' . $pages_info['count'] . '件です。' ?>
    <p>
        <?php echo ((($_GET['page'] ?? 1) - 1) * 9 + 1) .'件目から' . (($_GET['page'] ?? 1) * 9 > $pages_info['count'] ? $pages_info['count'] : (($_GET['page'] ?? 1)) * 9) . '件目までを表示しています。' ?>
    </p>
    <ul>
        <?php
        foreach($pages_info['data'] as $item_list) {
            echo "<li><a href='/category/show.php?id=" . $item_list['id'] . "'>" .  $item_list['name'] . "</a></li>";
        }
        ?>
    </ul>
    <?php for($i = 1; $i <= $pages_info['pages']; $i++) { ?>
        <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
    <?php } ?>
<?php
} else {
    echo 'カテゴリがありません。';
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>