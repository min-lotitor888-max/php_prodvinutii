<?php

require __DIR__ . '/autoload.php';

use Homework\Object\Human\Student;
use Homework\Object\Technics\Household\Television;
use Homework\Object\Technics\Transport\Car;

$student = new Student('Serg', 40, 'PHP-разработчик');
$car = new Car('Lada', 'Vesta');
$television = new Television('Samsung');

echo "=== Студент ===\n";
echo $student->introduce(), "\n";
echo $student->study(), "\n";

echo "\n=== Машина ===\n";
echo $car->start(), "\n";
echo $car->stop(), "\n";

echo "\n=== Телевизор ===\n";
echo $television->turnOn(), "\n";
echo $television->changeChannel(5), "\n";

echo "\n=== Статические методы ===\n";
echo 'Минимальный возраст студента: ', Student::getMinAge(), "\n";
echo 'Колёс у машины: ', Car::getWheels(), "\n";
echo 'Максимальный канал: ', Television::getMaxChannel(), "\n";
