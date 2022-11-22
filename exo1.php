<?php
// --------------------------
//        EXERCICE 1
// Plus petite/grande valeur
// --------------------------

// Get the lowest value of an array
// The function returns a int or null if the given array is invalid
// We need to loop into the array and check if the current number is lower than the saved one

$numbers = [14, 8, 10, 26, 810];

function getLowestValue(array $numbers): ?int
{
    if (count($numbers) < 2) { // Exit the function if the array has less than 2 numbers (we need to compare at least 2 values)
        return null;
    }

    $lowestValue = $numbers[0]; // Asign the lowestValue the first number of the given array

    for ($i = 1; $i < count($numbers); $i++) {
        if ($numbers[$i] < $lowestValue) { // If the element in the loop is lower than the lowestValue, we replace it
            $lowestValue = $numbers[$i];
        }
    }

    return $lowestValue;
}

function getHigherValue(array $numbers): ?int
{
    if (count($numbers) < 2) { // Exit the function if the array has less than 2 numbers (we need to compare at least 2 values)
        return null;
    }

    $higherValue = $numbers[0]; // Asign the higherValue the first number of the given array

    for ($i = 1; $i < count($numbers); $i++) {
        if ($numbers[$i] > $higherValue) { // If the element in the loop is higher than the higherValue, we replace it
            $higherValue = $numbers[$i];
        }
    }

    return $higherValue;
}

echo getHigherValue($numbers);
