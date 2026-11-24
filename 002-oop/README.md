# Домашнее задание к занятию 1.2

**Тема:** «Наследование, инкапсуляция, полиморфизм»
**Источник:** <https://github.com/netology-code/aphp-homeworks/tree/master/002-oop>

**PHP:** 8.5.4 (CLI)

---

## Структура работы

```text
002-oop/
├── README.md
├── task-02/
│   ├── index.php
│   ├── Employee.php
│   ├── Director.php
│   ├── Manager.php
│   ├── Programmer.php
│   ├── Tester.php
│   └── interfaces/
│       ├── LeadInterface.php
│       ├── ApplicationCreatorInterface.php
│       └── WebinarSpeakerInterface.php
└── task-03/
    ├── exceptions.php
    └── index.php
```

---

## Задание 2. Иерархия классов, интерфейсы и абстракция

Создан абстрактный класс `Employee` и четыре наследника:

```text
Employee (abstract)
├── Director    — LeadInterface
├── Manager     — LeadInterface, WebinarSpeakerInterface
├── Programmer  — ApplicationCreatorInterface, WebinarSpeakerInterface
└── Tester      — WebinarSpeakerInterface
```

Интерфейсы:

| Интерфейс | Метод | Смысл |
|---|---|---|
| `LeadInterface` | `lead()` | может руководить |
| `ApplicationCreatorInterface` | `createApplication()` | может заниматься разработкой приложения |
| `WebinarSpeakerInterface` | `speakWebinar()` | может вести вебинар для коллег |

Свойства и методы:

| Класс | Свои свойства | Свои методы |
|---|---|---|
| `Employee` | `firstName`, `lastName`, `salary`, `position` (protected) | `getFullName()`, `getSalary()`, `getPosition()` |
| `Director` | `company` (private) | `lead()` |
| `Manager` | `teamSize` (private) | `lead()`, `speakWebinar()` |
| `Programmer` | `language` (private) | `createApplication()`, `speakWebinar()` |
| `Tester` | `testingType` (private) | `testApplication()`, `speakWebinar()` |

Свойства базового класса объявлены как `protected`, свойства наследников — как `private`. Доступ к ним идёт через методы — это и есть инкапсуляция.

В `index.php` создано по одному объекту каждого класса. Интерфейсы проверяются через `instanceof`, поэтому у каждого сотрудника выводятся только те возможности, которые он реально реализует.

### Результат

```text
Иванов Иван, позиция: директор, зарплата: 100 попугаев, может руководить: управляет компанией «Ромашка».

Петрова Мария, позиция: менеджер, зарплата: 60 попугаев, может руководить: руководит командой из 5 человек, может проводить вебинары: проводит вебинары для сотрудников.

Сидоров Алексей, позиция: программист, зарплата: 40 попугаев, может заниматься разработкой приложения: пишет код на PHP, может проводить вебинары: проводит вебинары на технические темы.

Кузнецова Ольга, позиция: тестировщик, зарплата: 30 попугаев, может проводить вебинары: проводит вебинары по тестированию, особенность работы: проводит ручное тестирование.

Общее количество сотрудников: 4.
Общая сумма зарплат: 230 попугаев.
```

### Запуск

```bash
php task-02/index.php
```

---

## Задание 3. Собственные исключения

В `task-03/exceptions.php` созданы шесть классов исключений:

- `IntException`
- `FloatException`
- `StringException`
- `BoolException`
- `ArrayException`
- `NullException`

Все они наследуют встроенный `Exception`.

Функция `calculate()` определяет тип значения и выбрасывает соответствующее исключение:

```php
function calculate($value)
{
    if (is_int($value)) {
        throw new IntException('передано целое число (int)');
    }

    if (is_float($value)) {
        throw new FloatException('передано дробное число (float)');
    }

    if (is_string($value)) {
        throw new StringException('передана строка (string)');
    }

    if (is_bool($value)) {
        throw new BoolException('передано булево значение (bool)');
    }

    if (is_array($value)) {
        throw new ArrayException('передан массив (array)');
    }

    if (is_null($value)) {
        throw new NullException('передан null');
    }
}
```

Снаружи каждое исключение ловится отдельным блоком `catch`, и выводится сообщение о типе переменной.

### Результат

```text
int: передано целое число (int)
float: передано дробное число (float)
string: передана строка (string)
bool: передано булево значение (bool)
array: передан массив (array)
null: передан null
```

### Запуск

```bash
php task-03/index.php
```

---

## Локальная проверка

1. Все 11 PHP-файлов проверены через `php -l` — синтаксических ошибок нет.
2. `task-02/index.php` запускается без ошибок и предупреждений, exit code `0`.
3. `task-03/index.php` запускается без ошибок, выводятся все 6 типов, exit code `0`.
4. Отдельным временным скриптом проверено 50 пунктов:
   - абстрактность `Employee`;
   - реализация нужных интерфейсов;
   - уровни доступа свойств;
   - не менее трёх свойств и методов в каждом классе;
   - значения методов и итоговые суммы;
   - существование всех шести исключений и их наследование от `Exception`;
   - выброс нужного исключения для каждого типа.

Все проверки пройдены.

---

## Соответствие требованиям

| Требование | Статус |
|---|---|
| Задание 1 не отправлять | пропущено |
| Классы: сотрудник, директор, менеджер, программист, тестировщик | ✔ |
| Иерархия с помощью абстрактного класса | ✔ |
| Интерфейсы `LeadInterface`, `ApplicationCreatorInterface`, `WebinarSpeakerInterface` | ✔ |
| Каждый concrete-класс реализует хотя бы один интерфейс | ✔ |
| Не менее трёх свойств и трёх методов | ✔ |
| Уровни доступа (protected/private) | ✔ |
| Вывод ФИО, должности, зарплаты и особенностей работы | ✔ |
| Общее количество сотрудников и сумма зарплат | ✔ |
| Шесть собственных исключений | ✔ |
| `calculate()` выбрасывает исключение по типу | ✔ |
| Каждое исключение ловится отдельным `catch` | ✔ |

Дополнительное задание со звёздочкой (встраивание исключений в задание 2) не выполнялось — это необязательная часть.

---

## Инструменты

- **PHP 8.5.4 CLI** — локальная установка, запуск через `~/.local/bin/php`.
- **Composer** не нужен: автозагрузка в этом задании не требуется.
- Дополнительные инструменты не требуются.

Если `php` не найден в текущем терминале:

```bash
source ~/.bashrc
# или:
~/.local/bin/php task-02/index.php
```
