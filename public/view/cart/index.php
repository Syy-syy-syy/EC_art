<?php
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/cart_func.php');
require_once(dirname(__FILE__).'/../../functions/validation.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

is_login();

if (isset($_POST['edit_cart'])) {
    edit_cart_item($_POST['edit_cart_item_id'], $_POST['edit_cart_item_stock']);
}

if (isset($_POST['delete_cart'])) {
    delete_cart_item($_POST['delete_cart_item_id']);
}
?>

<div class="container">
カート一覧ページ
<?php if (!empty($_SESSION['cart_info'])) { ?>
    <ul>
    <?php foreach($_SESSION['cart_info'] as $item_info) {
        $item = get_cart_items($item_info['item_id']); ?>
        <li><a href="/items/show.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
        <li><?php echo $item['descript'] ?></li>
        <li>単価：<?php echo $item['price'] ?>円</li>
        <li>
        個数：<?php echo $item_info['item_count']?>
        [数量変更する場合はこちら]
        <form method="POST">
            <select name="edit_cart_item_stock">
                <?php for($i = 1; $i <= $item['stock']; $i++) { ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="edit_cart_item_id" value="<?php echo $item['id'] ?>">
            <input type="submit" name="edit_cart" value="変更">
        </form>
        </li>
        <li>合計：<?php echo $item_info['item_count'] * $item['price']  ?>円</li>
        <li>
            <form method="POST">
                <input type="hidden" name="delete_cart_item_id" value="<?php echo $item['id'] ?>">
                <input type="submit" name="delete_cart" value="カートから削除">
            </form>
        </li>
    <?php } ?>
    </ul>
    <form method="POST">
        <input type="submit" value="購入画面へ進む">
    </form>
<?php } else {?>
<p>カートに商品が入っていません。</p>
<?php } ?>
</div>
<?php
include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>