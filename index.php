<?php
require('function.php');
session_start();

// Création d'un tableau dans la variable session
if(!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = array();
}


// Vérification que l'on reçoit une tâche à partir de la clé task du formulaire
if(!empty($_POST["task"])) {
    $found = false;
    foreach ($_SESSION["tasks"] as $index => $task) {
        if($task["task"] == $_POST["task"]) {
            $found = true;
            var_dump($found);
        }
    }
    if ($found == false) {
        // Ajout d'un nouveau tableau dans notre tableau de tâches ($tasks)
        $_SESSION["tasks"][] = array(
            "status" => true,
            "task" => $_POST["task"]
        );
    } else {
        $taskName = $_POST["task"];
        $_SESSION["error"] = "Vous avez déjà une tâche avec le nom : $taskName";
    }
    redirection();
}

if(isset($_GET["check"]))  {
    $index = $_GET["check"];
    $_SESSION["tasks"][$index]["status"] = !$_SESSION["tasks"][$index]["status"];
    redirection();
}

if (isset($_GET["delete"])) {
    $index = $_GET["delete"];
    unset($_SESSION["tasks"][$index]);
    redirection();
}
if(!empty($_POST["taskModified"]) && isset($_POST["taskIndex"])) {
    $index = $_POST["taskIndex"];
    $_SESSION["tasks"][$index]["task"] = $_POST["taskModified"];
}

if(isset($_GET["deleteAll"])) {
    session_destroy();
    redirection();
}

?><!DOCTYPE html>
<html lang ="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>To Do List</title>
</head>
<body>

<?php
include ('layouts/header.php')
?>


<form class="form-inline" action="" method="post">
    <input class="form-control mb-2 mr-sm-2" type="text" name="task" placeholder="Saisir une tâche...">
    <button type="submit" class="btn btn-primary mb-2">OK</button>
    <a href="?deleteAll" class="btn btn-danger mb-2">Clean</a>
</form>
<table align="center" class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nom de la tâche</th>
        <th>Checker</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php if(count($_SESSION["tasks"])): ?>
        <?php foreach ($_SESSION["tasks"] as $index => $task): ?>
            <tr>
                <!-- Ceci est presque comme une condition. C'est un ternaire -->
                <td><?php echo $task["status"] ? "<img src=\"images/croix_rouge.jpg\" id=\"check\">" : "<img src=\"images/check.png\" id=\"check\">" ?></td>
                <td><?php echo $task["task"] ?></td>
                <td><a href="?check=<?php echo $index ?>">checker</a></td>
                <td><a href="update.php?index=<?php echo $index ?>">modifier</a></td>
                <td><a href="?delete=<?php echo $index ?>">supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Aucune tâche, veuillez en saisir une...</td>
        </tr>
    <?php endif ?>

    </tbody>
</table>
<?php
include "layouts/footer.php"
?>
</body>
</html>