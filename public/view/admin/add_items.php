<?php

// カテゴリ・商品登録ページ

ini_set('display_errors', 1);

require_once(dirname(__FILE__).'/../../functions/pdo_db.php');
require_once(dirname(__FILE__).'/../../functions/validation.php');

$errors = array();
session_start();

if (isset($_POST['category_register'])) {
    if (empty($_POST['name'])) {
        $errors[] = 'Category Nameが未入力です。';
    } else {
        $cate_name = $_POST['name'];
    }

    if ($cate_name) {
        add_category($cate_name);
    }
}

if (isset($_POST['item_register'])) {
    $errors = validate_item_register($post);

    if (!$errors) {
        $item_name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $descript = $_POST['descript'];
        $cate_id = $_POST['cate_id'];
    }

    if (isset($item_name) && isset($price) && isset($stock) && isset($descript) && isset($cate_id)) {
        add_item($item_name, $price, $stock, $descript, $cate_id);
    }
}


$cate_list = get_categories();

require_once(dirname(__FILE__).'/../commoms/head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');
?>
<div class="container">
    カテゴリ登録
    <form method="POST">
        <label>Category Name</label>
        <input type="text" name="name" placeholder="name" required>
        <button type="submit" name="category_register" class="btn btn-primary">Category_Register</button>
    </form>

    <?php if($cate_list) { ?>
        商品登録
        <form method="POST">
            <label>Item Name</label>
            <input type="text" name="name" placeholder="name" required>
            <label>Price</label>
            <input type="number" name="price" placeholder="price" required>
            <label>Stock</label>
            <input type="number" name="stock" placeholder="stock" required>
            <label>description</label>
            <textarea name="descript"  placeholder="description" required></textarea>
            <label>Category</label>
            <select name="cate_id">
                <?php foreach($cate_list as $cate) { ?>
                    <option value="<?php echo $cate['id'] ?>"><?php echo $cate['name'] ?></option>
                <?php } ?>
            </select>
            <!-- カテゴリをループ処理で取得する -->
            <button type="submit" name="item_register" class="btn btn-primary">Item_Register</button>
        </form>
    <?php } else { ?>
        商品登録をする場合は最初にカテゴリ登録を行ってください。
    <?php } ?>
</div>

<?php
require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>
