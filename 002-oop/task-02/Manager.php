<?php

class Manager extends Employee implements LeadInterface, WebinarSpeakerInterface
{
    private $teamSize;

    public function __construct($firstName, $lastName, $salary, $teamSize)
    {
        parent::__construct($firstName, $lastName, $salary, 'менеджер');

        $this->teamSize = $teamSize;
    }

    public function lead()
    {
        return "руководит командой из {$this->teamSize} человек";
    }

    public function speakWebinar()
    {
        return 'проводит вебинары для сотрудников';
    }
}
