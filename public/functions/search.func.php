<?php

function search_data($keyword, $columns) {
    if(!isset($_GET['page'])) {
        $now = 1;
    } else {
        $now = $_GET['page'];
    }
    define('MAX', 9);
    $table_name = [
        'items' => 'items',
        'categories' => 'categories',
        'tags' => 'tags'
    ];
    $keyword = '%' . $keyword . '%';
    $pdo = db_init();

    try {
        $sql = "SELECT COUNT(*) AS count FROM $table_name[$columns] WHERE name LIKE :keyword";
        $count = $pdo->prepare($sql);
        $count->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $count->execute();
        $total_count = $count->fetch();
        $page = ceil($total_count['count'] / MAX);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $sql = "SELECT * FROM $table_name[$columns] WHERE name LIKE :keyword Limit :start, 9";
    try {

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        if ($now == 1) {
            $i = 0;
            $stmt->bindParam(':start', $i, PDO::PARAM_INT);
        } else {
            $i = ($now - 1) * 9;
            $stmt->bindParam(':start', $i, PDO::PARAM_INT);
        }
        $stmt->execute();
        $res = $stmt->fetchAll();

        $stmt = null;
        $pdo = null;
        return [
            'data' => $res,
            'count' => $total_count['count'],
            'page' => $page
        ];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
