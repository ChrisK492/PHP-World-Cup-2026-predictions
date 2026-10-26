<?php

require_once "../private/database.php";

if ($_POST) {
    $stmt = $con->prepare("SELECT * from user WHERE name = ?");
    $stmt->bindValue(1, $_POST["name"]);
    $stmt->execute();
    $user = $stmt->fetchObject();

    if ($user !== false) {
        if (password_verify($_POST["password"], $user->password)) {
            session_start();
            $_SESSION["id"] = $user->id;
            $_SESSION["name"] = $user->name;
            header("location: mainscreen.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="/style/login.css">
    <link rel="stylesheet" href="/style/shared.css">
</head>

<body>
    <div id="navbar">
        <a href='index.php'>Inloggen</a>
        <a href="register.php">Registreren</a>
    </div>

    <form id="loginForm" method="post">
        <h1>Inloggen</h1>
        <input class="inputs" type="text" placeholder="gebruikersnaam" name="name"><br>
        <input class="inputs" type="password" placeholder="wachtwoord" name="password"><br>
        <input class="inputs" id="submit" type="submit" value="inloggen"><br>
        <?php
        if ($_POST) {
            echo "<p id='errormessage'>Inloggen niet gelukt, verkeerd wachtwoord en/of naam</p>";
        };
        ?>
        <a id="link" href="register.php">Nog geen account? Registreer hier!</a>
    </form>
</body>

</html>