<?php
// タグ一覧ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/tag_func.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

$all_items = get_tags();
$pages_info = tag_pagenation();
?>

<div class="container">
タグ一覧ページ
</div>
<?php if ($all_items) {?>
    <ul>
        <?php foreach($pages_info['data'] as $item_list) {
            echo "<li><a href='/tags/show.php?id=" . $item_list['id'] . "'>" .  $item_list['name'] . "</a></li>";
        } ?>
    </ul>
    <?php for($i = 1; $i <= $pages_info['pages']; $i++) { ?>
        <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
    <?php } ?>
<?php } else {
    echo 'タグがありません。';
}
include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>