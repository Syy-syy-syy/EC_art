<?php

// バリデーション関係
function validate_login($post) {
    $errors = array();

    if (empty($post['email'])) {
        $errors[] = 'Emailが未入力です。';
    }

    if (empty($post['password'])) {
        $errors[] = 'Passwordが未入力です。';
    }

    if (strlen($post['password']) < 8) {
        $errors[] = 'Passwordが短すぎます。';
    }
    return $errors;
}

function validate_register($post) {
    $errors = array();

    if (empty($post['name'])) {
        $errors[] = 'User Nameが未入力です。';
    }

    if (empty($post['email'])) {
        $errors[] = 'Emailが未入力です。';
    }

    if (empty($post['password'])) {
        $errors[] = 'Passwordが未入力です。';
    }

    if (strlen($post['password']) < 8) {
        $errors[] = 'Passwordが短すぎます。';
    }

    if (empty($post['password2'])) {
        $errors[] = 'Confirm Passwordが未入力です。';
    }

    if ($post['password'] !== $post['password2']) {
        $errors[] = 'PasswordとConfirm Passwordが違います。';
    }

    return $errors;
}

function validate_item_register($post) {
    $errors = array();

    if (empty($post['name'])) {
        $errors[] = 'Category Nameが未入力です。';
    }
    if (empty($post['price'])) {
        $errors[] = 'priceが未入力です。';
    }
    if (!is_numeric($post['price'])) {
        $errors[] = 'priceは数値で入力してください。';
    }
    if (empty($post['stock'])) {
        $errors[] = 'stockが未入力です。';
    }
    if (!is_numeric($post['stock'])) {
        $errors[] = 'stockは数値で入力してください。';
    }
    if (empty($post['descript'])) {
        $errors[] = 'descriptが未入力です。';
    }
    if (empty($post['cate_id'])) {
        $errors[] = 'Categoryが未入力です。';
    }
    return $errors;
}

function is_login() {
    if (!isset($_SESSION['login_name'])) {
        header("Location: /user/login.php");
        exit();
    }
}