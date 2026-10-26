<?php

require_once("../private/autoloader.php");


$users = userManager::getAllUsers();
$teller = 0;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($phase->name); ?></title>
    <link rel="stylesheet" href="style/shared.css">
    <!-- <link rel="stylesheet" href="style/mainscreen.css"> -->
    <!-- <link rel="stylesheet" href="style/phase.css"> -->
    <link rel="stylesheet" href="style/result.css">
</head>

<body>
    <div id="navbar">
        <a href='mainscreen.php'>Hoofdscherm</a>
        <a>Uitslag</a>
        <a href='uitlog.php' type="submit" class='bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 
                    transition duration-300 flex items-center gap-2'>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24">
                <path d="M16 13v-2H7V8l-5 4 5 4v-3z" />
                <path d="M20 3h-9c-1.1 0-2 .9-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.9 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
            </svg>
            Uitloggen
        </a>
    </div>

    <section>
        <div class="leaderboard-title">Ranglijst</div>
        <table>
            <thead>
                <tr>
                    <td class="rank">#</td>
                    <td>Naam</td>
                    <td style="text-align:right; padding-right:20px;">Punten</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $u) {
                    $teller += 1;
                    echo " <tr>
                <td class='rank rank-1'>$teller</td>
                <td class='player-name'>$u->name</td>
                <td class='points'><span class='points-badge'>$u->score</span></td>
            </tr>";
                }

                ?>
            </tbody>
        </table>
    </section>
</body>