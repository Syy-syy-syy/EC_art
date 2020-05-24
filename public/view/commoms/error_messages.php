<?php if (count($errors) > 0) { ?>
    <ul class="alert alert-danger" role="alert">
        <?php foreach($errors as $error) { ?>
            <li class="ml-4"><?php echo htmlspecialchars($error); ?></li>
        <?php } ?>
    </ul>
<?php } ?>