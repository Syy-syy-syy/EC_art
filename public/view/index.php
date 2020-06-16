<?php
require_once(dirname(__FILE__).'/./commoms/php_head.php');
require_once(dirname(__FILE__).'/./commoms/html_head.php');
require_once(dirname(__FILE__).'/./commoms/navbar.php');
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <div class="row text-white">
        <div class="col-lg-12">
            <h1 class="mb-5">The road is open everywhere.</h1>
            <h2>Those decisions are up to you.</h2>
            <h2 class="mb-5">Go ahead or go back?</h2>
            <a class="btn btn-light btn-md mb-5 mt-2 text-center" href="/user/login.php">Login</a>
            <h2>Click here to create a new user.</h2>
            <a class="btn btn-dark btn-md mb-5 mt-3 text-center" href="/user/register.php">Register</a>
        </div>
      </div>
  </div>
</div>
<?php
require_once(dirname(__FILE__).'/./commoms/html_script.php');
?>
