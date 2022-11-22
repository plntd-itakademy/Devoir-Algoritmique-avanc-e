<?php
// --------------------------
//        EXERCICE 3
//    Recherche lettre
// --------------------------

// We ask the user to enter a word
$word = readline("Veuillez entrer un mot : ");
$wordArr = [];
$letterCount = 0;

// For each letter of the word, we fill the word array
for ($i=0; $i < strlen($word); $i++) { 
    $wordArr[$i] = $word[$i];
}

// We ask the user to enter a letter to search
$letterSearched = readline("Veuillez entrer une lettre à rechercher : ");

// For each letters of the word specified, we check if the letter searched is present. If so, we increment the counter
for ($i=0; $i < count($wordArr); $i++) { 
    if ($wordArr[$i] === $letterSearched) {
        $letterCount++;
    }
}

echo "Nombre de fois où la lettre '" . $letterSearched . "' est présente dans le mot '" . $word . "' : " . $letterCount . "\n";