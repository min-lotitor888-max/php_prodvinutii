<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class UserTableWrapperTest extends TestCase
{
    #[DataProvider('insertProvider')]
    public function testInsert(array $values): void
    {
        $table = new UserTableWrapper();

        $table->insert($values);

        $this->assertSame([['id' => 1] + $values], $table->get());
    }

    public static function insertProvider(): array
    {
        return [
            'только имя' => [
                ['name' => 'Иван'],
            ],
            'имя и телефон' => [
                ['name' => 'Мария', 'phone' => '+7 900 111-11-11'],
            ],
            'три поля' => [
                ['name' => 'Пётр', 'phone' => '+7 900 222-22-22', 'email' => 'petr@example.com'],
            ],
        ];
    }

    public function testInsertAssignsSequentialIds(): void
    {
        $table = new UserTableWrapper();

        $table->insert(['name' => 'Иван']);
        $table->insert(['name' => 'Мария']);

        $this->assertSame(
            [
                ['id' => 1, 'name' => 'Иван'],
                ['id' => 2, 'name' => 'Мария'],
            ],
            $table->get()
        );
    }

    #[DataProvider('updateProvider')]
    public function testUpdate(array $initialRows, int $id, array $values, array $expected): void
    {
        $table = new UserTableWrapper();

        foreach ($initialRows as $row) {
            $table->insert($row);
        }

        $this->assertSame($expected, $table->update($id, $values));
        $this->assertSame($expected, $table->get()[$id - 1]);
    }

    public static function updateProvider(): array
    {
        return [
            'изменение имени' => [
                [['name' => 'Иван']],
                1,
                ['name' => 'Пётр'],
                ['id' => 1, 'name' => 'Пётр'],
            ],
            'добавление поля' => [
                [['name' => 'Мария']],
                1,
                ['phone' => '+7 900 111-11-11'],
                ['id' => 1, 'name' => 'Мария', 'phone' => '+7 900 111-11-11'],
            ],
            'вторая строка' => [
                [['name' => 'Иван'], ['name' => 'Мария']],
                2,
                ['name' => 'Ольга'],
                ['id' => 2, 'name' => 'Ольга'],
            ],
        ];
    }

    #[DataProvider('missingIdProvider')]
    public function testUpdateReturnsEmptyArrayForMissingId(int $id): void
    {
        $table = new UserTableWrapper();
        $table->insert(['name' => 'Иван']);

        $this->assertSame([], $table->update($id, ['name' => 'Пётр']));
    }

    public static function missingIdProvider(): array
    {
        return [
            'id больше существующих' => [2],
            'id равен нулю' => [0],
            'отрицательный id' => [-1],
        ];
    }

    #[DataProvider('deleteProvider')]
    public function testDelete(array $initialRows, int $id, array $expected): void
    {
        $table = new UserTableWrapper();

        foreach ($initialRows as $row) {
            $table->insert($row);
        }

        $table->delete($id);

        $this->assertSame($expected, $table->get());
    }

    public static function deleteProvider(): array
    {
        return [
            'удаление единственной строки' => [
                [['name' => 'Иван']],
                1,
                [],
            ],
            'удаление первой строки' => [
                [['name' => 'Иван'], ['name' => 'Мария']],
                1,
                [['id' => 2, 'name' => 'Мария']],
            ],
            'удаление второй строки' => [
                [['name' => 'Иван'], ['name' => 'Мария']],
                2,
                [['id' => 1, 'name' => 'Иван']],
            ],
            'удаление несуществующей строки' => [
                [['name' => 'Иван']],
                99,
                [['id' => 1, 'name' => 'Иван']],
            ],
        ];
    }

    #[DataProvider('getProvider')]
    public function testGet(array $initialRows, array $expected): void
    {
        $table = new UserTableWrapper();

        foreach ($initialRows as $row) {
            $table->insert($row);
        }

        $this->assertSame($expected, $table->get());
    }

    public static function getProvider(): array
    {
        return [
            'пустая таблица' => [
                [],
                [],
            ],
            'одна строка' => [
                [['name' => 'Иван']],
                [['id' => 1, 'name' => 'Иван']],
            ],
            'две строки' => [
                [['name' => 'Иван'], ['name' => 'Мария', 'phone' => '+7 900 111-11-11']],
                [
                    ['id' => 1, 'name' => 'Иван'],
                    ['id' => 2, 'name' => 'Мария', 'phone' => '+7 900 111-11-11'],
                ],
            ],
        ];
    }

    public function testImplementsTableWrapperInterface(): void
    {
        $this->assertInstanceOf(TableWrapperInterface::class, new UserTableWrapper());
    }
}
