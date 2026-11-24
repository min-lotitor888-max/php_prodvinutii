<?php

class Director extends Employee implements LeadInterface
{
    private $company;

    public function __construct($firstName, $lastName, $salary, $company)
    {
        parent::__construct($firstName, $lastName, $salary, 'директор');

        $this->company = $company;
    }

    public function lead()
    {
        return "управляет компанией «{$this->company}»";
    }
}
