<?php
?><!DOCTYPE html>
<html lang ="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>To Do List</title>
</head>
<body>
<header>
    <h1>TO DO LIST</h1>
</header>

<?php if(!empty($_SESSION['error'])): ?>
    <p><?php echo $_SESSION['error'] ?></p>

    <?php unset($_SESSION['error']) ?>

<?php endif; ?>
<p></p>
</body>
</html>

