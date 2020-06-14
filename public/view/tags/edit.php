<?php
// カテゴリ編集ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/tag_func.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

if (!isset($_SESSION['is_admin'])) {
    header("Location: /tags/index.php");
}

if (isset($_POST['edit_tag'])) {
    edit_tag($_POST['tag'], $_GET['id']);
}

$tag = get_tag($_GET['id']);
?>

<div class="container">
タグ編集ページ
</div>
<?php if ($tag) {?>
    <form method="POST">
        <input type="text" name="tag" value="<?php echo $tag['name']; ?>">
        <input type="submit" name="edit_tag" value="更新">
    </form>
<?php
} else {
    echo 'タグがありません。';
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>