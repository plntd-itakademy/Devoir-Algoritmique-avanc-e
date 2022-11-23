<?php
// --------------------------
//        EXERCICE 8
//     Jeu de dés Yam’s
// --------------------------

function playGame(): void
{
    readline("Appuyez sur la toucher ENTRER pour lancer les dés");
    $results = [];

    // Loop to generate a number between 1 and 6, 5 times
    for ($i = 0; $i < 5; $i++) {
        $diceResult = rand(1, 6); // Randomize the number
        $results[$i] = $diceResult; // Add to the results array the number randomized
        echo "Résultat du dé #" . ($i + 1) . " : " . $diceResult . "\n";
    }

    // Assign the first result as the number to match
    $numberToMatch = $results[0];

    for ($i = 0; $i < count($results); $i++) {
        // If at least one number does not match the number to match, it means that the player has lost
        if ($numberToMatch !== $results[$i]) {
            die("Perdu !");
        }
    }

    // If the code reach this line, it means that all the numbers are the same. So the player won
    echo "Bravo, gagné !";
}

playGame();
