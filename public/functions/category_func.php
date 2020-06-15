<?php

require_once(dirname(__FILE__).'/./pdo_db.php');

function add_category($name) {
    $pdo = db_init();
    $sql = 'INSERT INTO categories (name) VALUES (:name)';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt = null;
        $pdo = null;
        $_SESSION['add_cate'] = $name;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_categories() {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM categories';
        $stmt= $pdo->query($sql);
        $all_categories = $stmt->fetchAll();
        $stmt = null;
        $pdo = null;
        return $all_categories;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_category($id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM categories WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        $stmt = null;
        $pdo = null;
        return $res;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function edit_category($name, $id) {
    $pdo = db_init();
    try {
        $sql = 'UPDATE categories SET name = :name WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['edit_cate'] = $name;

        header("Location: /category/show.php?id=" . $id . "&edit");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function delete_category($id) {
    $pdo = db_init();
    try {
        $sql = 'DELETE FROM categories WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /category/index.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_belongs_item($id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT t1.name, t1.price, t1.stock, t1.descript
                FROM items AS t1
                INNER JOIN categories AS t2
                ON t1.category_id = t2.id
                WHERE t2.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function category_pagenation() {
    if(!isset($_GET['page'])) {
        $now = 1;
    } else {
        $now = $_GET['page'];
    }

    // データ総件数
    define('MAX',9);
    $pdo = db_init();
    $count = $pdo->query('SELECT COUNT(*) AS count FROM categories');
    $total_count = $count->fetch();
    $pages = ceil($total_count['count'] / MAX);

    // データ抽出
    $sql = 'SELECT * FROM categories ORDER BY id LIMIT :start, 9';
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