<?php

require_once(dirname(__FILE__).'/../../config/db_settings.php');

function db_init() {
    $db_val = db_config();
    $user = $db_val['user'];
    $pass = $db_val['password'];
    $dsn = $db_val['dsn'];
    $options = $db_val['options'];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function register_user($username, $email, $password, $role = 5) {
    $pdo = db_init();
    $sql = 'INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $flag = $stmt->execute();
        $stmt = null;
        $pdo = null;
        if ($flag) {
            $pdo = db_init();
            $sql = 'SELECT * FROM users WHERE name = :name AND email = :email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $ses_name = $stmt->fetch()['name'];
            $_SESSION['login_name'] = $ses_name;
            $stmt = null;
            $pdo = null;
            header("Location: index.php");
            exit();
        } else {
            $stmt = null;
            $pdo = null;
            return 'ユーザー登録に失敗しました。';
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function user_login($email, $password) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt= $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user_info = $stmt->fetch();
        if (password_verify($password, $user_info['password'])) {
            session_regenerate_id(true);
            $_SESSION['login_name'] = $user_info['name'];
            $stmt = null;
            $pdo = null;
            header("Location: index.php");
            exit();
        } else {
            $stmt = null;
            $pdo = null;
            return 'Emailまたはパスワードに誤りがあります。';
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function add_category($name) {
    $pdo = db_init();
    $sql = 'INSERT INTO categories (name) VALUES (:name)';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt = null;
        $pdo = null;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

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
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        return $e->getMessage();
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
        return $e->getMessage();
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
        return $e->getMessage();
    }
}
