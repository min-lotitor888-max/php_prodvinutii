<?php

namespace Homework\Object\Human;

class Student
{
    public static $minAge = 16;

    public $name;
    public $age;
    public $course;

    public function __construct($name, $age, $course)
    {
        $this->name = $name;
        $this->age = $age;
        $this->course = $course;
    }

    public function introduce()
    {
        return "Меня зовут {$this->name}, мне {$this->age} лет. Я учусь на курсе «{$this->course}».";
    }

    public function study()
    {
        return "{$this->name} учится программировать.";
    }

    public static function getMinAge()
    {
        return self::$minAge;
    }
}
