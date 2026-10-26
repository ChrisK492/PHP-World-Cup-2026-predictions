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

    <h1>Admin mode</h1>
    <p>Op deze pagina's kan je de uiteindelijke scores van de wedstrijden toevoegen</p>

    <div id="container-om-phases">
        <?php

        foreach ($phases as $p) {
            echo
            "
<div class='phaseblock-container'>
    <a class='link' href='admin2.php?id=$p->id'> 
        <div class='phaseblock-titel'>$p->name</div>
        <div class='phaseblock'> 
            $p->name<br>
            begindatum: $p->open<br>
            einddatum: $p->close<br>
        </div>
    </a>
</div>";
        }


        ?>
    </div>

</body>

</html>