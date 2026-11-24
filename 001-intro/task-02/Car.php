<?php

class Car
{
    public static $wheels = 4;

    public $brand;
    public $color;
    public $speed = 0;

    public function __construct($brand, $color)
    {
        $this->brand = $brand;
        $this->color = $color;
    }

    public function start()
    {
        $this->speed = 60;

        return "{$this->brand} поехала со скоростью {$this->speed} км/ч.";
    }

    public function stop()
    {
        $this->speed = 0;

        return "{$this->brand} остановилась.";
    }

    public static function getWheels()
    {
        return self::$wheels;
    }
}
