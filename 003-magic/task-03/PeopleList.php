<?php

class PeopleList implements Iterator
{
    private $people = [];
    private $position = 0;

    public function add(Person $person)
    {
        $this->people[] = $person;
    }

    public function current(): Person
    {
        return $this->people[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->people[$this->position]);
    }
}
