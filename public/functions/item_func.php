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

function edit_item($name, $id) {
    $pdo = db_init();
    try {
        $sql = 'UPDATE items SET name = :name WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['edit_item'] = $name;

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