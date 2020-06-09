<?php
// 商品編集ページ
if (isset($_SESSION['is_admin'])) {
    header("Location: /items/index.php");
}

require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/item_func.php');
require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');

if (isset($_POST['edit_item'])) {
    edit_item($_POST['item'], $_GET['id']);
}

$item = get_item($_GET['id']);
?>

<div class="container">
商品編集ページ
</div>
<?php if ($item) {?>
    <form method="POST">
        <input type="text" name="item" value="<?php echo $item['name']; ?>">
        <input type="submit" name="edit_item" value="更新">
    </form>
<?php
} else {
    echo '商品がありません。';
}

require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>