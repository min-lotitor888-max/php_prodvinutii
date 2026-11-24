# Домашнее задание к занятию 2.2

**Тема:** «Тестирование»
**Источник:** <https://github.com/netology-code/aphp-homeworks/tree/master/005-testing>

**PHP:** 8.5.4 (CLI)
**PHPUnit:** 12.5.45
**Composer:** 2.11.2

---

## Структура работы

```text
005-testing/
├── README.md
└── task-02/
    ├── composer.json
    ├── composer.lock
    ├── phpunit.xml
    ├── src/
    │   ├── TableWrapperInterface.php
    │   └── UserTableWrapper.php
    └── tests/
        ├── bootstrap.php
        └── UserTableWrapperTest.php
```

Папка `vendor/` в работу не входит — зависимости устанавливаются командой `composer install`.

---

## Задание 2. Работа с TDD

### Интерфейс

В `src/TableWrapperInterface.php` описан интерфейс из задания:

```php
interface TableWrapperInterface
{
    public function insert(array $values): void;
    public function update(int $id, array $values): array;
    public function delete(int $id): void;
    public function get(): array;
}
```

### Реализация таблицы Users

`UserTableWrapper` хранит строки в приватном массиве и выдаёт каждой новой записи порядковый `id`.

| Метод | Что делает |
|---|---|
| `insert()` | добавляет строку и присваивает ей следующий `id` |
| `update()` | меняет поля строки по `id` и возвращает обновлённую строку |
| `delete()` | удаляет строку по `id` |
| `get()` | возвращает все строки в виде массива |

Если строки с указанным `id` нет, `update()` возвращает пустой массив, а `delete()` ничего не делает. `get()` возвращает список с последовательными индексами.

Пример:

```php
$table = new UserTableWrapper();
$table->insert(['name' => 'Иван']);
$table->update(1, ['phone' => '+7 900 111-11-11']);
$table->delete(1);

print_r($table->get());
```

### Тесты

В `tests/UserTableWrapperTest.php` для каждого метода интерфейса есть тесты с дата-провайдерами:

| Метод | Количество тестовых наборов | Что проверяется |
|---|---|---|
| `insert()` | 3 | добавление строки с разным набором полей |
| `update()` | 3 + 3 | изменение строки и возврат пустого массива для несуществующего `id` |
| `delete()` | 4 | удаление первой, второй, единственной и несуществующей строки |
| `get()` | 3 | пустая таблица, одна строка и несколько строк |

Дополнительно проверяется, что новым строкам выдаются последовательные `id`, а класс реализует `TableWrapperInterface`.

Дата-провайдеры объявлены через атрибут `#[DataProvider]` — это актуальный способ для PHPUnit 12.

### Запуск тестов

```bash
cd task-02
composer install
php vendor/bin/phpunit
```

Результат:

```text
PHPUnit 12.5.45 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.4
Configuration: /home/user/test_dz/005-testing/task-02/phpunit.xml

..................                                                18 / 18 (100%)

OK (18 tests, 21 assertions)
```

### Проверка покрытия

Для покрытия нужен драйвер Xdebug или PCOV. Локально использовался Xdebug 3.5.0, подключённый только на время запуска.

```bash
XDEBUG_MODE=coverage php vendor/bin/phpunit --coverage-text
```

Результат:

```text
Code Coverage Report:
  Classes: 100.00% (1/1)
  Methods: 100.00% (4/4)
  Lines:   100.00% (8/8)

UserTableWrapper
  Methods: 100.00% ( 4/ 4)   Lines: 100.00% (  8/  8)
```

Покрыты все четыре метода и все строки реализации, поэтому дополнять тесты не потребовалось.

---

## Локальная проверка

1. Все 4 PHP-файла проверены через `php -l` — синтаксических ошибок нет.
2. `composer validate` — `composer.json` корректный.
3. `php vendor/bin/phpunit` — **18 тестов, 21 проверка**, все пройдены, exit code `0`.
4. `phpunit --coverage-text` — покрытие **100%** по классам, методам и строкам.

---

## Соответствие требованиям

| Требование | Статус |
|---|---|
| Задание 1 не отправлять | пропущено |
| Настроен PHPUnit | ✔ |
| Интерфейс `TableWrapperInterface` | ✔ |
| Реализация таблицы Users | ✔ |
| Тесты для каждого метода интерфейса | ✔ |
| Использованы дата-провайдеры | ✔ |
| Проверено покрытие кода тестами | ✔ (100%) |
| Тесты дополнены при необходимости | не потребовалось |
| Необязательное задание 3 | не выполнялось |

---

## Инструменты

- **PHP 8.5.4 CLI** — локальная установка, запуск через `~/.local/bin/php`.
- **Composer 2.11.2** — установка PHPUnit.
- **PHPUnit 12.5.45** — запуск тестов.
- **Xdebug 3.5.0** — только для отчёта о покрытии.

Если `php` не найден в текущем терминале:

```bash
source ~/.bashrc
# или:
~/.local/bin/php vendor/bin/phpunit
```
