<?php

session_start();

require_once(dirname(__FILE__).'/../functions/pdo_db.php');

$errors = '';

if (isset($_POST['Login'])) {
    if (empty($_POST['email'])) {
        $errors = 'Emailが未入力です。';
    } elseif (empty($_POST['password'])) {
        $errors = 'Passwordが未入力です。';
    } elseif (strlen($_POST['password']) < 8) {
        $errors = 'Passwordが短すぎます。';
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];
    }

    if (isset($email) && isset($password)) {
        user_login($email, $password);
    }
}

require_once(dirname(__FILE__).'/./commoms/head.php');
require_once(dirname(__FILE__).'/./commoms/navbar.php');
?>
<form method="POST">
    <label>Email</label>
    <input type="text" name="email" placeholder="email" required>
    <label>Password</label>
    <input type="password" name="password" minlength="8" placeholder="password" required>
    <input type="submit" name="Login" value="Login" class="btn btn-primary"></button>
</form>
<?php
require_once(dirname(__FILE__).'/./commoms/html_script.php');
?>
