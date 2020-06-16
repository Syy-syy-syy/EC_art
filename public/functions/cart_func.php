<?php

// DBからデータを取得し、セッションに配列として保存すること
function add_ses_cart($item_id, $item_count) {
    if ($_SESSION['cart_info'][$item_id]) {
        unset($_SESSION['cart_info'][$item_id]);
    }
    $_SESSION['cart_info'][$item_id] = ['item_id' => $item_id, 'item_count' => $item_count];
    header("Location: /items/show.php?id=$item_id");
    exit();
}

function get_cart_items($id) {
    $pdo = db_init();
    $sql = 'SELECT * FROM items WHERE id = :id';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch();
        $pdo = null;
        $stmt = null;
        return $item;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function edit_cart_item($item_id, $item_count) {
    if ($_SESSION['cart_info'][$item_id]) {
        unset($_SESSION['cart_info'][$item_id]);
    }
    $_SESSION['cart_info'][$item_id] = ['item_id' => $item_id, 'item_count' => $item_count];
    header("Location: /cart/");
    exit();
}

function delete_cart_item($item_id) {
    if (isset($_SESSION['cart_info'][$item_id])) {
        unset($_SESSION['cart_info'][$item_id]);
    }
    header("Location: /cart/");
    exit();
}
