<?php
// --------------------------
//        EXERCICE 8
//       Tour d’Hanoi
// --------------------------

// objectif : vider le milieu (prio le milieu)
// if on peut pas bouger celui du milieu : s'occuper des 2 autres
// bouger au milieu seulement si le bouger à droite/gauche n'est pas possible
// check si colonne du mileu est vide : si oui, changer les règles

// Les disques ont 5 tailles (le 5 le plus grand) : 5, 4, 3, 2, 1
// Lorsqu'un élément est égal à 0, cela veut dire qu'il y a une place de libre

$columns = [
    'left' => [0, 0, 0, 0, 0],
    'middle' => [1, 2, 3, 4, 5],
    'right' => [0, 0, 0, 0, 0]
];

function playGame()
{
    global $columns;

    // Si la colonne du milieu n'est pas vide : tenter de bouger les disques de la colonne du milieu
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

            // Vérifier si on peut déplacer le disque vers la colonne de gauche
            // Si le disque est plus petit que le dernier disque de la colonne de gauche OU que la colonne de gauche est vide, on le déplace
            if (($columns['middle'][$i] !== 0) && $columns['middle'][$i] < $columns['left'][getLastDiskIndex('left')] || isColumnEmpty('left')) {
                moveTopDisk('middle', 'left');
                continue;
            }

            // Si le disque n'a pas pu être déplacé vers la colonne de gauche, tenter avec celle de droite
            if (($columns['middle'][$i] !== 0) && $columns['middle'][$i] < $columns['right'][getLastDiskIndex('right')] || isColumnEmpty('right')) {
                moveTopDisk('middle', 'right');
                continue;
            }

            // Si le disque n'a pas été déplacé dans les 2 conditions du dessus, tenter de déplacer les disques de la colonne de gauche
            checkAvailableMovesLeft();
        }
    }
}

function checkAvailableMovesLeft()
{
    global $columns;

    for ($i = 0; $i < count($columns['left']); $i++) {
        if (($columns['left'][$i] !== 0) && $columns['left'][$i] < $columns['right'][getLastDiskIndex('right')] || isColumnEmpty('right')) {
            moveTopDisk('left', 'right');
            continue;
        }
    }
}

// Déplace le disque le plus en haut d'une colonne à une autre
function moveTopDisk($fromColumn, $toColumn)
{
    global $columns;

    //getFreeSpotIndex pour savoir sur quel index affecter le disque
    $freeSpotIndex = getFreeSpotIndex($toColumn);
    $indexDiskToMove = getLastDiskIndex($fromColumn);

    // Add the disk to the new column and remove the disk of the old column
    $columns[$toColumn][$freeSpotIndex] = $columns[$fromColumn][$indexDiskToMove];
    $columns[$fromColumn][$indexDiskToMove] = 0;
}

// Fonction qui permet d'obtenir le spot libre d'une colonne donnée
// Retourne -1 si la colonne est pleine
function getFreeSpotIndex($column)
{
    global $columns;

    for ($i = 0; $i < count($columns[$column]); $i++) {

        // Si c'est le loop 1 et que c'est pris, ça veut dire que la colonne est pleine
        if ($i === 0 && $columns[$column][$i] !== 0) {
            return -1;
        }

        // Si l'élément n'est pas égal à 0, retourner l'index précédent
        if ($columns[$column][$i] !== 0) {
            return $i - 1;
        }

        // Si c'est le dernier tour, ca veut dire que la colonne est vide, donc retourner le dernier index (l'élément le plus en bas)
        if ($i === count($columns[$column]) - 1) {
            return count($columns[$column]) - 1;
        }
    }
}

// Fonction qui obtient l'index du disque le plus haut
// Retourne -1 si la colonne est vide
function getLastDiskIndex($column)
{
    global $columns;

    for ($i = 0; $i < count($columns[$column]); $i++) {
        // Si le disque n'est pas égal à 0 : retourner son index
        if ($columns[$column][$i] !== 0) {
            return $i;
        }

        // Si c'est le dernier tour et qu'il n'y a toujours pas d'index trouvé, retourne -1 (la colonne est vide)
        if ($i === count($columns[$column]) - 1) {
            return -1;
        }
    }
}

// Vérifie si une colonne donnée a au moins un disque
function isColumnEmpty($column)
{
    global $columns;

    for ($i = 0; $i < count($columns[$column]); $i++) {
        if ($columns[$column][$i] !== 0) {
            return false;
        }
    }

    return true;
}
