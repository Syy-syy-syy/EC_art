<?php if ($success) { ?>
    <ul class="alert alert-success" role="alert">
            <li class="ml-4"><?php echo htmlspecialchars($success); ?></li>
    </ul>
<?php }
if (isset($_SESSION['add_item'])) {
    unset($_SESSION['add_item']);
} elseif (isset($_SESSION['add_cate'])) {
    unset($_SESSION['add_cate']);
} elseif (isset($_SESSION['add_tag'])) {
    unset($_SESSION['add_tag']);
} elseif (isset($_SESSION['edit_cate'])) {
    unset($_SESSION['edit_cate']);
}
?>