<?php

class Television
{
    public static $maxChannel = 99;

    public $brand;
    public $channel = 1;
    public $isOn = false;

    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    public function turnOn()
    {
        $this->isOn = true;

        return "Телевизор {$this->brand} включён.";
    }

    public function changeChannel($channel)
    {
        $this->channel = $channel;

        return "Включён канал {$this->channel}.";
    }

    public static function getMaxChannel()
    {
        return self::$maxChannel;
    }
}
