<?php
// 商品詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/item_func.php');
require_once(dirname(__FILE__).'/../../functions/item_tag_func.php');
require_once(dirname(__FILE__).'/../../functions/cart_func.php');
require_once(dirname(__FILE__).'/../../functions/validation.php');

$item = get_item($_GET['id']);
$category = get_relate_category($_GET['id']);

if (isset($_SESSION['edit_item'])) {
    $success = "商品：" . $_SESSION['edit_item'] . "を編集しました。";
}

if (isset($_POST['item_delete'])) {
    delete_item($_GET['id']);
}

if (isset($_POST['insert_cart'])) {
    if ($_POST['item_count'] > 0){
        add_ses_cart($_POST['item_id'], $_POST['item_count']);
    }
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
                <?php foreach(get_tags_name($_GET['id']) as $tag) { ?>
                    <li><a href="/tags/show.php?id=<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?> </a></li>
                <?php } ?>
            </ul>
        </li>
        <?php if (isset($_SESSION['login_name'])) { ?>
            <li>
                <form method="POST">
                    <select name="item_count">
                        <option value="">数を選択してください。</option>
                        <?php for($i = 1; $i <= $item['stock']; $i++ ) { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?>個</option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                    <input type="submit" name="insert_cart" value="カートへ入れる">
                </form>
            </li>
        <?php } ?>
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