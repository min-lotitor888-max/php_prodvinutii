<?php

require __DIR__ . '/interfaces/LeadInterface.php';
require __DIR__ . '/interfaces/ApplicationCreatorInterface.php';
require __DIR__ . '/interfaces/WebinarSpeakerInterface.php';
require __DIR__ . '/Employee.php';
require __DIR__ . '/Director.php';
require __DIR__ . '/Manager.php';
require __DIR__ . '/Programmer.php';
require __DIR__ . '/Tester.php';

function printEmployee($employee)
{
    echo $employee->getFullName();
    echo ', позиция: ', $employee->getPosition();
    echo ', зарплата: ', $employee->getSalary(), ' попугаев';

    if ($employee instanceof LeadInterface) {
        echo ', может руководить: ', $employee->lead();
    }

    if ($employee instanceof ApplicationCreatorInterface) {
        echo ', может заниматься разработкой приложения: ', $employee->createApplication();
    }

    if ($employee instanceof WebinarSpeakerInterface) {
        echo ', может проводить вебинары: ', $employee->speakWebinar();
    }

    if ($employee instanceof Tester) {
        echo ', особенность работы: ', $employee->testApplication();
    }

    echo ".\n\n";
}

$employees = [
    new Director('Иван', 'Иванов', 100, 'Ромашка'),
    new Manager('Мария', 'Петрова', 60, 5),
    new Programmer('Алексей', 'Сидоров', 40, 'PHP'),
    new Tester('Ольга', 'Кузнецова', 30, 'ручное'),
];

$totalSalary = 0;

foreach ($employees as $employee) {
    printEmployee($employee);
    $totalSalary += $employee->getSalary();
}

echo 'Общее количество сотрудников: ', count($employees), ".\n";
echo 'Общая сумма зарплат: ', $totalSalary, " попугаев.\n";
