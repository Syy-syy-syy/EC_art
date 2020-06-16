<?php
// タグ詳細ページ
require_once(dirname(__FILE__).'/../commoms/php_head.php');

$tag = get_tag($_GET['id']);
$items = get_items_name($_GET['id']);

if (isset($_SESSION['edit_tag'])) {
    $success = "タグ名を" . $_SESSION['edit_tag'] . "に編集しました。";
}

if (isset($_POST['tag_delete'])) {
    delete_tag($_GET['id']);
}

include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<div class="container">
タグ詳細ページ
</div>
<?php if ($tag) { ?>
    <ul>
        <li><?php echo $tag['name']; ?></li>
    </ul>
    <h3>紐づけされている商品一覧</h3>
    <?php if($items)  { ?>
        <?php foreach ($items as $row) { ?>
        <ul>
            <li>商品名：<a href="/items/show.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
            <li>概要：<?php echo $row['descript']; ?></li>
        </ul>
        <?php }
    } else {
        echo '<p>商品がありません。</p>';
    }
    if (isset($_SESSION['is_admin'])) { ?>
        <a href="/tags/edit.php?id=<?php echo $_GET['id']; ?>">編集ページ</a>
        <form method="POST">
            <input type="submit" name="tag_delete" value="削除">
        </form>
        <a href="/admin/add_items.php">商品登録ページ</a>
    <?php } ?>
    <a href="/tags/">戻る</a>
<?php
} else {
    header("Location: /tags/index.php");
}

include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>