<?php
ini_set('display_errors', 1);

session_start();

require_once(dirname(__FILE__).'/../../functions/pdo_db.php');
require_once(dirname(__FILE__).'/../../functions/validation.php');

$errors = array();

if (!$_SESSION['is_admin']) {
    header("Location: /index.php");
}

if (isset($_POST['Register'])) {
    $errors = validate_register($_POST);

    if ($_POST['admin_pass'] != set_admin_pass()) {
        $errors[] = 'Admin Passwordが違います。';
    }

    if (!$errors) {
        $username = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    }

    if (isset($username) && isset($email) && isset($password)) {
        $errors[] = register_user($username, $email, $password, $_POST['role_id']);
    }
}

require_once(dirname(__FILE__).'/../commoms/head.php');
require_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<form action="add_admin_user.php" method="POST">
    <label>User Name</label>
    <input type="text" name="name" placeholder="name" required>
    <label>Email</label>
    <input type="text" name="email" placeholder="email" required>
    <label>Password</label>
    <input type="password" name="password" minlength="8" placeholder="password" required>
    <label>Confirm Password</label>
    <input type="password" name="password2" minlength="8" placeholder="Confirm Password" required>
    <label>Choose role</label>
    <select name="role_id">
        <option value="1">Admin</option>
        <option value="5">General</option>
    </select>
    <label>Admin Password</label>
    <input type="password" name="admin_pass" minlength="8" placeholder="Admin Password" required>

    <button type="submit" name="Register" class="btn btn-primary">Admin User Register</button>
</form>

<?php
require_once(dirname(__FILE__).'/../commoms/html_script.php');
?>