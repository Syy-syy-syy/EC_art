<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">EC_art</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="/category/index.php" class="nav-link">Category</a>
                </li>
                <li class="nav-item">
                    <a href="/items/index.php" class="nav-link">Item</a>
                </li>
                <li class="nav-item">
                    <a href="/tags/index.php" class="nav-link">Tag</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['login_name'])) { ?>
                    <?php if ($_SESSION['is_admin']) { ?>
                        <li class="nav-item">
                        <a href="/admin/add_items.php" class="nav-link">Add Item</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/add_user.php" class="nav-link">Add User</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Cart</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo htmlspecialchars($_SESSION['login_name']); ?></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">MyPage</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="/user/logout.php">logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="/user/register.php" class="nav-link">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a href="/user/login.php" class="nav-link">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
<?php
include('error_messages.php');
include('success_messages.php');
?>
