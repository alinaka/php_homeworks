<?php
$post = $_POST;
?>

<html>
<body>
    <?php if (isset($post['login'])): ?>
    <p>Hello, <?php echo $post['login']?></p>
    <?php else: ?>
    <form method="post" action="form.php" id="form">
        <label for="login">Login</label>
        <input id="login" name="login" required>
        <label for="password"></label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Отправить</button>
    </form>
    <?php endif;?>
<script src="js/form.js"></script>
</body>

</html>

