<?php
// 商品詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/item_func.php');
require_once(dirname(__FILE__).'/../../functions/item_tag_func.php');

$item = get_item($_GET['id']);
$category = get_relate_category($_GET['id']);

if (isset($_SESSION['edit_item'])) {
    $success = "商品：" . $_SESSION['edit_item'] . "を編集しました。";
}

if (isset($_POST['item_delete'])) {
    delete_item($_GET['id']);
}

include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<div class="container">
商品詳細ページ
</div>
<?php if ($item) { ?>
    <ul>
        <li>商品名：<?php echo $item['name']; ?></li>
        <li>概要：<?php echo $item['descript']; ?></li>
        <li>価格：<?php echo $item['price']; ?></li>
        <li>在庫：<?php echo $item['stock']; ?></li>
        <li>
            カテゴリ：
            <a href="/category/show.php?id=<?php echo $category['id'] ?>">
                <?php echo $category['name']; ?>
            </a>
        </li>
        <li>タグ：
            <ul>
                <?php
                    foreach(get_tags_name($_GET['id']) as $tag) {
                        echo '<li>' . $tag['name'] . '</li>';
                    }
                ?>
            </ul>
        </li>
    </ul>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <a href="/items/edit.php?id=<?php echo $_GET['id']; ?>">編集ページ</a>
        <form method="POST">
            <input type="submit" name="item_delete" value="削除">
        </form>
        <a href="/admin/add_items.php">商品登録ページ</a>
    <?php } ?>
<?php
} else {
    header("Location: /items/index.php");
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>