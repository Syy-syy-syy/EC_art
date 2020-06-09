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
        echo $e->getMessage();
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
            header("Location: /user/login.php");
        } else {
            $stmt = null;
            $pdo = null;
            return 'ユーザー登録に失敗しました。';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function user_login($email, $password) {
    $pdo = db_init();
    try {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user_info = $stmt->fetch();
        if (password_verify($password, $user_info['password'])) {
            session_regenerate_id(true);
            if ($user_info['role'] === 1) {
                $_SESSION['is_admin'] = TRUE;
            } else {
                $_SESSION['is_admin'] = FALSE;
            }
            $_SESSION['login_name'] = $user_info['name'];
            $stmt = null;
            $pdo = null;
            header("Location: /index.php");
            exit();
        } else {
            $stmt = null;
            $pdo = null;
            return 'Emailまたはパスワードに誤りがあります。';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}