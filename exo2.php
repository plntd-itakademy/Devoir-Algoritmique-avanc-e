<?php
// --------------------------
//        EXERCICE 2
//    Chiffrement CESAR
// --------------------------

// Function who is taking 2 parameters: the text to manipulate and the type of the operation (encrypt or decrypt)
// It will returns the encrypted/decrypted text
function encryptDecryptText($text, $type) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $textArr = [];
    $textResult = '';
    
    // Translate the text string into an array
    for ($i=0; $i < strlen($text); $i++) {
        $textArr[$i] = $text[$i];
    }

    for ($i=0; $i < count($textArr); $i++) {
        if ($textArr[$i] === ' ') { // If the character is a space, add one
            $textResult .= ' ';
        } else {
            // Add to the final text the corresponding encrypted/decrypted letter, depending on the type specified in the parameter of this function
            if ($type === 'encrypt') {
                $textResult .= $alphabet[getLetterIndex($textArr[$i]) + 2];
            } elseif ($type === 'decrypt') {
                $textResult .= $alphabet[getLetterIndex($textArr[$i]) - 2];
            }
        }
    }

    return $textResult;
}

// Function to get the index of a letter
function getLetterIndex($letter) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    for ($i=0; $i < strlen($alphabet); $i++) {
        if ($alphabet[$i] === $letter) { // If it matches the letter, return the index
            return $i;
        }
    }
}

$text = readline("Veuillez entrer un texte : ");
$encryptedText = encryptDecryptText($text, 'encrypt');
$decryptedText = encryptDecryptText($encryptedText, 'decrypt');

// Echo the results
echo $text . " = " . $encryptedText . "\n";
echo $encryptedText . " = " . $decryptedText . "\n";
