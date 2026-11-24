<?php

class UserTableWrapper implements TableWrapperInterface
{
    private array $rows = [];
    private int $nextId = 1;

    public function insert(array $values): void
    {
        $this->rows[$this->nextId] = ['id' => $this->nextId] + $values;
        $this->nextId++;
    }

    public function update(int $id, array $values): array
    {
        if (!isset($this->rows[$id])) {
            return [];
        }

        $this->rows[$id] = array_merge($this->rows[$id], $values);

        return $this->rows[$id];
    }

    public function delete(int $id): void
    {
        unset($this->rows[$id]);
    }

    public function get(): array
    {
        return array_values($this->rows);
    }
}
