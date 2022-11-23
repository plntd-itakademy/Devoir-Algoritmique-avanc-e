<?php
// ----------------------------------
//           EXERCICE 7
//  Tri tableau par ordre croissant
// ----------------------------------

// Fonction qui prend un tableau de nombre en paramètre
// The function returns the array sorted
$numbers = [1, 5, 2, 3];

function sortArray(array $numbers): array
{
    $isMoved = true;

    // While the last loop has modified the array, we re-check if there is any numbers to change
    while ($isMoved) {
        $isMoved = false;
        for ($i = 0; $i < count($numbers) - 1; $i++) {

            // If the right number is greater than the left one, we swipe them
            if ($numbers[$i] > $numbers[$i + 1]) {
                $tempLeftValue = $numbers[$i]; // We save the left value that we are going to swipe in a temp variable
                $numbers[$i] = $numbers[$i + 1]; // We put the lower value to the left position
                $numbers[$i + 1] = $tempLeftValue; // We put the greater value to the right position

                $isMoved = true;
            }
        }
    }

    return $numbers;
}

print_r(sortArray($numbers));
