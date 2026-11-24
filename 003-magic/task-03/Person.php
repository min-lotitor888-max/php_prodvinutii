<?php

class Person
{
    private $login;
    private $name;
    private $age;

    public function __construct($login, $name, $age)
    {
        $this->login = $login;
        $this->name = $name;
        $this->age = $age;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __sleep()
    {
        return ['login', 'name', 'age'];
    }

    public function __wakeup()
    {
        $this->age = (int) $this->age;
    }

    public function __toString()
    {
        return "{$this->login}: {$this->name}, возраст {$this->age}";
    }
}
