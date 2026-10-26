<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../private/database.php";

if ($_POST) {
    try {
        $stmt = $con->prepare("INSERT INTO user (name, password) VALUES (?, ?)");
        $stmt->bindValue(1, $_POST["name"]);
        $stmt->bindValue(2, password_hash($_POST["password"], PASSWORD_DEFAULT));
        $stmt->execute();
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $error = "<p id='errormessage'>Registratie mislukt. naam bestaat al!</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/shared.css">
    <link rel="stylesheet" href="style/login.css">


</head>

<body>
    <div id="navbar">
        <a href='index.php'>Inloggen</a>
        <a href="register.php">Registreren</a>
    </div>

    <form id="loginForm" method="post">
        <h1>Registreren</h1>
        <input class="inputs" type="text" placeholder="gebruikersnaam" name="name"><br>
        <input class="inputs" type="password" placeholder="wachtwoord" name="password"><br>
        <input class="inputs" id="submit" type="submit" value="aanmelden"><br>
        <?php

        if (isset($error)) {
            echo $error;
        }


        ?>
        <a id="link" href="index.php">Al een account? Log hier in!</a>
    </form>
</body>

</html>