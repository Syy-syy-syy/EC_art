<?php
require_once(dirname(__FILE__).'/../commoms/php_head.php');
include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');

if(isset($_GET['q']) && isset($_GET['t'])) {
    $res = search_data($_GET['q'], $_GET['t']);
}

?>

<div class="container">
<p>検索結果</p>
<?php if (!empty($res) && $res['count'] != 0) { ?>
    <?php echo '検索結果は' . $res['count'] . '件です。' ?>
    <p>
        <?php echo ((($_GET['page'] ?? 1) - 1) * 9 + 1) .'件目から' . (($_GET['page'] ?? 1) * 9 > $res['count'] ? $res['count'] : (($_GET['page'] ?? 1)) * 9) . '件目までを表示しています。' ?>
    </p>
    <ul>
    <?php foreach($res['data'] as $val) { ?>
        <li><?php echo $val['name']; ?></li>
        <?php if (isset($val['descript'])) { ?>
            <li><?php echo '概要：' . $val['descript']; ?></li>
        <?php } ?>
    <?php } ?>
    </ul>
    <?php for($i = 1; $i <= $res['page']; $i++) { ?>
        <a href="<?php echo '?page=' . $i . '&q=' . $_GET['q'] . '&t=' . $_GET['t'] ?>">
            <?php echo $i ?>
        </a>
    <?php } ?>
<?php } else { ?>
    <p>検索しましたが、対象がありませんでした。</p>
<?php } ?>
</div>
<?php
include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>