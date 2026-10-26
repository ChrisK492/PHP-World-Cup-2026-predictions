<?php

// handmatig database requiren want elke bestand gebruikt die wel
require_once "database.php";


// als meerdere mappen gebruiken:
//alles in de array zetten

$folders = 
[
"",
"../private/Managers/"
];



// kijkt naar classnames die hij niet herkent in die folders
spl_autoload_register(function ($class_name) {
    global $folders;


    // als niet herkent, dan plakt hij .php achter de class.

    foreach ($folders as $folder) {
        $file = "{$folder}{$class_name}.php";

        
        // als hij bestaat dan required hij elk bestand

        if (file_exists($file)) {
            require_once($file);
            return; // stop functie wanneer gevonden
        }
    }
});
