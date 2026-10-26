<?php

require_once("../private/checklogin.php");
require_once("../private/autoloader.php");

// pakt de fase vanuit de url
$phaseId = isset($_GET['id']) ? $_GET['id'] : null;
$phase = phaseManager::getPhaseById($phaseId);
$matches = matchManager::getmatchesOfPhase($phaseId);


$userId = $_SESSION["id"];

$pointsTekst = "Nog niet gegokt / Uitslag niet niet bekend";
$finalUitslagTekst = "Uitslag nog niet bekend";
$totalPoints = 0;


// checkt of er op knop "opslaan" is gedrukt
if (isset($_POST["save_prediction"])) {
    $userId;
    $matchId = $_POST["match_id"];
    $score1 = $_POST["score1"];
    $score2 = $_POST["score2"];

    predictionManager::createPrediction($userId, $matchId, $score1, $score2);
}


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
        foreach ($matches as $m) {

            // reset van de informatie teksten in match divs
            $points = -1;
            $finalUitslagTekst = "Uitslag nog niet bekend";


            $prediction = predictionManager::getPrediction($userId, $m->id);

            // standaardscores van prediction leeg
            $PredictionScore1 = "";
            $PredictionScore2 = "";

            // als ze niet leeg zijn in de db, vul dan score1 en score2 variabel, die komen in values

            if ($prediction) {
                if ($prediction->score1 !== "") {
                    $PredictionScore1 = $prediction->score1;
                }
                if ($prediction->score2 !== "") {
                    $PredictionScore2 = $prediction->score2;
                }
            }

            // als match score is ingevuld in de db (door admin gedaan), dan punten berekenen
            if ($m->score1 !== null && $m->score2 !== null) {
                $points = predictionManager::calculatePoints(
                    $PredictionScore1,
                    $PredictionScore2,
                    $m->score1,
                    $m->score2
                );
            }

            // als er points zijn, toon dat in Pointstext
            if (isset($points) && $points !== null) {
                $pointsText = $points;
            }

            // als punten groter is dan 0, dus niet -1 (wedstrijd niet gespeeld)

            if ($points >= 0) {
                $totalPoints += $points; // totalPoints worden alle points bij elkaar
            }


            // als points -1 gebleven is, dus wedstrijd nog niet gespeeld is en geen punten gegeven
            if ($points == -1) {
                $pointsText = " Wedstrijd nog niet gespeeld / Uitslag nog niet bekend";
            }

            // als er een score is geinsert in de match door admin, toon dat in de inputs
            if ($m->score1 !== null && $m->score2 !== null) {
                $finalUitslagTekst = "$m->score1 - $m->score2";
            }


            if ($totalPoints > 0) {
                userManager::insertScoreByUserID($totalPoints, $userId);
            }


            // als match date hoger is of gelijk aan dateTime (wedstrijd is nog niet geweest of niet bezig)
            if (new DateTime($m->match_date) >= new DateTime()) {
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
                        Score: $finalUitslagTekst <br>
                        Prediction: <form method='post'>
                                    <input type='hidden' name='match_id' value='$m->id'>

                                    <input type='number' value='$PredictionScore1' name='score1' min='0' max='20'>
                                    :
                                    <input type='number' value='$PredictionScore2' name='score2' min='0' max='20'>

                                    <button type='submit' name='save_prediction'>Gokken</button>
                            </form>
                        Points:$pointsText
                    </div>
                </div>";
            } else {
                echo
                "
                <div id='disabled'>
                <div class='phaseblock-container'>
                    <div id='phaseblock-titel'>$m->land_1 vs $m->land_2</div>
                        <div id='phaseblock'> 
                            <div class='flag-container'>  <img class='flags' src='/afbeeldingen/vlaggen/flag_{$m->land_1_flag}.png' > 
                            VS
                            <img class='flags' src='/afbeeldingen/vlaggen/flag_{$m->land_2_flag}.png' > <br>
                        </div>
                
                        Date: $m->match_date <br>
                        Score: $finalUitslagTekst <br>
                        Prediction: <form method='post'>
                                    <input type='hidden' name='match_id' value='$m->id'>

                                    <input type='number' value='$PredictionScore1' name='score1' min='0' max='20'>
                                    :
                                    <input type='number' value='$PredictionScore2' name='score2' min='0' max='20'>

                                    <button type='submit' name='save_prediction'>Gokken</button>
                            </form>
                        Points:$pointsText
                    </div>
                </div>
                </div>";
            };
        }
        ?>
    </div>
</body>

</html>