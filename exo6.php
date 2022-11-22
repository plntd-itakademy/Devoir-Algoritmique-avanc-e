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

function getEmployeeData()
{
    $resource = fopen('employees.csv', 'r');
    return fgetcsv($resource, null, ',', "/n");
}

// print_r(getEmployeeData());

function getHigherSalary(array $employees): array
{
    // We affect the first employee as the higher salary data
    $higherSalaryData = $employees[0];

    // For each employee: we compare its salary
    for ($i = 1; $i < count($employees); $i++) {

        // If the salary of the employee is greater than the highest salary saved, we replace it
        if ($employees[$i]['salary'] > $higherSalaryData['salary']) {
            $higherSalaryData = $employees[$i];
        }
    }

    return $higherSalaryData;
}

$employeeHigherSalary = getHigherSalary($employees);
echo "L'employé avec le salaire le plus élevé est : " . $employeeHigherSalary['lastname'] . ' ' . $employeeHigherSalary['firstname'] . " (" . $employeeHigherSalary['salary'] . "€)";

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

$employeeLowestSalary = getLowestSalary($employees);
echo "L'employé avec le salaire le moins élevé est : " . $employeeLowestSalary['lastname'] . " " . $employeeLowestSalary['firstname'] . " (" . $employeeLowestSalary['salary'] . "€)";

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

echo 'La moyenne de salaires est de : ' . getAverageSalary($employees) . '€';
