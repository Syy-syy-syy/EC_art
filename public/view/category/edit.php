<?php
// カテゴリ編集ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/category_func.php');
require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');

if (isset($_POST['edit_cate'])) {
    edit_category($_POST['category'], $_GET['id']);
}

$category = get_category($_GET['id']);
?>

<div class="container">
カテゴリ詳細ページ
</div>
<?php if (isset($_SESSION['is_admin'])) { ?>
    <?php if ($category) {?>
        <form method="POST">
            <input type="text" name="category" value="<?php echo $category['name']; ?>">
            <input type="submit" name="edit_cate" value="更新">
        </form>
    <?php
    } else {
        echo 'カテゴリがありません。';
    }
} else {
    header("Location: /category/index.php");
}

require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>