<?php

abstract class Employee
{
    protected $firstName;
    protected $lastName;
    protected $salary;
    protected $position;

    public function __construct($firstName, $lastName, $salary, $position)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->salary = $salary;
        $this->position = $position;
    }

    public function getFullName()
    {
        return "{$this->lastName} {$this->firstName}";
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
