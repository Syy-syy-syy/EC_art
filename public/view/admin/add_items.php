<?php
// カテゴリ・商品登録ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/pdo_db.php');
require_once(dirname(__FILE__).'/../../functions/category_func.php');
require_once(dirname(__FILE__).'/../../functions/tag_func.php');
require_once(dirname(__FILE__).'/../../functions/validation.php');

if (!$_SESSION['is_admin']) {
    header("Location: /index.php");
}

// 商品・カテゴリ・タグ登録処理
if (isset($_POST['category_register'])) {
    if (empty($_POST['name'])) {
        $errors[] = 'Category Nameが未入力です。';
    } else {
        add_category($_POST['name']);
    }
}

if (isset($_POST['tag_register'])) {
    if (empty($_POST['name'])) {
        $errors[] = 'Tag Nameが未入力です。';
    } else {
        add_tag($_POST['name']);
    }
}

if (isset($_POST['item_register'])) {
    $errors = validate_item_register($post);

    if (!$errors) {
        add_item(
            $_POST['name'], $_POST['price'], $_POST['stock'],
            $_POST['descript'], $_POST['cate_id']
        );
    }
}

// 成功した場合のフラッシュメッセージ処理
if (isset($_SESSION['add_item'])) {
    $success = "商品:" . $_SESSION['add_item'] . "を登録しました。";
} elseif (isset($_SESSION['add_cate'])) {
    $success = "カテゴリ:" . $_SESSION['add_cate'] . "を登録しました。";
} elseif (isset($_SESSION['add_tag'])) {
    $success = "タグ:" . $_SESSION['add_tag'] . "を登録しました。";
}

require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');

$cate_list = get_categories();
?>

<div class="container">
    <h2>カテゴリ登録</h2>
    <form method="POST">
        <label>Category Name</label>
        <input type="text" name="name" placeholder="name" required>
        <button type="submit" name="category_register" class="btn btn-primary">Category Register</button>
    </form>

    <?php if($cate_list) { ?>
        <h2>商品登録</h2>
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
            <button type="submit" name="item_register" class="btn btn-primary">Item Register</button>
        </form>
    <?php } else { ?>
        <h2>商品登録をする場合は最初にカテゴリ登録を行ってください。</h2>
    <?php } ?>
    <h2>タグ登録</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="タグ名">
        <input type="submit" name="tag_register" value="タグ登録">
    </form>
</div>

<?php
require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>
