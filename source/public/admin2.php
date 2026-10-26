<?php

require_once("../private/checklogin.php");
require_once("../private/autoloader.php");


if ($_POST) {
    // als er op de knop gedrukt
    if (isset($_POST['save_score'])) {
        $matchId = $_POST['match_id'];
        $score1 = $_POST['score1'];
        $score2 = $_POST['score2'];

        matchManager::insertOrUpdateScoreByID($matchId, $score1, $score2);
    }
}

$phaseId = $_GET['id'];
$phase = phaseManager::getPhaseById($phaseId);
$matches = matchManager::getmatchesOfPhase($phaseId);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($phase->name); ?></title>
    <link rel="stylesheet" href="style/shared.css">
    <link rel="stylesheet" href="style/mainscreen.css">
    <link rel="stylesheet" href="style/phase.css">
</head>

<body>
    <h1>Scores toevoegen:</h1>



    <div id="container-om-phases">

        <?php
        foreach ($matches as $m) {

            echo
            "
                <div class='phaseblock-container'>
                    <div id='phaseblock-titel'>$m->land_1 vs $m->land_2</div>
                        <div id='phaseblock'> 
                            <div class='flag-container'>  <img class='flags' src='/afbeeldingen/vlaggen/flag_{$m->land_1_flag}.png' > 
                            VS
                            <img class='flags' src='/afbeeldingen/vlaggen/flag_{$m->land_2_flag}.png' > <br>
                        </div>
                
                        Date: $m->match_date <br>
                        <form method='post'>
                                    <input type='hidden' name='match_id' value='$m->id'>

                                    <input type='number' value='$m->score1'name='score1' min='0' max='20'>
                                    
                                    <input type='number' value='$m->score2' name='score2' min='0' max='20'>

                                    <button type='submit' name='save_score'>Opslaan</button>
                            </form>
                    </div>
                </div>";
        }

        ?>
    </div>
</body>

</html>