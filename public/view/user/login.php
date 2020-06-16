<?php
require_once(dirname(__FILE__).'/../commoms/php_head.php');
require_once(dirname(__FILE__).'/../../functions/pdo_db.php');
require_once(dirname(__FILE__).'/../../functions/validation.php');

if (isset($_SESSION['login_name'])) {
    header("Location: /index.php");
}

if (isset($_POST['Login'])) {
    $errors = validate_login($_POST);

    if (!$errors) {
        $email = $_POST["email"];
        $password = $_POST["password"];
    }

    if (isset($email) && isset($password)) {
        $errors[] = user_login($email, $password);
    }
}

include_once(dirname(__FILE__).'/../commoms/html_head.php');
include_once(dirname(__FILE__).'/../commoms/navbar.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="offset-md-2 col-md-8 border border-secondary bg-light p-4">
            <form method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" minlength="8" placeholder="password" required>
                </div>
                <div class="form-group row">
                    <div class="offset-md-5 col-md-2">
                        <input type="submit" name="Login" value="Login" class="btn btn-primary"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once(dirname(__FILE__).'/../commoms/html_script.php');
?>
