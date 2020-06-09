<?php
// タグ詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/tag_func.php');

$tag = get_tag($_GET['id']);

if (isset($_SESSION['edit_tag'])) {
    $success = "タグ名を" . $_SESSION['edit_tag'] . "に編集しました。";
}

if (isset($_POST['tag_delete'])) {
    delete_tag($_GET['id']);
}

require_once(dirname(__FILE__).'/../commoms/html_head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<div class="container">
タグ詳細ページ
</div>
<?php if ($tag) { ?>
    <ul>
        <li><?php echo $tag['name']; ?></li>
    </ul>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <a href="/tags/edit.php?id=<?php echo $_GET['id']; ?>">編集ページ</a>
        <form method="POST">
            <input type="submit" name="tag_delete" value="削除">
        </form>
    <?php } ?>
<?php
} else {
    header("Location: /tags/index.php");
}

require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>