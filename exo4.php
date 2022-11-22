<?php
// --------------------------
//        EXERCICE 4
//       Jeu du pendu
// --------------------------

$wordToFind = 'cuisine';
$wordToFindArr = [];
$lettersToFind = strlen($wordToFind);
$attempts = 10;

// Initialize the word array
for ($i=0; $i < strlen($wordToFind); $i++) {
    $wordToFindArr[$i] = [
        'letter' => $wordToFind[$i],
        'found' => false
    ];
}

// While there are still letters to find, ask the user a letter
while ($lettersToFind > 0) {
    $letterFound = false; // Variable to check if the user has found at least one letter

    echo "\n";
    // Display the result. A dash if the letter has not been found yet, otherwise, the letter
    for ($i=0; $i < count($wordToFindArr); $i++) { 
        if ($wordToFindArr[$i]['found'] === false) {
            echo ' - ';
        } else {
            echo ' ' . $wordToFindArr[$i]['letter'] . ' ';
        }
    }
    echo "\n";

    $letterWordAttempt = readline("\nVeuillez entrer une lettre ou le mot : ");

    // Loop the word to find to check if the letter attempt is in the word
    for ($i=0; $i < count($wordToFindArr); $i++) {

        // Check if the user has typed the word
        if ($letterWordAttempt === $wordToFind) {
            echo 'Bravo ! Vous avez découvert le mot !';
            exit;
        }

        if ($wordToFindArr[$i]['letter'] === $letterWordAttempt) {
            
            // Check if the letter has already been found
            if ($wordToFindArr[$i]['found'] === true) {
                $letterFound = true;
                echo 'Cette lettre a déjà été trouvée.';
                break;
            }

            $letterFound = true;
            $lettersToFind--;
            $wordToFindArr[$i]['found'] = true;
        }
    }

    // If no letter has been found
    if ($letterFound === false) {
        if ($attempts > 1) {
            $attempts--;
            echo "Oups, une erreur. Il vous reste " . $attempts . " tentative(s).\n";
        } else {
            echo "Perdu !";
            break;
        }
    }

    // If there is no letter to find anymore, it means the user has found all the letters of the word
    if ($lettersToFind === 0) {
        echo 'Bravo ! Vous avez découvert le mot !';
    }
}
