<?php
// カテゴリ詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/category_func.php');

$category = get_category($_GET['id']);

if (isset($_SESSION['edit_cate'])) {
    $success = "カテゴリ名を" . $_SESSION['edit_cate'] . "に編集しました。";
}

if (isset($_POST['cate_delete'])) {
    delete_category($_GET['id']);
}

require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<div class="container">
カテゴリ詳細ページ
</div>
<?php if ($category) {?>
    <ul>
        <li><?php echo $category['name']; ?></li>
    </ul>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <a href="/category/edit.php?id=<?php echo $_GET['id']; ?>">編集ページ</a>
        <form method="POST">
            <input type="submit" name="cate_delete" value="削除">
        </form>
    <?php } ?>
<?php
} else {
    header("Location: /category/index.php");
}

require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>