<?php

require_once(dirname(__FILE__).'/./pdo_db.php');

function add_item($name, $price, $stock, $descript, $category_id) {
    $pdo = db_init();
    $sql = 'INSERT INTO
                items (name, price, stock, descript, category_id)
            VALUES
                (:name, :price, :stock, :descript, :cate_id)';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':descript', $descript, PDO::PARAM_STR);
        $stmt->bindParam(':cate_id', $category_id, PDO::PARAM_INT);
        print_r($stmt);
        $stmt->execute();
        $pdo = null;
        $_SESSION['add_item'] = $name;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_all_items() {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM items';
        $stmt= $pdo->query($sql);
        $all_items = $stmt->fetchAll();
        $stmt = null;
        $pdo = null;
        return $all_items;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_item($id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM items WHERE id = :id';
        $stmt= $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch();
        $stmt = null;
        $pdo = null;
        return $item;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function edit_item($params, $id) {
    $pdo = db_init();
    try {
        $sql = 'UPDATE items
                SET name = :name, price = :price, stock = :stock,
                    descript = :descript, category_id = :category_id
                WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $params['price'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $params['stock'], PDO::PARAM_STR);
        $stmt->bindParam(':descript', $params['descript'], PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $params['category_id'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['edit_item'] = $params['name'];

        header("Location: /items/show.php?id=" . $id . "&edit");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function delete_item($id) {
    $pdo = db_init();
    try {
        $sql = 'DELETE FROM items WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /items/index.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_relate_category($id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT t2.id, t2.name
                FROM items AS t1
                INNER JOIN categories AS t2
                ON t1.category_id = t2.id
                WHERE t2.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $category = $stmt->fetch();
        return $category;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function item_pagenation() {
    if(!isset($_GET['page'])) {
        $now = 1;
    } else {
        $now = $_GET['page'];
    }

    // データ総件数
    define('MAX',9);
    $pdo = db_init();
    $count = $pdo->query('SELECT COUNT(*) AS count FROM items');
    $total_count = $count->fetch();
    $pages = ceil($total_count['count'] / MAX);

    // データ抽出
    $sql = 'SELECT * FROM items ORDER BY id LIMIT :start, 9';
    $stmt = $pdo->prepare($sql);
    if ($now == 1) {
        $i = 0;
        $stmt->bindParam(':start', $i, PDO::PARAM_INT);
    } else {
        $i = ($now - 1) * 9;
        $stmt->bindParam(':start', $i, PDO::PARAM_INT);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return [
        'pages' => $pages,
        'data' => $data
    ];
}