<?php

require_once(dirname(__FILE__).'/./pdo_db.php');

function add_tag($name) {
    $pdo = db_init();
    $sql = 'INSERT INTO tags (name) VALUES (:name)';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt = null;
        $pdo = null;
        $_SESSION['add_tag'] = $name;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_tags() {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM tags';
        $stmt= $pdo->query($sql);
        $all_tags = $stmt->fetchAll();
        $stmt = null;
        $pdo = null;
        return $all_tags;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_tag($id) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM tags WHERE id = :id';
        $stmt= $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $tag = $stmt->fetch();
        $stmt = null;
        $pdo = null;
        return $tag;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function edit_tag($name, $id) {
    $pdo = db_init();
    try {
        $sql = 'UPDATE tags SET name = :name WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['edit_tag'] = $name;

        header("Location: /tags/show.php?id=" . $id . "&edit");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function delete_tag($id) {
    $pdo = db_init();
    try {
        $sql = 'DELETE FROM tags WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /tags/index.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}