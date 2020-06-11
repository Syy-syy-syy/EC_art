<?php
// カテゴリ詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/category_func.php');

$category = get_category($_GET['id']);
$items = get_belongs_item($_GET['id']);

if (isset($_SESSION['edit_cate'])) {
    $success = "カテゴリ名を" . $_SESSION['edit_cate'] . "に編集しました。";
}

if (isset($_POST['cate_delete'])) {
    delete_category($_GET['id']);
}

include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<div class="container">
カテゴリ詳細ページ
</div>
<?php if ($category) {?>
    <ul>
        <li><?php echo $category['name']; ?></li>
    </ul>
    <h3><?php echo $category['name']; ?>の商品一覧</h3>
    <?php if ($items) { ?>
        <?php foreach ($items as $row) { ?>
        <ul>
            <li>商品名：<a href="/items/show.php?id=<?php echo $_GET['id']; ?>"><?php echo $row['name']; ?></a></li>
            <li>概要：<?php echo $row['descript']; ?></li>
        </ul>
        <?php }
    } else {
        echo '<p>商品がありません。</p>';
    }
    if (isset($_SESSION['is_admin'])) { ?>
        <a href="/category/edit.php?id=<?php echo $_GET['id']; ?>">カテゴリ編集ページ</a>
        <form method="POST">
            <input type="submit" name="cate_delete" value="カテゴリ削除">
        </form>
        <a href="/admin/add_items.php">商品登録ページ</a>
    <?php } ?>
<?php
} else {
    header("Location: /category/index.php");
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>