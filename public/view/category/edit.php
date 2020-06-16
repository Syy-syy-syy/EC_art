<?php
// カテゴリ編集ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

if (!isset($_SESSION['is_admin'])) {
    header("Location: /category/index.php");
}

if (isset($_POST['edit_cate'])) {
    edit_category($_POST['category'], $_GET['id']);
}

$category = get_category($_GET['id']);
?>

<div class="container">
カテゴリ編集ページ
</div>
<?php if ($category) {?>
    <form method="POST">
        <input type="text" name="category" value="<?php echo $category['name']; ?>">
        <input type="submit" name="edit_cate" value="更新">
    </form>
    <a href="/category/show.php?id=<?php echo $_GET['id'] ?>">戻る</a>
<?php
} else {
    echo 'カテゴリがありません。';
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>