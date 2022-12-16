<?php
// --------------------------
//        EXERCICE 5
//    Jeu des bâtonnets
// --------------------------

// The player who takes the last sticks wins

// Number of sticks at the start
$sticks = 20;

// While there are sticks
while ($sticks > 0) {
    // Show how much sticks they are
    echo "Il reste $sticks bâtonnets.\n";

    // Turn of player 1
    $player1 = getPlayerMove();
    $sticks -= $player1;
    if ($sticks <= 0) {
        echo "Le joueur 1 a gagné !\n";
        break;
    }

    // Turn of player 2
    $player2 = getPlayerMove();
    $sticks -= $player2;
    if ($sticks <= 0) {
        echo "Le joueur 2 a gagné !\n";
        break;
    }
}

// Function to get the number of sticks took from a player
function getPlayerMove()
{
    // Ask to the player how many sticks he wants to take (between 1 and 3)
    $move = readline("Combien de bâtonnets voulez-vous prendre ? ");

    //Check if the input is valid
    if ($move < 1 || $move > 3) {
        echo "Vous devez prendre entre 1 et 3 bâtonnets.\n";
        return getPlayerMove();
    } else {
        return $move;
    }
}
