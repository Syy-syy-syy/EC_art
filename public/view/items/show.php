<?php
// 商品詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/item_func.php');

$item = get_item($_GET['id']);

if (isset($_SESSION['edit_item'])) {
    $success = "商品名を" . $_SESSION['edit_item'] . "に編集しました。";
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
        <li><?php echo $item['name']; ?></li>
    </ul>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <a href="/items/edit.php?id=<?php echo $_GET['id']; ?>">編集ページ</a>
        <form method="POST">
            <input type="submit" name="item_delete" value="削除">
        </form>
    <?php } ?>
<?php
} else {
    header("Location: /items/index.php");
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>