<?php
// --------------------------
//        EXERCICE 6
//       Fichier CSV
// --------------------------

$employees = [
    0 => [
        'lastname' => 'Dupond',
        'firstname' => 'Jean',
        'salary' => 1410
    ],
    1 => [
        'lastname' => 'Super',
        'firstname' => 'Mario',
        'salary' => 987
    ],
    2 => [
        'lastname' => 'Spider',
        'firstname' => 'Man',
        'salary' => 1525
    ],
    3 => [
        'lastname' => 'John',
        'firstname' => 'Wayne',
        'salary' => 13501
    ]
];

function writeEmployeeFile(array $employees): void
{
    // Create the csv file
    file_put_contents('employees.csv', "Nom,Prénom,Salaire\n");

    for ($i = 0; $i < count($employees); $i++) {

        // We can't use a simple "For" loop here because it is an associative array
        $j = 0;
        foreach ($employees[$i] as $employeeData) {
            file_put_contents('employees.csv', $employeeData, FILE_APPEND);

            // Add a comma if it is not the last item of the row
            if ($j !== count($employees[$i]) - 1) {
                file_put_contents('employees.csv', ',', FILE_APPEND);
            }
            $j++;
        }

        // Break a line to put a new row
        file_put_contents('employees.csv', "\n", FILE_APPEND);
    }
}

writeEmployeeFile($employees);

function getEmployeeData(): array
{
    $lines = file('employees.csv', FILE_SKIP_EMPTY_LINES); // Open the csv file
    unset($lines[0]); // Delete the row with columns names
    $lines = array_values($lines); // Re-index the array

    // Loop the lines: translate the array
    for ($i = 0; $i < count($lines); $i++) {
        $lines[$i] = explode(',', $lines[$i]);

        $lines[$i]['lastname'] = $lines[$i][0];
        unset($lines[$i][0]);

        $lines[$i]['firstname'] = $lines[$i][1];
        unset($lines[$i][1]);

        $lines[$i]['salary'] = intval($lines[$i][2]);
        unset($lines[$i][2]);
    }

    return $lines;
}

function displayEmployees(): void
{
    $employees = getEmployeeData(); // Get employees data

    for ($i = 0; $i < count($employees); $i++) { // For each employee: display its informations
        echo "Employé #" . ($i + 1) . " : \n";
        echo "Nom : " . $employees[$i]['lastname'] . " " . $employees[$i]['firstname'] . "\n";
        echo "Salaire : " . $employees[$i]['salary'] . "\n";

        // If it is not the last item: break a line (only for aesthetic)
        if ($i !== count($employees) - 1) {
            echo "\n";
        }
    }
}

// displayEmployees();

function getSalaryByEmployeeName(string $name): ?int
{
    $employees = getEmployeeData();

    for ($i = 0; $i < count($employees); $i++) {

        // Check if the name is equal to the firstname or the lastname
        if ($employees[$i]['firstname'] === $name || $employees[$i]['lastname'] === $name) {
            return $employees[$i]['salary'];
        }

        // If it is the last loop: it means that the employee was not found. We return null
        if ($i === count($employees) - 1) {
            return null;
        }
    }
}

// echo getSalaryByEmployeeName('Mario');

function getHigherSalary(array $employees): array
{
    // We affect the first employee as the higher salary data
    $higherSalaryData = $employees[0];

    // For each employee: we compare its salary
    for ($i = 1; $i < count($employees); $i++) {
        // print_r($higherSalaryData['salary']);

        // If the salary of the employee is greater than the highest salary saved, we replace it
        if ($employees[$i]['salary'] > $higherSalaryData['salary']) {
            $higherSalaryData = $employees[$i];
        }
    }

    return $higherSalaryData;
}

// $employeeHigherSalary = getHigherSalary(getEmployeeData());
// echo "L'employé avec le salaire le plus élevé est : " . $employeeHigherSalary['lastname'] . ' ' . $employeeHigherSalary['firstname'] . " (" . $employeeHigherSalary['salary'] . "€)";

function getLowestSalary(array $employees): array
{
    // We affect the first employee as the lowest salary data
    $lowerSalaryData = $employees[0];

    // For each employee: we compare its salary
    for ($i = 1; $i < count($employees); $i++) {

        // If the salary of the employee is lower than the lowest salary saved, we replace it
        if ($employees[$i]['salary'] < $lowerSalaryData['salary']) {
            $lowerSalaryData = $employees[$i];
        }
    }

    return $lowerSalaryData;
}

// $employeeLowestSalary = getLowestSalary(getEmployeeData());
// echo "L'employé avec le salaire le moins élevé est : " . $employeeLowestSalary['lastname'] . " " . $employeeLowestSalary['firstname'] . " (" . $employeeLowestSalary['salary'] . "€)";

function getAverageSalary(array $employees): float
{
    $salarySum = 0;

    // For each employee: add the salary to the sum
    for ($i = 0; $i < count($employees); $i++) {
        $salarySum += $employees[$i]['salary'];
    }

    // Then we divide the sum by the number of employees
    return round($salarySum / count($employees));
}

// echo 'La moyenne de salaires est de : ' . getAverageSalary($employees) . '€';

function getMedianSalary(): int
{
    $employees = getEmployeeData();
    $salariesArr = [];

    // Create an array of the employees salaries
    for ($i = 0; $i < count($employees); $i++) {
        $salariesArr[$i] = $employees[$i]['salary'];
    }

    // Check if the number of elements is even or odd
    $even = count($salariesArr) % 2 === 0 ? true : false;

    // Sort the array in asc order
    $ascSalaries = sortArray($salariesArr);

    // The operation is the following:
    // We divide per 2 the number of salaries
    // We add 1 if the number of elements is even
    // And then, we do - 1 since arrays start at 0 (to get the correct array index)
    if ($even) {
        $medianIndex = ((count($ascSalaries) / 2) + 1) - 1;
    } else {
        $medianIndex = ((count($ascSalaries) / 2)) - 1;
    }

    return $ascSalaries[$medianIndex];
}

echo getMedianSalary($employees);

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
