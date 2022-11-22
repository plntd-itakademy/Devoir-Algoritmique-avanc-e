<?php
// --------------------------
//        EXERCICE 5
//    Jeu des bâtonnets
// --------------------------

// Lorsqu'il reste 4 bâtonnets, il faut que ça soit le tour de l'ordi

$sticks = 10;

while ($sticks > 0) {
    $stickTakenPlayer = readline("\nSaisissez un nombre de bâtonnets à prendre : ");
    $sticks -= $stickTakenPlayer;

    if ($sticks > 4) {
        $stickTakenComputer = rand(1, 3);
        $sticks -= $stickTakenComputer;
        echo "\nL'ordi a pri : " . $stickTakenComputer . " bâtonnets";
    }

    echo $sticks % 4;

    echo "\nNombre de batônnets restants : " . $sticks;
}
