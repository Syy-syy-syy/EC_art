<?php

require_once(dirname(__FILE__).'/./pdo_db.php');

function get_tags_name($item_id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT t3.id, t3.name
                FROM items AS t1
                INNER JOIN item_tags AS t2
                ON t1.id = t2.item_id
                INNER JOIN tags AS t3
                ON t2.tag_id = t3.id
                WHERE t1.id = :id';
        $stmt= $pdo->prepare($sql);
        $stmt->bindParam(':id', $item_id, PDO::PARAM_INT);
        $stmt->execute();
        $all_tags = $stmt->fetchAll();
        $stmt = null;
        $pdo = null;
        return $all_tags;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function check_exist_item_tags($item_id, $tag_id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM item_tags WHERE item_id = :item_id AND tag_id = :tag_id';
        $stmt= $pdo->prepare($sql);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();
        $stmt = null;
        $pdo = null;
        return $data;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function add_item_tag($item_name, $item_id, $tag_id) {
    $pdo = db_init();
    $sql = 'INSERT INTO item_tags (item_id, tag_id) VALUES (:item_id, :tag_id)';
    if (!check_exist_item_tags($item_id, $tag_id)) {
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
            $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = null;
            $pdo = null;
            $_SESSION['add_item_tags'] = $item_name;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
