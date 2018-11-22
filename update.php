<?php
session_start();

if (isset($_GET["index"])) {
    $index = $_GET["index"];
}
?><!DOCTYPE html>
<html lang ="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>To Do List</title>
</head>
<body>
<?php
include ('layouts/header.php')
?>
<form action ="index.php" method="post" id="change_name">
    <input type="text" name="taskModified" value="<?php echo $_SESSION["tasks"][$index]["task"] ?>">
    <input type="hidden" name="taskIndex" value="<?php echo $index?>">
    <button type="submit">OK</button>
</form>
<?php
include "layouts/footer.php"
?>
</body>
</html>