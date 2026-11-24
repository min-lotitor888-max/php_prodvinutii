<?php

class Programmer extends Employee implements ApplicationCreatorInterface, WebinarSpeakerInterface
{
    private $language;

    public function __construct($firstName, $lastName, $salary, $language)
    {
        parent::__construct($firstName, $lastName, $salary, 'программист');

        $this->language = $language;
    }

    public function createApplication()
    {
        return "пишет код на {$this->language}";
    }

    public function speakWebinar()
    {
        return 'проводит вебинары на технические темы';
    }
}
