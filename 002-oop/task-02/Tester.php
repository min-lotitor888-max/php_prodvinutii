<?php

class Tester extends Employee implements WebinarSpeakerInterface
{
    private $testingType;

    public function __construct($firstName, $lastName, $salary, $testingType)
    {
        parent::__construct($firstName, $lastName, $salary, 'тестировщик');

        $this->testingType = $testingType;
    }

    public function testApplication()
    {
        return "проводит {$this->testingType} тестирование";
    }

    public function speakWebinar()
    {
        return 'проводит вебинары по тестированию';
    }
}
