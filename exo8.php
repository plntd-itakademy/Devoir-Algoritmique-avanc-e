<?php
// --------------------------
//        EXERCICE 8
//       Tour d’Hanoi
// --------------------------

// Objectif : vider la colonne du milieu en premier
// Si on ne peut pas bouger la colonne du milieu : s'occuper des 2 autres
// Vérifier si la colonne du mileu est vide : si oui, changer les règles

// Les disques ont 5 tailles différentes (le 5 le plus grand) : 5, 4, 3, 2, 1
// Lorsqu'un élément est égal à 0, cela veut dire que la place est libre (pas de disque à cet emplacement)

$columns = [
    'left' => [0, 0, 0, 0, 0],
    'middle' => [1, 2, 3, 4, 5],
    'right' => [0, 0, 0, 0, 0]
];

function playGame(): void
{
    global $columns;

    // If the middle column is not empty: try to move its disks
    if (!isColumnEmpty(('middle'))) {
        checkAvailableMovesMiddle();
    }

    print_r($columns);
}

playGame();

function checkAvailableMovesMiddle()
{
    global $columns;

    for ($i = 0; $i < count($columns['middle']); $i++) {
        if ($columns['middle'][$i] !== 0) {

            // Check if we can move the disk to the left column
            // If the disk is smaller than the last disk of the left column OR the left column is empty, we move it
            if (($columns['middle'][$i] !== 0) && $columns['middle'][$i] < $columns['left'][getLastDiskIndex('left')] || isColumnEmpty('left')) {
                moveTopDisk('middle', 'left');
                continue;
            }

            // If the disk could not be moved to the left column, try with the right column
            if (($columns['middle'][$i] !== 0) && $columns['middle'][$i] < $columns['right'][getLastDiskIndex('right')] || isColumnEmpty('right')) {
                moveTopDisk('middle', 'right');
                continue;
            }

            // If the disk has not been moved in the 2 conditions above, try to move the disks of the left column
            checkAvailableMovesLeft();
        }
    }
}

function checkAvailableMovesLeft(): void
{
    global $columns;

    // Same piece of code as above
    for ($i = 0; $i < count($columns['left']); $i++) {
        if (($columns['left'][$i] !== 0) && $columns['left'][$i] < $columns['right'][getLastDiskIndex('right')] || isColumnEmpty('right')) {
            moveTopDisk('left', 'right');
            continue;
        }
    }
}

// Move the most higher disk of a column to another one
function moveTopDisk($fromColumn, $toColumn): void
{
    global $columns;

    // Get the index of the new column and the index of the old column
    $freeSpotIndex = getFreeSpotIndex($toColumn);
    $indexDiskToMove = getLastDiskIndex($fromColumn);

    // Add the disk to the new column and remove the disk of the old column
    $columns[$toColumn][$freeSpotIndex] = $columns[$fromColumn][$indexDiskToMove];
    $columns[$fromColumn][$indexDiskToMove] = 0;
}

// Function which gets the free spot index of a given column
// Returns -1 if the column is full
function getFreeSpotIndex($column): int
{
    global $columns;

    for ($i = 0; $i < count($columns[$column]); $i++) {

        // If it is the first loop and the spot is not equals to 0 (no spot free), it means that the column is full
        if ($i === 0 && $columns[$column][$i] !== 0) {
            return -1;
        }

        // If the element is not equel to 0, we return the previous index
        if ($columns[$column][$i] !== 0) {
            return $i - 1;
        }

        // If it is the last loop, it means that the column is empty. So we return the previous index (the lowest index)
        if ($i === count($columns[$column]) - 1) {
            return count($columns[$column]) - 1;
        }
    }
}

// Function which gets the index of the highest disk
// Returns -1 if the column is empty
function getLastDiskIndex($column): int
{
    global $columns;

    for ($i = 0; $i < count($columns[$column]); $i++) {
        // If the disk is not equal to 0: return its index
        if ($columns[$column][$i] !== 0) {
            return $i;
        }

        // If it is the last loop and there is still no index found, return -1 (the column is empty)
        if ($i === count($columns[$column]) - 1) {
            return -1;
        }
    }
}

// Check if a given column has at least one disk
function isColumnEmpty($column): bool
{
    global $columns;

    for ($i = 0; $i < count($columns[$column]); $i++) {
        if ($columns[$column][$i] !== 0) {
            return false;
        }
    }

    return true;
}
