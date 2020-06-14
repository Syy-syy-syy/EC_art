<?php
// カテゴリ編集ページ
if (!isset($_SESSION['is_admin'])) {
    header("Location: /category/index.php");
}

require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/category_func.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

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
<?php
} else {
    echo 'カテゴリがありません。';
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>