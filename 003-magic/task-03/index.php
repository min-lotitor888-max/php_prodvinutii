<?php

require __DIR__ . '/Person.php';
require __DIR__ . '/PeopleList.php';

function readable($string)
{
    return str_replace("\0", '\\0', $string);
}

$person = new Person('ivanov', 'Иван', 20);

echo 'Объект: ', $person, "\n";
echo 'Логин через __get: ', $person->login, "\n";

$person->age = 21;
echo 'После __set: ', $person, "\n";

$serialized = serialize($person);
echo 'Сериализованная строка: ', readable($serialized), "\n";

$sameLength = str_replace('ivanov', 'petrov', $serialized);
echo 'Замена на строку такой же длины: ', readable($sameLength), "\n";

$restored = unserialize($sameLength);
echo 'После десериализации: ', $restored, "\n";
echo 'Свойства: логин = ', $restored->login;
echo ', имя = ', $restored->name;
echo ', возраст = ', $restored->age, "\n";

$differentLength = str_replace('ivanov', 'sidorov', $serialized);
echo 'Замена на строку другой длины: ', readable($differentLength), "\n";

$broken = @unserialize($differentLength);

if ($broken === false) {
    echo 'Десериализация не удалась: длина строки в данных не совпала.', "\n";
} else {
    echo 'После десериализации строки другой длины: ', $broken, "\n";
}

echo "\nСписок людей:\n";

$list = new PeopleList();
$list->add(new Person('ivanov', 'Иван', 20));
$list->add(new Person('petrov', 'Пётр', 25));
$list->add(new Person('sidorova', 'Анна', 22));

foreach ($list as $index => $item) {
    echo $index, ': ', $item, "\n";
}
