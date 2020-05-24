<?php
ini_set('display_errors', 1);

session_start();

require_once(dirname(__FILE__).'/../functions/pdo_db.php');

$errors = array();

if (isset($_POST['Register'])) {
    if (empty($_POST['name'])) {
        $errors[] = 'User Nameが未入力です。';
    }

    if (empty($_POST['email'])) {
        $errors[] = 'Emailが未入力です。';
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Passwordが未入力です。';
    }

    if (strlen($_POST['password']) < 8) {
        $errors[] = 'Passwordが短すぎます。';
    }

    if (empty($_POST['password2'])) {
        $errors[] = 'Confirm Passwordが未入力です。';
    }

    if ($_POST['password'] !== $_POST['password2']) {
        $errors[] = 'PasswordとConfirm Passwordが違います。';
    }

    if (!$errors) {
        $username = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    }

    if (isset($username) && isset($email) && isset($password)) {
        $errors[] = register_user($username, $email, $password);
    }
}

require_once(dirname(__FILE__).'/./commoms/head.php');
require_once(dirname(__FILE__).'/./commoms/navbar.php');
?>

<form action="register.php" method="POST">
    <label>User Name</label>
    <input type="text" name="name" placeholder="name" required>
    <label>Email</label>
    <input type="text" name="email" placeholder="email" required>
    <label>Password</label>
    <input type="password" name="password" minlength="8" placeholder="password" required>
    <label>Confirm Password</label>
    <input type="password" name="password2" minlength="8" placeholder="Confirm Password" required>
    <button type="submit" name="Register" class="btn btn-primary">Register</button>
</form>
<?php
require_once(dirname(__FILE__).'/./commoms/html_script.php');
?>