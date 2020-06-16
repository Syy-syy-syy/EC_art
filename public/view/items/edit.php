<?php
// 商品編集ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

is_login();

if (!isset($_SESSION['is_admin'])) {
    header("Location: /items/index.php");
}

if (isset($_POST['edit_item'])) {
    foreach ($_POST['tag_id'] as $flag) {
        if ($flag['flag'] == 1) {
            add_item_tag($_POST['name'], $_GET['id'], $flag['id']);
        } elseif ($flag['flag'] == 0) {
            delete_item_tag($_POST['name'], $_GET['id'], $flag['id']);
        }
    }

    $params = [
        'name' => $_POST['name'],
        'descript' => $_POST['descript'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'category_id' => $_POST['category_id'],
    ];
    edit_item($params, $_GET['id']);
}

$item = get_item($_GET['id']);
$categories = get_categories();
$tags = get_tags();

?>

<div class="container">
商品編集ページ
</div>
<?php if ($item) {?>
    <form method="POST">
        <label for="name">商品名：</label>
        <input id="name" type="text" name="name" value="<?php echo $item['name']; ?>">
        <label for="descript">概要：</label>
        <input id="descript" type="text" name="descript" value="<?php echo $item['descript']; ?>">
        <label for="price">価格：</label>
        <input id="price" type="text" name="price" value="<?php echo $item['price']; ?>">
        <label for="stock">在庫：</label>
        <input id="stock" type="text" name="stock" value="<?php echo $item['stock']; ?>">
        <label for="category">カテゴリ：</label>
        <select id="category" name="category_id">
        <?php foreach($categories as $category) { ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name'] ?></option>
        <?php } ?>
        </select>
        <?php if ($tags) { ?>
            <label>タグ：</label>
            <?php foreach($tags as $tag) { ?>
                <input type="hidden" name="tag_id[<?php echo $tag['id']; ?>][flag]" value="0">
                <input type="hidden" name="tag_id[<?php echo $tag['id']; ?>][id]" value="<?php echo $tag['id']; ?>">
                <?php if(check_exist_item_tags($_GET['id'], $tag['id'])) { ?>
                    <input id="tag<?php echo $tag['id']; ?>" type="checkbox" name="tag_id[<?php echo $tag['id']; ?>][flag]" value="1" checked>
                <?php } else { ?>
                    <input id="tag<?php echo $tag['id']; ?>" type="checkbox" name="tag_id[<?php echo $tag['id']; ?>][flag]" value="1">
                <?php } ?>
                <label for="tag<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></label>
            <?php } ?>
            </select>
        <?php } ?>
        <input type="submit" name="edit_item" value="更新">
    </form>
    <a href="/items/show.php?id=<?php echo $_GET['id'] ?>">戻る</a>

<?php
} else {
    header("Location: /items/index.php");
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>