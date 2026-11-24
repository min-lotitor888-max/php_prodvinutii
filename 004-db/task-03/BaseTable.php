<?php

abstract class BaseTable implements DatabaseWrapper
{
    protected $pdo;
    protected $table;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $tableColumns, array $values): array
    {
        $columns = implode(', ', $tableColumns);
        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        $sql = "INSERT INTO \"{$this->table}\" ({$columns}) VALUES ({$placeholders})";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($values);

        return $this->find((int) $this->pdo->lastInsertId());
    }

    public function update(int $id, array $values): array
    {
        $sets = [];

        foreach ($values as $column => $value) {
            $sets[] = "{$column} = ?";
        }

        $sql = "UPDATE \"{$this->table}\" SET " . implode(', ', $sets) . ' WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_merge(array_values($values), [$id]));

        return $this->find($id);
    }

    public function find(int $id): array
    {
        $sql = "SELECT * FROM \"{$this->table}\" WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row === false ? [] : $row;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM \"{$this->table}\" WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);

        return $statement->rowCount() > 0;
    }
}
