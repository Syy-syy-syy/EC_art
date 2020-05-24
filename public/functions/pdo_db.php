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
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
}

function register_user($username, $email, $password) {
    $pdo = db_init();
    $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $flag = $stmt->execute();
        return $flag;
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
    }
}

function add_session($username, $email, $password) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM users WHERE name = :name AND email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $ses_name = $stmt->fetch()['name'];
        $_SESSION['login_name'] = $ses_name;
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        exit($e->getMessage());
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
            header("Location: index.php");
            exit();
        } else {
            return $errors = 'Emailまたはパスワードに誤りがあります。';
        }
    } catch (PDOException $e) {
        header('Content-Type: text/plain; charset=UTF-8', true, 500);
        echo 'エラー発生';
        exit($e->getMessage());
    }
}
