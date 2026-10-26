<?php

require_once("../private/checklogin.php");
require_once("../private/autoloader.php");

$phases = phaseManager::getAllPhases();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/mainscreen.css">
    <link rel="stylesheet" href="style/shared.css">
</head>

<body>
    <div id="navbar">
        <a href='mainscreen.php'>Hoofdscherm</a>
        <a href="uitslag.php">Uitslag</a>
        <a href='uitlog.php' type="submit" class='bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 
                    transition duration-300 flex items-center gap-2'>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24">
                <path d="M16 13v-2H7V8l-5 4 5 4v-3z" />
                <path d="M20 3h-9c-1.1 0-2 .9-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.9 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
            </svg>
            Uitloggen
        </a>
    </div>

    <div id="container-om-phases">
        <?php



        foreach ($phases as $p) {
            // als open datum kleiner is dan datum nu (open datum is al geweest)
            if (new DateTime($p->open) < new DateTime()) {


                echo "
<div class='phaseblock-container'>
    <a class='link' href='phase.php?id=$p->id'> 
        <div class='phaseblock-titel'>$p->name</div>
        <div class='phaseblock'> 
            $p->name<br>
            begindatum: $p->open<br>
            einddatum: $p->close<br>
        </div>
    </a>
</div>";
            } else {
                echo "
                <div id='disabled'>
<div class='phaseblock-container'>
    <a class='link' href='phase.php?id=$p->id'> 
        <div class='phaseblock-titel'>$p->name</div>
        <div class='phaseblock'> 
            $p->name<br>
            begindatum: $p->open<br>
            einddatum: $p->close<br>
        </div>
    </a>
</div>
</div>";
            }
        }

        ?>
    </div>

</body>

</html>